<?php


use App\Assocciates\Sponsor;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SponsorsControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_sponsor_is_correctly_stored()
    {
        $this->asLoggedInUser();
        $this->post('/admin/associates', [
            'name' => 'Sponsosaurus',
            'writeup' => ''
        ])->assertResponseStatus(302)
            ->seeInDatabase('sponsors', [
                'name' => 'Sponsosaurus',
                'writeup' => null
            ]);
    }

    /**
     *@test
     */
    public function a_sponsors_name_and_writeup_are_correctly_updated()
    {
        $sponsor = factory(Sponsor::class)->create();

        $this->asLoggedInUser();
        $this->post('/admin/associates/' . $sponsor->id, [
            'name' => 'Sponsosaurus',
            'writeup' => ''
        ])->assertResponseStatus(302)
            ->seeInDatabase('sponsors', [
                'id' => $sponsor->id,
                'name' => 'Sponsosaurus',
                'writeup' => null
            ]);
    }

    /**
     *@test
     */
    public function a_sponsors_social_links_are_set_to_those_submitted_to_the_update_endpoint()
    {
        $sponsor = factory(Sponsor::class)->create();
        $socialLinks = [
            'twitter' => 'http://twitter.com',
            'facebook' => 'http://facebook.com',
            'email' => 'joe@example.com'
        ];
        $formFields = array_merge([
            'name' => 'Sponsosaurus',
            'writeup' => 'Huge sponsors for you'
        ], $socialLinks);

        $this->asLoggedInUser();
        $this->post('/admin/associates/' . $sponsor->id, $formFields)
            ->assertResponseStatus(302)
            ->seeInDatabase('sponsors', [
                'id' => $sponsor->id,
                'name' => 'Sponsosaurus',
                'writeup' => 'Huge sponsors for you'
            ]);

        $this->assertCount(3, $sponsor->fresh()->socialLinks);

        collect($socialLinks)->each(function($url, $platform) use ($sponsor) {
            $this->seeInDatabase('social_links', [
                'sociable_id' => $sponsor->id,
                'sociable_type' => Sponsor::class,
                'platform' => $platform,
                'url' => $url
            ]);
        });
    }

    /**
     *@test
     */
    public function a_sponsor_is_correctly_deleted()
    {
        $sponsor = factory(Sponsor::class)->create();

        $this->asLoggedInUser();
        $this->delete('/admin/associates/' . $sponsor->id)
            ->assertResponseStatus(302)
            ->notSeeInDatabase('sponsors', ['id' => $sponsor->id]);
    }
}