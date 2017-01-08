<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SignedUpForExpedition extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $phone;
    public $enquiry;
    public $expedition;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($personData, $expedition)
    {
        $this->name = $personData['name'];
        $this->email = $personData['email'];
        $this->phone = $personData['phone'];
        $this->enquiry = $personData['enquiry'];
        $this->expedition = $expedition;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('mail.site_sender'))
            ->subject('Sign up request for ' . $this->expedition->name)
            ->view('email.signup');
    }
}
