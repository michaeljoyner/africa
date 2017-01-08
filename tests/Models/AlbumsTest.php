<?php


use App\Gallery\Album;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AlbumsTest extends TestCase
{
    use DatabaseMigrations, TestsImageUploads;

    /**
     *@test
     */
    public function an_album_can_be_created_and_persisted()
    {
        $album = factory(Album::class)->create();

        $this->assertInstanceOf(Album::class, $album);
    }

    /**
     *@test
     */
    public function an_album_can_be_published()
    {
        $album = factory(Album::class)->create(['published' => false]);

        $album->publish();

        $this->assertTrue($album->fresh()->published);
    }

    /**
     *@test
     */
    public function an_album_can_be_retracted()
    {
        $album = factory(Album::class)->create(['published' => true]);

        $album->retract();

        $this->assertFalse($album->fresh()->published);
    }

    /**
     *@test
     */
    public function an_album_has_a_model_image()
    {
        $album = factory(Album::class)->create();

        $album->setImage($this->prepareFileUpload('tests/testpic1.png'));

        $this->assertTrue($album->fresh()->hasModelImageSet());

        $album->clearMediaCollection();
    }
}