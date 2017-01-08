<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactForm;
use App\Mail\MessageReceived;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{

    public function show()
    {
        return view('front.contact.page');
    }

    public function receiveMessage(ContactForm $request)
    {
        Mail::to(config('mail.site_receiver'))->send(new MessageReceived($request->requiredFields()));

        return response()->json('ok');
    }
}
