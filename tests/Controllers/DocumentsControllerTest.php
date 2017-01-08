<?php


use App\Compliance\Document;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DocumentsControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function a_document_is_correctly_stored_with_just_a_title()
    {
        $this->asLoggedInUser();
        $this->post('/admin/documents', ['title' => 'Tax Returns'])
            ->assertResponseStatus(302)
            ->seeInDatabase('documents', ['title' => 'Tax Returns', 'path' => null, 'published' => false]);
    }

    /**
     *@test
     */
    public function a_document_title_is_correctly_updated()
    {
        $document = factory(Document::class)->create();

        $this->asLoggedInUser();
        $this->post('/admin/documents/' . $document->id, ['title' => 'A new doccie'])
            ->assertResponseStatus(302)
            ->seeInDatabase('documents', [
                'id' => $document->id,
                'title' => 'A new doccie'
            ]);
    }

    /**
     *@test
     */
    public function a_document_is_properly_deleted()
    {
        $document = factory(Document::class)->create();

        $this->asLoggedInUser();
        $this->delete('/admin/documents/' . $document->id)
            ->assertResponseStatus(302)
            ->notSeeInDatabase('documents', ['id' => $document->id]);
    }
}