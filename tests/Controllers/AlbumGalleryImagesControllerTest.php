<?php


use App\Gallery\Album;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AlbumGalleryImagesControllerTest extends TestCase
{
    use DatabaseMigrations, TestsImageUploads;

    /**
     *@test
     */
    public function an_image_is_stored_in_the_gallery()
    {
        $album = factory(Album::class)->create();

        $this->asLoggedInUser();
        $response = $this->call('POST', '/admin/api/albums/' . $album->id . '/gallery/images', [], [], [
            'file' => $this->prepareFileUpload('tests/testpic1.png')
        ]);
        $this->assertEquals(200, $response->status());
        $responseData = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('image_id', $responseData);
        $this->assertArrayHasKey('src', $responseData);
        $this->assertArrayHasKey('thumb_src', $responseData);

        $this->assertCount(1, $album->fresh()->galleryImages($withMain = false));
    }

    /**
     *@test
     */
    public function the_index_of_an_albums_gallery_images_is_returned_correctly()
    {
        $album = factory(Album::class)->create();
        $image1 = $album->addGalleryImage($this->prepareFileUpload('tests/testpic1.png'));
        $image2 = $album->addGalleryImage($this->prepareFileUpload('tests/testpic2.png'));

        $this->asLoggedInUser();
        $this->get('/admin/api/albums/' . $album->id . '/gallery/images')
            ->assertResponseOk()
            ->seeJson([
                'image_id' => $image1->id,
                'src' => $image1->getUrl(),
                'thumb_src' => $image1->getUrl('thumb')
            ])
            ->seeJson([
                'image_id' => $image2->id,
                'src' => $image2->getUrl(),
                'thumb_src' => $image2->getUrl('thumb')
            ]);
    }

    /**
     *@test
     */
    public function a_gallery_image_can_be_deleted()
    {
        $album = factory(Album::class)->create();
        $image = $album->addGalleryImage($this->prepareFileUpload('tests/testpic1.png'));

        $this->asLoggedInUser();
        $this->delete('/admin/api/albums/' . $album->id .'/gallery/images/' . $image->id)
            ->assertResponseOk()
            ->notSeeInDatabase('media', ['id' => $image->id]);
    }

    /**
     *@test
     */
    public function the_image_being_deleted_must_belong_to_the_specified_album()
    {
        $album = factory(Album::class)->create();
        $album2 = factory(Album::class)->create();
        $image = $album->addGalleryImage($this->prepareFileUpload('tests/testpic1.png'));

        $this->asLoggedInUser();
        $this->delete('/admin/api/albums/' . $album2->id .'/gallery/images/' . $image->id)
            ->assertResponseStatus(422)
            ->seeInDatabase('media', ['id' => $image->id]);
    }
}