<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfirmationCode extends Mailable
{
    use Queueable, SerializesModels;

    protected string $confirmation_code;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($confirmation_code)
    {
        $this->confirmation_code = $confirmation_code;
    }

    public function build()
    {
        return $this->view('mails.confirmation-code', ['confirmation_code' => $this->confirmation_code]);
    }
}
