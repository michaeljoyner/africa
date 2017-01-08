<?php

namespace App\Http\Controllers\Admin;

use App\Expeditions\Expedition;
use App\Http\Requests\ImageUploadRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpeditionImagesController extends Controller
{
    public function store(ImageUploadRequest $request, Expedition $expedition)
    {
        return $expedition->setImage($request->image());
    }
}
