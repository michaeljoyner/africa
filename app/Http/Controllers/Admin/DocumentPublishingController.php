<?php

namespace App\Http\Controllers\Admin;

use App\Compliance\Document;
use App\Http\Requests\SimplePublishRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DocumentPublishingController extends Controller
{
    public function update(SimplePublishRequest $request, Document $document)
    {
        $new_state = $request->publish ? $document->publish() : $document->retract();

        return response()->json(compact('new_state'));
    }
}
