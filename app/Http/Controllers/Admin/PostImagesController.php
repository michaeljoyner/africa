<?php

namespace App\Http\Controllers\Admin;

use App\Blog\Post;
use App\Http\Requests\ImageUploadRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostImagesController extends Controller
{
    public function store(ImageUploadRequest $request, Post $post)
    {
        $image = $post->addImage($request->image());

        return response()->json(['location' => $image->getUrl('web')]);
    }
}
