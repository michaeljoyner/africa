<?php

namespace App\Http\Controllers\Admin;

use App\Assocciates\Partner;
use App\Http\Requests\SimplePublishRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PartnerPublishingController extends Controller
{
    public function update(SimplePublishRequest $request, Partner $partner)
    {
        $new_state = $request->publish ? $partner->publish() : $partner->retract();

        return response()->json(['new_state' => $new_state]);
    }
}
