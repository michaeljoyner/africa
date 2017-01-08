<?php


use App\Assocciates\TeamMember;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TeamMemberImagesControllerTest extends TestCase
{
    use DatabaseMigrations, TestsImageUploads;

    /**
     *@test
     */
    public function an_image_is_correctly_stored_on_the_model()
    {
        $member = factory(TeamMember::class)->create();

        $this->asLoggedInUser();
        $response = $this->call('POST', '/admin/members/' . $member->id . '/image', [], [], [
            'file' => $this->prepareFileUpload('tests/testpic1.png')
        ]);
        $this->assertEquals(200, $response->status());

        $this->assertTrue($member->fresh()->hasModelImageSet());

        $member->clearMediaCollection();
    }
}