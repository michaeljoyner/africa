<?php

namespace App\Http\Controllers\Admin;

use App\Compliance\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DocumentFilesController extends Controller
{
    public function store(Request $request, Document $document)
    {
        $this->validate($request, ['file' => 'required|file|mimes:doc,docx,pdf,txt,jpeg,jpg,bmp,png']);

        $document->setFile($request->file('file'));

        return response()->json('ok');
    }
}
