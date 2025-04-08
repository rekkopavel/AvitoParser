<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProductsFound extends Notification
{
    use Queueable;


    public function __construct(readonly private array $productsLinks)
    {

    }


    public function via(object $notifiable): array
    {
        return ['telegram'];
    }


    public function toTelegram($notifiable): array
    {



        $message = "🔔 <b>Новые объявления!</b>\n\n";
        $message .= implode("\n", array_map(
            fn($item) => "🏙 <b>{$item['city']}</b>: <a href='{$item['link']}'>{$item['title']}</a>",
            $this->productsLinks
        ));


        return [

            'text' => $message,
            'parse_mode' => 'HTML',

        ];
    }

}
