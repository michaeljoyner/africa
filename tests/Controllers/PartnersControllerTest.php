<?php


use App\Assocciates\Partner;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PartnersControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function a_partner_is_correctly_stored()
    {
        $this->asLoggedInUser();

        $this->post('/admin/partners', [
            'name'    => 'Plutonic Partner',
            'writeup' => 'This guys, he is so cool, he is no fool.'
        ])->assertResponseStatus(302)
            ->seeInDatabase('partners', [
                'name'    => 'Plutonic Partner',
                'writeup' => 'This guys, he is so cool, he is no fool.'
            ]);
    }

    /**
     * @test
     */
    public function a_partners_name_and_writeup_are_correctly_updated()
    {
        $partner = factory(Partner::class)->create();

        $this->asLoggedInUser();
        $this->post('/admin/partners/' . $partner->id, [
            'name'    => 'A new partner',
            'writeup' => 'That is how disease spreads'
        ])->assertResponseStatus(302)
            ->seeInDatabase('partners', [
                'id'      => $partner->id,
                'name'    => 'A new partner',
                'writeup' => 'That is how disease spreads'
            ]);
    }

    /**
     * @test
     */
    public function social_links_included_in_the_form_are_completely_set_when_updating()
    {
        $partner = factory(Partner::class)->create();
        $socialLinks = [
            'twitter'   => 'http://twitter.com',
            'facebook'  => 'http://facebook.com',
            'email'     => 'joe@example.com',
            'instagram' => '' //should not be included
        ];
        $formData = array_merge([
            'name'    => 'A new partner',
            'writeup' => 'That is how disease spreads',
        ], $socialLinks);

        $this->asLoggedInUser();
        $this->post('/admin/partners/' . $partner->id, $formData)
            ->assertResponseStatus(302)
            ->seeInDatabase('partners', [
                'id'      => $partner->id,
                'name'    => 'A new partner',
                'writeup' => 'That is how disease spreads',
            ]);

        $this->assertCount(3, $partner->fresh()->socialLinks);

        collect($socialLinks)
            ->reject(function ($url) {
                return $url == '';
            })->each(function ($url, $platform) use ($partner) {
                $this->seeInDatabase('social_links', [
                    'sociable_id'   => $partner->id,
                    'sociable_type' => Partner::class,
                    'platform'      => $platform,
                    'url'           => $url
                ]);
            });
    }

    /**
     *@test
     */
    public function a_partner_can_be_deleted()
    {
        $partner = factory(Partner::class)->create();

        $this->asLoggedInUser();
        $this->delete('/admin/partners/' . $partner->id)
            ->assertResponseStatus(302)
            ->notSeeInDatabase('partners', ['id' => $partner->id]);
    }
}