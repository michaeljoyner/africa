<?php

namespace App\Http\Controllers\Admin;

use App\Gallery\Album;
use App\Http\Requests\ImageUploadRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AlbumMainImageController extends Controller
{
    public function store(ImageUploadRequest $request, Album $album)
    {
        return $album->setImage($request->image());
    }
}
