<?php


use App\Gallery\Album;
use App\Gallery\Gallery;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AlbumGalleriesTest extends TestCase
{
    use DatabaseMigrations, TestsImageUploads;

    /**
     *@test
     */
    public function an_album_has_a_gallery()
    {
        $album = factory(Album::class)->create();

        $this->assertInstanceOf(Gallery::class, $album->getGallery());
    }

    /**
     *@test
     */
    public function an_album_only_has_one_gallery()
    {
        $album = factory(Album::class)->create();
        $firstGallery = $album->getGallery();
        $secondGallery = $album->fresh()->getGallery();

        $this->assertCount(1, Gallery::all());
        $this->assertEquals($firstGallery->fresh(), $secondGallery->fresh());
    }

    /**
     *@test
     */
    public function an_image_can_be_added_to_a_albums_gallery()
    {
        $album = factory(Album::class)->create();

        $album->addGalleryImage($this->prepareFileUpload('tests/testpic1.png'));

        $this->assertCount(1, $album->fresh()->getGallery()->getMedia());
    }

    /**
     *@test
     */
    public function an_albums_gallery_images_can_be_fetched_from_the_album_without_main_image()
    {
        $album = factory(Album::class)->create();
        $album->setImage($this->prepareFileUpload('tests/testpic2.png'));
        $album->addGalleryImage($this->prepareFileUpload('tests/testpic1.png'));
        $album->addGalleryImage($this->prepareFileUpload('tests/testpic2.png'));

        $this->assertCount(2, $album->fresh()->galleryImages($withMain = false));
    }

    /**
     *@test
     */
    public function an_albums_images_can_all_be_fetched_including_the_main_image()
    {
        $album = factory(Album::class)->create();
        $album->setImage($this->prepareFileUpload('tests/testpic2.png'));
        $album->addGalleryImage($this->prepareFileUpload('tests/testpic1.png'));
        $album->addGalleryImage($this->prepareFileUpload('tests/testpic2.png'));

        $this->assertCount(3, $album->fresh()->galleryImages());
    }

    /**
     *@test
     */
    public function deleting_an_album_will_also_delete_its_gallery()
    {
        $album = factory(Album::class)->create();
        $gallery = $album->getGallery();

        $album->delete();

        $this->notSeeInDatabase('galleries', ['id' => $gallery->id]);
    }
}