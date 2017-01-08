<?php


use App\Blog\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PostsControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function a_post_is_created_for_the_authenticated_user()
    {
        $user = $this->asLoggedInUser();
        $this->post('/admin/posts', ['title' => 'My First Post'])
            ->assertResponseStatus(302)
            ->seeInDatabase('posts', [
                'user_id'     => $user->id,
                'title'       => 'My First Post',
                'description' => null
            ]);
    }

    /**
     * @test
     */
    public function a_posts_title_and_description_can_be_updated()
    {
        $post = factory(Post::class)->create();

        $this->asLoggedInUser();
        $this->post('/admin/posts/' . $post->id, [
            'title'       => 'An updated title',
            'description' => 'An updated description'
        ])->assertResponseStatus(302)
            ->seeInDatabase('posts', [
                'id'          => $post->id,
                'title'       => 'An updated title',
                'description' => 'An updated description'
            ]);
    }

    /**
     *@test
     */
    public function a_post_is_properly_soft_deleted()
    {
        $post = factory(Post::class)->create();

        $this->asLoggedInUser();
        $this->delete('/admin/posts/' . $post->id)
            ->assertResponseStatus(302)
            ->assertSoftDeleted($post);
    }
}