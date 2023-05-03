<?php

namespace App\Services\ConfirmationCode;

use App\Contracts\ConfirmationCodeInterface;
use App\Mail\ConfirmationCode;
use Illuminate\Support\Facades\Mail;

class MailService extends BaseService implements ConfirmationCodeInterface
{
    public function __construct($endpoint)
    {
        $this->endpoint = $endpoint;
    }


    public function send($confirmation_code)
    {
        Mail::to($this->endpoint)->send(new ConfirmationCode($confirmation_code));
    }
}
