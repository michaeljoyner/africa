<?php

namespace App\Http\Controllers\Admin;

use App\Expeditions\Expedition;
use App\Http\Requests\SimplePublishRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpeditionPublishingController extends Controller
{
    public function update(SimplePublishRequest $request, Expedition $expedition)
    {
        $new_state = $request->publish ? $expedition->publish() : $expedition->retract();

        return response()->json(compact('new_state'));
    }
}
