<?php


use App\Assocciates\Partner;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PartnerPublishingControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_partner_is_correctly_published()
    {
        $partner = factory(Partner::class)->create(['published' => false]);

        $this->asLoggedInUser();
        $this->post('/admin/partners/' . $partner->id . '/publish', ['publish' => true])
            ->assertResponseOk()
            ->seeJson(['new_state' => true])
            ->seeInDatabase('partners', [
                'id' => $partner->id,
                'published' => 1
            ]);
    }

    /**
     *@test
     */
    public function a_partner_is_correctly_retracted()
    {
        $partner = factory(Partner::class)->create(['published' => true]);

        $this->asLoggedInUser();
        $this->post('/admin/partners/' . $partner->id . '/publish', ['publish' => false])
            ->assertResponseOk()
            ->seeJson(['new_state' => false])
            ->seeInDatabase('partners', [
                'id' => $partner->id,
                'published' => 0
            ]);
    }
}