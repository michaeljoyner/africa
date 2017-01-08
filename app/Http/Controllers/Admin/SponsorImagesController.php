<?php

namespace App\Http\Controllers\Admin;

use App\Assocciates\Sponsor;
use App\Http\Requests\ImageUploadRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SponsorImagesController extends Controller
{
    public function store(ImageUploadRequest $request, Sponsor $sponsor)
    {
        $image = $sponsor->setImage($request->image());

        return $image;
    }
}
