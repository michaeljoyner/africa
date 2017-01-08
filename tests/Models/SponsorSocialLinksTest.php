<?php


use App\Assocciates\Sponsor;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SponsorSocialLinksTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_social_link_can_be_added_to_a_sponsor()
    {
        $sponsor = factory(Sponsor::class)->create();

        $sponsor->addSocialLink('facebook', 'https://facebook.com');

        $this->assertCount(1, $sponsor->socialLinks);
        $this->assertTrue($sponsor->fresh()->hasSocialLinkFor('facebook'));
    }

    /**
     *@test
     */
    public function a_sponsors_social_links_can_be_set_all_together()
    {
        $sponsor = factory(Sponsor::class)->create();
        $socialLinks = [
            'twitter' => 'http://twitter.com',
            'facebook' => 'http://facebook.com',
            'email' => 'joe@example.com'
        ];

        $sponsor->setAllSocialLinks($socialLinks);

        $this->assertCount(3, $sponsor->fresh()->socialLinks);

        collect($socialLinks)->each(function($url, $platform) use ($sponsor) {
            $this->assertTrue($sponsor->fresh()->hasSocialLinkFor($platform));
        });
    }

    /**
     *@test
     */
    public function a_social_link_for_a_given_platform_can_be_queried()
    {
        $sponsor = factory(Sponsor::class)->create();
        $sponsor->addSocialLink('twitter', 'http://twitter.com');

        $this->assertEquals('http://twitter.com', $sponsor->fresh()->socialLinkTo('twitter'));
    }
}