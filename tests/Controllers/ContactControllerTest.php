<?php


use App\Mail\MessageReceived;
use Illuminate\Support\Facades\Mail;

class ContactControllerTest extends TestCase
{
    /**
     *@test
     */
    public function a_mail_is_sent_when_contact_form_submitted()
    {
        Mail::fake();

        $this->post('/contact', [
            'name' => 'Joe Soap',
            'email' => 'joe@example.com',
            'enquiry' => 'Hello, I like your top arrow button'
        ])->assertResponseOk();

        Mail::assertSentTo(config('mail.site_receiver'), MessageReceived::class);
    }
}