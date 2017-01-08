<?php

namespace App\Http\Controllers\Admin;

use App\Compliance\Document;
use App\Http\FlashMessaging\Flasher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DocumentsController extends Controller
{

    /**
     * @var Flasher
     */
    private $flasher;

    public function __construct(Flasher $flasher)
    {
        $this->flasher = $flasher;
    }

    public function index()
    {
        $documents = Document::latest()->get();
        return view('admin.documents.index')->with(compact('documents'));
    }

    public function show(Document $document)
    {
        return view('admin.documents.show')->with(compact('document'));
    }

    public function store(Request $request)
    {
        $this->validate($request, ['title' => 'required|max:255']);

        $document = Document::create(['title' => $request->title]);

        $this->flasher->success('Document created', 'The compliance document has been created. Remember to add the file.');

        return redirect('admin/documents/' . $document->id);
    }

    public function edit(Document $document)
    {
        return view('admin.documents.edit')->with(compact('document'));
    }

    public function update(Request $request, Document $document)
    {
        $this->validate($request, ['title' => 'required|max:255']);

        $document->update($request->only('title'));

        $this->flasher->success('Document updated', 'The title of the document has been updated successfully.');

        return redirect('admin/documents/' . $document->id);
    }

    public function delete(Document $document)
    {
        $document->delete();

        $this->flasher->success('Document deleted', 'Like shedding, but with less wasted paper');

        return redirect('admin/documents');
    }
}
