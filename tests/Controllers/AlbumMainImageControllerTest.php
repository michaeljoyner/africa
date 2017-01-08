<?php


use App\Gallery\Album;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AlbumMainImageControllerTest extends TestCase
{
    use DatabaseMigrations, TestsImageUploads;

    /**
     *@test
     */
    public function the_model_image_is_correctly_stored_on_the_album()
    {
        $album = factory(Album::class)->create();

        $this->asLoggedInUser();
        $response = $this->call('POST', '/admin/albums/' . $album->id . '/main-image', [], [], [
            'file' => $this->prepareFileUpload('tests/testpic1.png')
        ]);
        $this->assertEquals(200, $response->status());

        $this->assertTrue($album->fresh()->hasModelImageSet());

        $album->clearMediaCollection();
    }
}