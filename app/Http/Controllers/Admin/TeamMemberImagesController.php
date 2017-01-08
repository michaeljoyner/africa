<?php

namespace App\Http\Controllers\Admin;

use App\Assocciates\TeamMember;
use App\Http\Requests\ImageUploadRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeamMemberImagesController extends Controller
{
    public function store(ImageUploadRequest $request, TeamMember $member)
    {
        return $member->setImage($request->image());
    }
}
