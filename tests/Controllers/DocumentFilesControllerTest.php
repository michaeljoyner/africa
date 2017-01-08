<?php


use App\Compliance\Document;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DocumentFilesControllerTest extends TestCase
{
    use DatabaseMigrations, TestsImageUploads;

    public function tearDown()
    {
        foreach(\Illuminate\Support\Facades\Storage::disk('compliance')->files() as $file) {
            \Illuminate\Support\Facades\Storage::disk('compliance')->delete($file);
        }
    }

    /**
     *@test
     */
    public function a_file_is_correctly_stored_on_the_document()
    {
        $document = factory(Document::class)->create();

        $this->asLoggedInUser();
        $response = $this->call('POST', '/admin/documents/' . $document->id . '/file', [], [], [
            'file' => $this->prepareFileUpload('tests/testpdf.pdf')
        ]);
        $this->assertEquals(200, $response->status());

        $this->assertTrue($document->fresh()->hasFile());
    }
}