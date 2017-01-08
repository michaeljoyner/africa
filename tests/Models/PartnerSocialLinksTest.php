<?php


use App\Assocciates\Partner;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PartnerSocialLinksTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_social_link_can_be_added_to_partner()
    {
        $partner = factory(Partner::class)->create();

        $partner->addSocialLink('twitter', 'https://twitter.com/testy');

        $this->assertCount(1, $partner->socialLinks);
        $this->seeInDatabase('social_links', [
            'sociable_id' => $partner->id,
            'sociable_type' => Partner::class,
            'platform' => 'twitter',
            'url' => 'https://twitter.com/testy'
        ]);
    }

    /**
     *@test
     */
    public function a_partner_knows_if_it_has_a_link_to_a_given_platform()
    {
        $partner = factory(Partner::class)->create();
        $partner->addSocialLink('twitter', 'http://twitter.com');

        $this->assertTrue($partner->fresh()->hasSocialLinkFor('twitter'));
    }

    /**
     *@test
     */
    public function a_partners_social_links_can_be_all_set_at_once()
    {
        $partner = factory(Partner::class)->create();
        $socialLinks = [
            'twitter' => 'http://twitter.com',
            'facebook' => 'http://facebook.com',
            'email' => 'joe@example.com'
        ];

        $partner->setAllSocialLinks($socialLinks);

        $this->assertCount(3, $partner->fresh()->socialLinks);

        collect($socialLinks)->each(function($url, $platform) use ($partner) {
           $this->assertTrue($partner->fresh()->hasSocialLinkFor($platform));
        });
    }

    /**
     *@test
     */
    public function deleting_a_partner_also_deletes_their_social_links()
    {
        $partner = factory(Partner::class)->create();
        $link = $partner->addSocialLink('twitter', 'http://twitter.com');

        $partner->delete();

        $this->notSeeInDatabase('social_links', ['id' => $link->id]);
    }
}