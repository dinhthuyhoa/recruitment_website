<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegistrationSuccessful extends Mailable
{

    use Queueable, SerializesModels;
    public $checkout;
    public function __construct($checkout)
    {
        $this->checkout = $checkout;
    }
    public function build()
    {

        return $this->view('emails.verify-email')->subject('Registration Successful')->with(['checkout' => $this->checkout]);
    }

}
