<?php


use App\Gallery\Album;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AlbumsControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function an_album_is_correctly_stored_with_a_title()
    {
        $this->asLoggedInUser();
        $this->post('/admin/albums/', ['title' => 'My Photo Album'])
            ->assertResponseStatus(302)
            ->seeInDatabase('albums', ['title' => 'My Photo Album']);
    }

    /**
     *@test
     */
    public function an_albums_title_is_updated()
    {
        $album = factory(Album::class)->create();

        $this->asLoggedInUser();
        $this->post('/admin/albums/' . $album->id, ['title' => 'A New Title'])
            ->assertResponseStatus(302)
            ->seeInDatabase('albums', [
                'id' => $album->id,
                'title' => 'A New Title'
            ]);
    }

    /**
     *@test
     */
    public function an_album_is_correctly_deleted()
    {
        $album = factory(Album::class)->create();

        $this->asLoggedInUser();
        $this->delete('/admin/albums/' . $album->id)
            ->assertResponseStatus(302)
            ->notSeeInDatabase('albums', ['id' => $album->id]);
    }
}