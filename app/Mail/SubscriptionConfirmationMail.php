<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscriptionConfirmationMail extends Mailable
{
    public $name;
    public $token;
    public $subdomain;

    public function __construct($name, $token, $subdomain)
    {
        $this->name = $name;
        $this->token = $token;
        $this->subdomain = $subdomain; // store it
    }

    public function build()
    {
        $url = route('subscribe.confirmation', [
            'subdomain' => $this->subdomain ?: 'demo', // fallback if null
            'token' => $this->token,
        ]);
        // dd($url);
        return $this->subject('Confirm Your Subscription')
                    ->view('emails.subscription_confirmation')
                    ->with([
                        'name' => $this->name,
                        'confirmationUrl' => $url,
                    ]);
    }
}

