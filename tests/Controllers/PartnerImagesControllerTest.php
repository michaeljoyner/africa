<?php


use App\Assocciates\Partner;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PartnerImagesControllerTest extends TestCase
{
    use DatabaseMigrations, TestsImageUploads;

    /**
     *@test
     */
    public function an_image_is_correctly_stored_on_the_partner()
    {
        $partner = factory(Partner::class)->create();

        $this->asLoggedInUser();
        $response = $this->call('POST', '/admin/partners/' . $partner->id . '/image', [], [], [
            'file' => $this->prepareFileUpload('tests/testpic1.png')
        ]);
        $this->assertEquals(200, $response->status());

        $this->assertCount(1, $partner->fresh()->getMedia());

        $partner->clearMediaCollection();
    }
}