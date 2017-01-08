<?php


use App\Expeditions\Expedition;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Mail;

class ExpeditionSignUpControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function an_email_is_sent_when_a_person_signs_up_to_a_given_expedition()
    {
        Mail::fake();
        $expedition = factory(Expedition::class)->create();

        $this->post('/expeditions/' . $expedition->slug . '/sign-up', [
            'name' => 'Keen Person',
            'email' => 'keeny@example.com',
            'phone' => '',
            'enquiry' => 'Will I be able to do it without training?'
        ])->assertResponseOk();

        Mail::assertSentTo(config('mail.site_receiver'), \App\Mail\SignedUpForExpedition::class);
        Mail::assertSent(\App\Mail\SignedUpForExpedition::class, function($mail) use ($expedition) {
            return $mail->expedition->id === $expedition->id;
        });
    }
}