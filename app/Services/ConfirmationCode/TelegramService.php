<?php

namespace App\Services\ConfirmationCode;

use App\Contracts\ConfirmationCodeInterface;
use Exception;
use Illuminate\Support\Facades\Log;

class TelegramService extends BaseService implements ConfirmationCodeInterface
{
    public function __construct($endpoint)
    {
        $this->endpoint = $endpoint;
    }

    public function send($confirmation_code)
    {
        Log::debug("Endpoint: " . strlen($this->endpoint));
        $token = env('TELEGRAM_BOT_TOKEN');

        if (!$token)
            throw new Exception('Telegram bot token not found', 404);

        $website="https://api.telegram.org/bot" . $token;
        $params= [
            'chat_id' => trim($this->endpoint),
            'text'=> "Your one-time confirmation code: $confirmation_code",
        ];
        $ch = curl_init($website . '/sendMessage');
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);
    }
}
