<?php

namespace App\Http\Controllers\Admin;

use App\Assocciates\Sponsor;
use App\Http\Requests\SimplePublishRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SponsorPublishingController extends Controller
{
    public function update(SimplePublishRequest $request, Sponsor $sponsor)
    {
        $new_state = $request->publish ? $sponsor->publish() : $sponsor->retract();

        return response()->json(compact('new_state'));
    }
}
