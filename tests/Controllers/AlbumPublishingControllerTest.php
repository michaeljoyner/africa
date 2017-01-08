<?php


use App\Gallery\Album;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AlbumPublishingControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function an_album_is_correctly_published()
    {
        $album = factory(Album::class)->create(['published' => false]);

        $this->asLoggedInUser();
        $this->post('/admin/albums/' . $album->id . '/publish', ['publish' => true])
            ->assertResponseOk()
            ->seeJson(['new_state' => true])
            ->seeInDatabase('albums', [
                'id' => $album->id,
                'published' => 1
            ]);
    }

    /**
     *@test
     */
    public function an_album_is_correctly_retracted()
    {
        $album = factory(Album::class)->create(['published' => true]);

        $this->asLoggedInUser();
        $this->post('/admin/albums/' . $album->id . '/publish', ['publish' => false])
            ->assertResponseOk()
            ->seeJson(['new_state' => false])
            ->seeInDatabase('albums', [
                'id' => $album->id,
                'published' => 0
            ]);
    }
}