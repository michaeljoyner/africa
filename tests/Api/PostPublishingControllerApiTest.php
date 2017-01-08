<?php


use App\Blog\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PostPublishingControllerApiTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_post_is_correctly_published()
    {
        $post = factory(Post::class)->create(['published' => false]);

        $this->asLoggedInUser();
        $this->post('/admin/api/posts/' . $post->id . '/publish', ['publish' => true])
            ->assertResponseOk()
            ->seeJson(['new_state' => true])
            ->seeInDatabase('posts', [
                'id' => $post->id,
                'published' => 1
            ]);
    }

    /**
     *@test
     */
    public function a_post_is_correctly_retracted()
    {
        $post = factory(Post::class)->create(['published' => true]);

        $this->asLoggedInUser();
        $this->post('/admin/api/posts/' . $post->id . '/publish', ['publish' => false])
            ->assertResponseOk()
            ->seeJson(['new_state' => false])
            ->seeInDatabase('posts', [
                'id' => $post->id,
                'published' => 0
            ]);
    }
}