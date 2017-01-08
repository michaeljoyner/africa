<?php


use App\Assocciates\Partner;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PartnersTest extends TestCase
{
    use DatabaseMigrations, TestsImageUploads;

    /**
     *@test
     */
    public function a_partner_can_be_created_and_persisted()
    {
        $partner = factory(Partner::class)->create();

        $this->assertInstanceOf(Partner::class, $partner);
    }

    /**
     *@test
     */
    public function a_partner_can_be_published()
    {
        $partner = factory(Partner::class)->create(['published' => false]);

        $partner->publish();

        $this->assertTrue($partner->fresh()->published);
    }

    /**
     *@test
     */
    public function a_partner_can_be_retracted()
    {
        $partner = factory(Partner::class)->create(['published' => true]);

        $partner->retract();

        $this->assertFalse($partner->fresh()->published);
    }

    /**
     *@test
     */
    public function a_partner_has_a_model_image()
    {
        $partner = factory(Partner::class)->create();

        $partner->setImage($this->prepareFileUpload('tests/testpic1.png'));

        $this->assertTrue($partner->hasModelImageSet());

        $partner->clearMediaCollection();
    }
}