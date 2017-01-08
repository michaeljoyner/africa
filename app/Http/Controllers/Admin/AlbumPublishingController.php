<?php

namespace App\Http\Controllers\Admin;

use App\Gallery\Album;
use App\Http\Requests\SimplePublishRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AlbumPublishingController extends Controller
{
    public function update(SimplePublishRequest $request, Album $album)
    {
        $new_state = $request->publish ? $album->publish() : $album->retract();

        return response()->json(compact('new_state'));
    }
}
