<?php


use App\Expeditions\Expedition;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ExpeditionsControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function an_expedition_is_correctly_stored()
    {
        $this->asLoggedInUser();
        $this->post('/admin/expeditions', [
            'name'        => 'The Great Escape',
            'description' => 'A Thrilling Adventure'
        ])
            ->assertResponseStatus(302)
            ->seeInDatabase('expeditions', [
                'name'        => 'The Great Escape',
                'description' => 'A Thrilling Adventure'
            ]);
    }

    /**
     *@test
     */
    public function an_expedition_is_correctly_updated()
    {
        $expedition = factory(Expedition::class)->create();

        $this->asLoggedInUser();
        $this->post('/admin/expeditions/' . $expedition->id, [
            'name' => 'The Great Escape',
            'description' => 'A thrilling adventure',
            'writeup' => 'A group of adventurers escape from almost certain danger',
            'duration' => '10 days',
            'difficulty' => 'Extreme',
            'capacity' => '5 peoples',
            'start_date' => '',
            'location' => 'Deepest darkest africa'
        ])->assertResponseStatus(302)
            ->seeInDatabase('expeditions', [
                'id' => $expedition->id,
                'name' => 'The Great Escape',
                'description' => 'A thrilling adventure',
                'writeup' => 'A group of adventurers escape from almost certain danger',
                'duration' => '10 days',
                'difficulty' => 'Extreme',
                'capacity' => '5 peoples',
                'start_date' => null,
                'location' => 'Deepest darkest africa'
            ]);
    }

    /**
     *@test
     */
    public function an_expedition_is_correctly_deleted()
    {
        $expedition = factory(Expedition::class)->create();

        $this->asLoggedInUser();
        $this->delete('admin/expeditions/' . $expedition->id)
            ->assertResponseStatus(302)
            ->notSeeInDatabase('expeditions', ['id' => $expedition->id]);
    }
}