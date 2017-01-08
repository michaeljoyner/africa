<?php


use App\Assocciates\Sponsor;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SponsorsTest extends TestCase
{
    use DatabaseMigrations, TestsImageUploads;

    /**
     *@test
     */
    public function a_sponsor_can_be_created_and_persisted()
    {
        $sponsor = factory(Sponsor::class)->create();

        $this->assertInstanceOf(Sponsor::class, $sponsor);
    }

    /**
     *@test
     */
    public function a_sponsor_can_be_published()
    {
        $sponsor = factory(Sponsor::class)->create(['published' => false]);

        $sponsor->publish();

        $this->assertTrue($sponsor->fresh()->published);
    }

    /**
     *@test
     */
    public function a_sponsor_can_be_retracted()
    {
        $sponsor = factory(Sponsor::class)->create(['published' => true]);

        $sponsor->retract();

        $this->assertFalse($sponsor->fresh()->published);
    }

    /**
     *@test
     */
    public function a_sponsor_has_a_model_image()
    {
        $sponsor = factory(Sponsor::class)->create();

        $sponsor->setImage($this->prepareFileUpload('tests/testpic1.png'));

        $this->assertTrue($sponsor->fresh()->hasModelImageSet());

        $sponsor->clearMediaCollection();
    }
}