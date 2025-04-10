<?php
declare(strict_types=1);

namespace App\Broadcasting;

use GuzzleHttp\Client;
use Illuminate\Notifications\Notification;


class TelegramChannel
{
    private const TELEGRAM_API_BASE_URL = "https://api.telegram.org/bot";

    protected Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toTelegram($notifiable);

        try {
            $response = $this->client->post(self::TELEGRAM_API_BASE_URL . config('parser.bot_token') . "/sendMessage", [
                'form_params' => [
                    'chat_id' => $notifiable->telegram_id,
                    'parse_mode' => $message['parse_mode'] ?? 'HTML',
                    'reply_markup' => $message['buttons'] ?? null,
                ],
                 'timeout' => 60,
            ]);

            return $response->getStatusCode() === 200;
        } catch (\Exception $e) {
            throw new \Exception('Telegram send failed: ' . $e->getMessage());


        }
    }
}
