<?php


use App\Blog\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PostImagesTest extends TestCase
{
    use DatabaseMigrations, TestsImageUploads;

    /**
     *@test
     */
    public function an_image_can_be_added_to_a_post()
    {
        $post = factory(Post::class)->create();

        $post->addImage($this->prepareFileUpload('tests/testpic1.png'));

        $this->assertCount(1, $post->getMedia());

        $post->clearMediaCollection();
    }

    /**
     *@test
     */
    public function an_image_belonging_to_a_post_can_be_set_as_the_featured_image()
    {
        $post = factory(Post::class)->create();
        $image = $post->addImage($this->prepareFileUpload('tests/testpic1.png'));

        $post->setFeaturedImage($image);

        $this->assertEquals($image->id, $post->fresh()->featuredImage()->id);

        $post->clearMediaCollection();
    }

    /**
     *@test
     */
    public function an_image_that_does_not_belong_to_a_post_can_not_be_set_as_the_featured_image()
    {
        $post = factory(Post::class)->create();
        $post2 = factory(Post::class)->create();
        $image = $post2->addImage($this->prepareFileUpload('tests/testpic1.png'));

        $this->expectException(Exception::class);

        $post->setFeaturedImage($image);

        $post->clearMediaCollection();
    }

    /**
     *@test
     */
    public function a_post_only_ever_has_one_featured_image()
    {
        $post = factory(Post::class)->create();
        $image = $post->addImage($this->prepareFileUpload('tests/testpic1.png'));
        $image2 = $post->addImage($this->prepareFileUpload('tests/testpic2.png'));

        $post->setFeaturedImage($image);
        $post->fresh()->setFeaturedImage($image2);

        $this->assertCount(1, $post->fresh()->getMedia()->filter(function($image) {
            return $image->getCustomProperty('is_feature');
        }));

        $post->clearMediaCollection();
    }
}