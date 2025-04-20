<?php

declare(strict_types=1);

namespace App\Broadcasting;

use App\Services\LogService;
use GuzzleHttp\Client;
use Illuminate\Notifications\Notification;

class TelegramChannel
{
    private const TELEGRAM_API_BASE_URL = 'https://api.telegram.org/bot';

    public function __construct(
        protected Client $client,
        readonly private LogService $logService
    ) {}

    /**
     * Send notification to Telegram.
     *
     * @param  mixed  $notifiable
     *
     * @throws Exception
     */
    public function send($notifiable, Notification $notification): bool
    {
        $message = $notification->toTelegram($notifiable);

        try {
            $response = $this->client->post(self::TELEGRAM_API_BASE_URL.config('parser.bot_token').'/sendMessage', [
                'form_params' => [
                    'chat_id' => $notifiable->telegram_id,
                    'parse_mode' => $message['parse_mode'] ?? 'HTML',
                    'text' => $message['text'] ?? 'Что то не так с сообщением',
                ],
                'timeout' => 60,
            ]);

            $this->logService->info('Subscriber: '.$notifiable->telegram_id.' has been notified, telegram api responded: '.$response->getStatusCode());

            return $response->getStatusCode() === 200;
        } catch (\Exception $e) {

            throw new \Exception('Telegram send failed: ', 0, $e);
        }
    }
}
