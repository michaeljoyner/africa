<?php

namespace App\Http\Controllers\Admin;

use App\Assocciates\Partner;
use App\Http\Requests\ImageUploadRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PartnerImagesController extends Controller
{
    public function store(ImageUploadRequest $request, Partner $partner)
    {
        $image = $partner->setImage($request->image());

        return $image;
    }
}
