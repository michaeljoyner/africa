<?php


use App\Expeditions\Expedition;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ExpeditionPublishingControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function an_expedition_is_correctly_published()
    {
        $expedition = factory(Expedition::class)->create(['published' => false]);

        $this->asLoggedInUser();
        $this->post('/admin/expeditions/' . $expedition->id . '/publish', ['publish' => true])
            ->assertResponseOk()
            ->seeJson(['new_state' => true])
            ->seeInDatabase('expeditions', [
                'id' => $expedition->id,
                'published' => 1
            ]);
    }

    /**
     *@test
     */
    public function an_expedition_is_correctly_retracted()
    {
        $expedition = factory(Expedition::class)->create(['published' => true]);

        $this->asLoggedInUser();
        $this->post('/admin/expeditions/' . $expedition->id . '/publish', ['publish' => false])
            ->assertResponseOk()
            ->seeJson(['new_state' => false])
            ->seeInDatabase('expeditions', [
                'id' => $expedition->id,
                'published' => 0
            ]);
    }
}