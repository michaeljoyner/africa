<?php


use App\Compliance\Document;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DocumentsTest extends TestCase
{
    use DatabaseMigrations, TestsImageUploads;

    protected $compliance_root_folder;

    public function setUp()
    {
        parent::setUp();

        $this->compliance_root_folder = env('COMPLIANCE_FOLDER');
    }

    public function tearDown()
    {
        foreach(\Illuminate\Support\Facades\Storage::disk('compliance')->files() as $file) {
            \Illuminate\Support\Facades\Storage::disk('compliance')->delete($file);
        }
    }

    /**
     *@test
     */
    public function a_document_can_be_created_and_persisted()
    {
        $document = factory(Document::class)->create();

        $this->assertInstanceOf(Document::class, $document);
    }

    /**
     *@test
     */
    public function a_document_knows_if_its_file_exists()
    {
        $document = factory(Document::class)->create(['path' => null]);

        $this->assertFalse($document->hasFile());
    }

    /**
     *@test
     */
    public function a_file_can_be_set_for_a_document()
    {
        $document = factory(Document::class)->create();

        $document->setFile($this->prepareFileUpload('tests/testpic1.png'));

        $this->assertTrue($document->fresh()->hasFile());
    }

    /**
     *@test
     */
    public function it_gives_the_full_path_to_a_document_file()
    {
        $document = factory(Document::class)->create();
        $document->setFile($this->prepareFileUpload('tests/testpic2.png'));

        $this->assertEquals(public_path($this->compliance_root_folder . '/' . $document->fresh()->path), $document->fresh()->fullPath());
    }

    /**
     *@test
     */
    public function it_gives_the_correct_url_of_a_document_file()
    {
        $document = factory(Document::class)->create(['path' => 'foo.pdf']);

        $this->assertEquals('/' . $this->compliance_root_folder . '/foo.pdf', $document->url());
    }

    /**
     *@test
     */
    public function setting_a_new_file_deletes_any_previous_file()
    {
        $document = factory(Document::class)->create();
        $document->setFile($this->prepareFileUpload('tests/testpic1.png'));
        $firstFile = $document->fresh()->fullPath();

        $document->setFile($this->prepareFileUpload('tests/testpic2.png'));
        $secondFile = $document->fresh()->fullPath();

        $this->assertFalse(file_exists($firstFile));
        $this->assertTrue(file_exists($secondFile));
    }

    /**
     *@test
     */
    public function deleting_a_document_will_also_delete_its_file()
    {
        $document = factory(Document::class)->create();
        $document->setFile($this->prepareFileUpload('tests/testpic1.png'));
        $firstFile = $document->fresh()->fullPath();
        $document->delete();

        $this->assertFalse(file_exists($firstFile));
    }

    /**
     *@test
     */
    public function a_document_can_be_published()
    {
        $document = factory(Document::class)->create(['published' => false]);

        $document->publish();

        $this->assertTrue($document->fresh()->published);
    }

    /**
     *@test
     */
    public function a_document_can_be_retracted()
    {
        $document = factory(Document::class)->create(['published' => true]);

        $document->retract();

        $this->assertFalse($document->fresh()->published);
    }
}