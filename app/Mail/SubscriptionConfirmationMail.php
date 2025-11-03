<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscriptionConfirmationMail extends Mailable
{
    public $name;
    public $token;

    public function __construct($name, $token)
    {
        $this->name = $name;
        $this->token = $token;
    }

    public function build()
    {
        return $this->subject('Confirm Your Subscription')
                    ->view('emails.subscription_confirmation')
                    ->with([
                        'name' => $this->name,
                        'token' => $this->token,
                    ]);
    }
}

