<?php


use App\Assocciates\Sponsor;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SponsorPublishingControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_sponsor_is_correctly_published()
    {
        $sponsor = factory(Sponsor::class)->create(['published' => false]);

        $this->asLoggedInUser();
        $this->post('/admin/associates/' . $sponsor->id . '/publish', ['publish' => true])
            ->assertResponseOk()
            ->seeJson(['new_state' => true])
            ->seeInDatabase('sponsors', [
                'id' => $sponsor->id,
                'published' => 1
            ]);
    }

    /**
     *@test
     */
    public function a_sponsor_is_correctly_retracted()
    {
        $sponsor = factory(Sponsor::class)->create(['published' => true]);

        $this->asLoggedInUser();
        $this->post('/admin/associates/' . $sponsor->id . '/publish', ['publish' => false])
            ->assertResponseOk()
            ->seeJson(['new_state' => false])
            ->seeInDatabase('sponsors', [
                'id' => $sponsor->id,
                'published' => 0
            ]);
    }
}