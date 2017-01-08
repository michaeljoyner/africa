<?php

namespace App\Http\Controllers\Admin\Api;

use App\Gallery\Album;
use App\Http\Requests\ImageUploadRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\MediaLibrary\Media;

class AlbumGalleryImagesController extends Controller
{

    public function index(Album $album)
    {
        return $album->galleryImages($withMain= false)->map(function($image) {
            return $this->imageResponseData($image);
        })->all();
    }

    public function store(ImageUploadRequest $request, Album $album)
    {
        $image = $album->addGalleryImage($request->image());

        return response()->json($this->imageResponseData($image));
    }

    public function delete(Album $album, Media $media)
    {
        if(! $album->galleryImages()->contains($media)) {
            return abort(422, 'Image does not belong to gallery');
        }
        $media->delete();

        return response()->json('ok');
    }

    protected function imageResponseData($image)
    {
        return [
            'image_id' => $image->id,
            'src' => $image->getUrl(),
            'thumb_src' => $image->getUrl('thumb')
        ];
    }
}
