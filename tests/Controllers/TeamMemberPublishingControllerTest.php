<?php


use App\Assocciates\TeamMember;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TeamMemberPublishingControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function a_team_member_is_correctly_published()
    {
        $member = factory(TeamMember::class)->create(['published' => false]);

        $this->asLoggedInUser();
        $this->post('/admin/members/' . $member->id . '/publish', ['publish' => true])
            ->assertResponseOk()
            ->seeJson(['new_state' => true])
            ->seeInDatabase('team_members', [
                'id'        => $member->id,
                'published' => 1
            ]);
    }

    /**
     *@test
     */
    public function a_team_member_is_correctly_retracted()
    {
        $member = factory(TeamMember::class)->create(['published' => true]);

        $this->asLoggedInUser();
        $this->post('/admin/members/' . $member->id . '/publish', ['publish' => false])
            ->assertResponseOk()
            ->seeJson(['new_state' => false])
            ->seeInDatabase('team_members', [
                'id'        => $member->id,
                'published' => 0
            ]);
    }
}