<?php

namespace App\Broadcasting;

use GuzzleHttp\Client;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class TelegramChannel
{
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toTelegram($notifiable);

        try {
            $response = $this->client->post("https://api.telegram.org/bot".config('parser.bot_token')."/sendMessage", [
                'form_params' => [
                    'chat_id' => $notifiable->telegram_id,
                    'parse_mode' => $message['parse_mode'] ?? 'HTML',
                    'reply_markup' => $message['buttons'] ?? null,
                ]
            ]);

            return $response->getStatusCode() === 200;
        } catch (\Exception $e) {
            Log::error('Telegram send failed: '.$e->getMessage());
            return false;
        }
    }
}
