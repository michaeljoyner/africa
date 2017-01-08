<?php


use App\Assocciates\TeamMember;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TeamMembersControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_team_member_is_correctly_stored()
    {
        $this->asLoggedInUser();
        $this->post('/admin/members', [
            'name' => 'Spongebob Squarepants',
            'writeup' => 'A legend of his time'
        ])->assertResponseStatus(302)
            ->seeInDatabase('team_members', [
                'name' => 'Spongebob Squarepants',
                'writeup' => 'A legend of his time'
            ]);
    }

    /**
     *@test
     */
    public function a_team_members_name_and_writeup_are_correctly_updated()
    {
        $member = factory(TeamMember::class)->create();

        $this->asLoggedInUser();
        $this->post('/admin/members/' . $member->id, [
            'name' => 'Spongebob Squarepants',
            'writeup' => 'A legend of his time'
        ])->assertResponseStatus(302)
            ->seeInDatabase('team_members', [
                'id' => $member->id,
                'name' => 'Spongebob Squarepants',
                'writeup' => 'A legend of his time'
            ]);
    }

    /**
     *@test
     */
    public function a_team_members_social_links_are_set_to_what_is_submitted_to_update()
    {
        $member = factory(TeamMember::class)->create();
        $socialLinks = [
            'twitter' => 'http://twitter.com',
            'facebook' => 'http://facebook.com',
            'email' => 'joe@example.com'
        ];
        $formFields = array_merge([
            'name' => 'Spongebob',
            'writeup' => 'The spongiest sponge'
        ], $socialLinks);

        $this->asLoggedInUser();
        $this->post('/admin/members/' . $member->id, $formFields)
            ->assertResponseStatus(302)
            ->seeInDatabase('team_members', [
                'id' => $member->id,
                'name' => 'Spongebob',
                'writeup' => 'The spongiest sponge'
            ]);

        $this->assertCount(3, $member->fresh()->socialLinks);

        collect($socialLinks)->each(function($url, $platform) use ($member) {
            $this->seeInDatabase('social_links', [
                'sociable_id' => $member->id,
                'sociable_type' => TeamMember::class,
                'platform' => $platform,
                'url' => $url
            ]);
        });
    }

    /**
     *@test
     */
    public function a_team_member_is_correctly_deleted()
    {
        $member = factory(TeamMember::class)->create();

        $this->asLoggedInUser();
        $this->delete('/admin/members/' . $member->id)
            ->assertResponseStatus(302)
            ->notSeeInDatabase('team_members', ['id' => $member->id]);
    }
}