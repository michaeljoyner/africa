<?php


use App\Assocciates\TeamMember;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TeamMembersTest extends TestCase
{
    use DatabaseMigrations, TestsImageUploads;

    /**
     *@test
     */
    public function a_team_member_can_be_created_and_persisted()
    {
        $member = factory(TeamMember::class)->create();

        $this->assertInstanceOf(TeamMember::class, $member);
    }

    /**
     *@test
     */
    public function a_team_member_can_be_published()
    {
        $member = factory(TeamMember::class)->create(['published' => false]);

        $member->publish();

        $this->assertTrue($member->fresh()->published);
    }

    /**
     *@test
     */
    public function a_team_member_can_be_retracted()
    {
        $member = factory(TeamMember::class)->create(['published' => true]);

        $member->retract();

        $this->assertFalse($member->fresh()->published);
    }

    /**
     *@test
     */
    public function a_team_member_has_a_model_image()
    {
        $member = factory(TeamMember::class)->create();

        $member->setImage($this->prepareFileUpload('tests/testpic1.png'));

        $this->assertTrue($member->fresh()->hasModelImageSet());

        $member->clearMediaCollection();
    }
}