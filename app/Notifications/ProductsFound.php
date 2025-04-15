<?php

namespace App\Notifications;


use Illuminate\Notifications\Notification;

class ProductsFound extends Notification
{



    public function __construct(readonly private array $products)
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
            fn($item) => "🏙 <b>{$item['city']}</b>: <a href='{$item['uri']}'>{$item['title']}</a>",
            $this->products
        ));


        return [

            'text' => $message,
            'parse_mode' => 'HTML',

        ];
    }

}
