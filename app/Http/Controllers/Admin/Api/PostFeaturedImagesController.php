<?php

namespace App\Http\Controllers\Admin\Api;

use App\Blog\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\MediaLibrary\Media;

class PostFeaturedImagesController extends Controller
{

    public function index(Post $post)
    {
        return $post->getMedia()->map(function($image) {
            return $this->transformImage($image);
        });
    }

    public function store(Request $request, Post $post)
    {
        $this->validate($request, ['file' => 'required|image']);

        $image = $post->addImage($request->file('file'));
        $post->setFeaturedImage($image);

        return response()->json($this->transformImage($image));
    }

    public function update(Request $request, Post $post)
    {
        $this->validate($request, ['image_id' => 'required|integer|exists:media,id']);

        $image = Media::findOrFail($request->image_id);

        $post->setFeaturedImage($image);

        return response()->json($this->transformImage($image));
    }

    protected function transformImage($image)
    {
        return [
            'url' => $image->getUrl(),
            'thumb' => $image->getUrl('thumb'),
            'id' => $image->id,
            'is_feature' => $image->getCustomProperty('is_feature', false)
        ];
    }
}
