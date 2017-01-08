<?php


use App\Assocciates\TeamMember;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TeamMemberSocialLinksTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_team_members_social_links_can_be_assigned()
    {
        $member = factory(TeamMember::class)->create();
        $socialLinks = [
            'twitter' => 'http://twitter.com',
            'facebook' => 'http://facebook.com',
            'email' => 'joe@example.com'
        ];

        $member->setAllSocialLinks($socialLinks);

        $this->assertCount(3, $member->fresh()->socialLinks);

        collect($socialLinks)->each(function($url, $platform) use ($member) {
            $this->assertTrue($member->fresh()->hasSocialLinkFor($platform));
        });
    }
}