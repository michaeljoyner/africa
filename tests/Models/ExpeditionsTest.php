<?php


use App\Expeditions\Expedition;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ExpeditionsTest extends TestCase
{
    use DatabaseMigrations, TestsImageUploads;

    /**
     *@test
     */
    public function an_expedition_can_be_created_and_persisted()
    {
        $expedition = factory(Expedition::class)->create();

        $this->assertInstanceOf(Expedition::class, $expedition);
    }

    /**
     *@test
     */
    public function an_expedition_can_be_published()
    {
        $expedition = factory(Expedition::class)->create(['published' => false]);

        $expedition->publish();

        $this->assertTrue($expedition->fresh()->published);
    }

    /**
     *@test
     */
    public function an_expedition_can_be_retracted()
    {
        $expedition = factory(Expedition::class)->create(['published' => true]);

        $expedition->retract();

        $this->assertFalse($expedition->fresh()->published);
    }

    /**
     *@test
     */
    public function an_expedition_has_a_model_image()
    {
        $expedition = factory(Expedition::class)->create();
        $expedition->setImage($this->prepareFileUpload('tests/testpic1.png'));

        $this->assertTrue($expedition->fresh()->hasModelImageSet());

        $expedition->clearMediaCollection();
    }

    /**
     *@test
     */
    public function an_expedition_has_a_persistable_end_date()
    {
        $expedition = factory(Expedition::class)->create();

        $expedition->end_date = 'next tuesday';
        $expedition->save();

        $this->assertEquals('next tuesday', $expedition->end_date);
    }
}