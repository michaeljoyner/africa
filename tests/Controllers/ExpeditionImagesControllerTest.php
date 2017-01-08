<?php


use App\Expeditions\Expedition;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ExpeditionImagesControllerTest extends TestCase
{
    use DatabaseMigrations, TestsImageUploads;

    /**
     *@test
     */
    public function an_image_is_correctly_stored_on_the_expedition()
    {
        $expedition = factory(Expedition::class)->create();

        $this->asLoggedInUser();
        $response = $this->call('POST', '/admin/expeditions/' . $expedition->id . '/image', [], [], [
            'file' => $this->prepareFileUpload('tests/testpic1.png')
        ]);
        $this->assertEquals(200, $response->status());

        $this->assertTrue($expedition->fresh()->hasModelImageSet());

        $expedition->clearMediaCollection();
    }
}