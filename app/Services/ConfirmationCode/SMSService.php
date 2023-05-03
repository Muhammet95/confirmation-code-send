<?php

namespace App\Services\ConfirmationCode;

use App\Contracts\ConfirmationCodeInterface;

class SMSService extends BaseService implements ConfirmationCodeInterface
{
    public function __construct($endpoint)
    {
        $this->endpoint = $endpoint;
    }

    public function send($confirmation_code)
    {
        // TODO: Implement send() method.
    }
}
