<?php


use App\Blog\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PostBodyControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function the_body_of_a_post_is_correctly_updated()
    {
        $post = factory(Post::class)->create();

        $this->asLoggedInUser();

        $this->post('/admin/posts/' . $post->id . '/body', [
            'body' => 'This is the new body of the post'
        ])->assertResponseOk()
            ->seeJson(['body' => 'This is the new body of the post'])
            ->seeInDatabase('posts', [
                'id' => $post->id,
                'body' => 'This is the new body of the post'
            ]);
    }
}