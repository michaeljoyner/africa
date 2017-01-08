<?php

namespace App\Http\Controllers;

use App\Expeditions\Expedition;
use App\Http\Requests\ExpeditionSignUpForm;
use App\Mail\SignedUpForExpedition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ExpeditionSignUpController extends Controller
{
    public function handle(ExpeditionSignUpForm $request, $slug)
    {
        $expedition = Expedition::where('slug', $slug)->firstOrFail();

        Mail::to(config('mail.site_receiver'))
            ->send(new SignedUpForExpedition($request->requiredFields(), $expedition));

        return response()->json('ok');
    }
}
