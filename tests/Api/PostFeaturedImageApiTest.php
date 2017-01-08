<?php


use App\Blog\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PostFeaturedImageApiTest extends TestCase
{
    use DatabaseMigrations, TestsImageUploads;

    /**
     *@test
     */
    public function an_existing_image_is_correctly_set_as_the_featured_image()
    {
        $this->asLoggedInUser();
        $post = factory(Post::class)->create();
        $image = $post->addImage($this->prepareFileUpload('tests/testpic1.png'));

        $this->patch('/admin/api/posts/' . $post->id . '/images/featured', ['image_id' => $image->id])
            ->assertResponseOk();

        $this->assertEquals($image->id, $post->fresh()->featuredImage()->id);

        $post->clearMediaCollection();
    }

    /**
     *@test
     */
    public function an_image_can_be_directly_uploaded_and_set_as_the_featured_image()
    {
        $this->asLoggedInUser();
        $post = factory(Post::class)->create();

        $response = $this->call('POST', '/admin/api/posts/' . $post->id . '/images/featured', [], [], [
            'file' => $this->prepareFileUpload('tests/testpic1.png', 'featured.png')
        ]);
        $this->assertEquals(200, $response->status());

        $responseData = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('id', $responseData);
        $this->assertArrayHasKey('url', $responseData);
        $this->assertArrayHasKey('is_feature', $responseData);
        $this->assertArrayHasKey('thumb', $responseData);
        $this->assertTrue($responseData['is_feature']);

        $this->assertContains('featured.png', $post->fresh()->featuredImage()->getPath());

        $post->clearMediaCollection();
    }

    /**
     *@test
     */
    public function the_index_of_images_for_a_post_are_correctly_given()
    {
        $post = factory(Post::class)->create();
        $image1 = $post->addImage($this->prepareFileUpload('tests/testpic1.png'));
        $image2 = $post->addImage($this->prepareFileUpload('tests/testpic2.png'));

        $this->asLoggedInUser();
        $this->get('/admin/api/posts/' . $post->id . '/images')
            ->assertResponseOk()
            ->seeJson([
                'id' => $image1->id,
                'url' => $image1->getUrl(),
                'thumb' => $image1->getUrl('thumb'),
                'is_feature' => false
            ])
            ->seeJson([
                'id' => $image2->id,
                'url' => $image2->getUrl(),
                'thumb' => $image2->getUrl('thumb'),
                'is_feature' => false
            ]);
    }
}