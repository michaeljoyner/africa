<?php


use App\Assocciates\Sponsor;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SponsorImagesControllerTest extends TestCase
{
    use DatabaseMigrations, TestsImageUploads;

    /**
     *@test
     */
    public function an_image_is_correctly_stored_on_the_sponsor()
    {
        $sponsor = factory(Sponsor::class)->create();

        $this->asLoggedInUser();
        $response = $this->call('POST', '/admin/associates/' . $sponsor->id . '/image', [], [], [
            'file' => $this->prepareFileUpload('tests/testpic1.png')
        ]);
        $this->assertEquals(200, $response->status());

        $this->assertTrue($sponsor->fresh()->hasModelImageSet());

        $sponsor->clearMediaCollection();
    }
}