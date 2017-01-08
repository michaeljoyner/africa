<?php


use App\Blog\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PostImagesControllerTest extends TestCase
{
    use DatabaseMigrations, TestsImageUploads;

    /**
     *@test
     */
    public function an_uploaded_image_is_correctly_attached_to_the_post()
    {
        $post = factory(Post::class)->create();

        $this->asLoggedInUser();
        $response = $this->call('POST', '/admin/posts/' . $post->id . '/images', [], [], [
            'file' => $this->prepareFileUpload('tests/testpic1.png')
        ]);
        $this->assertEquals(200, $response->status());
        $this->seeJsonStructure(['location']);

        $this->assertCount(1, $post->fresh()->getMedia());

        $post->clearMediaCollection();
    }
}