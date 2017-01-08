<?php


use App\Compliance\Document;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DocumentPublishingControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_document_is_correctly_published()
    {
        $document = factory(Document::class)->create(['published' => false]);

        $this->asLoggedInUser();
        $this->post('/admin/documents/' . $document->id . '/publish', ['publish' => true])
            ->assertResponseOk()
            ->seeJson(['new_state' => true])
            ->seeInDatabase('documents', [
                'id' => $document->id,
                'published' => true
            ]);
    }

    /**
     *@test
     */
    public function a_document_is_correctly_retracted()
    {
        $document = factory(Document::class)->create(['published' => true]);

        $this->asLoggedInUser();
        $this->post('/admin/documents/' . $document->id . '/publish', ['publish' => false])
            ->assertResponseOk()
            ->seeJson(['new_state' => false])
            ->seeInDatabase('documents', [
                'id' => $document->id,
                'published' => false
            ]);
    }
}