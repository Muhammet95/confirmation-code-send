<?php

namespace App\Contracts;

interface ConfirmationCodeInterface
{
    public function __construct(string $endpoint);

    public function send(string $confirmation_code);
}
