<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\NewProductsFound;
use App\Models\Subscriber;
use App\Notifications\ProductsFound;
use Illuminate\Support\Facades\Notification;

class SendTelegramNotification
{
    public function handle(NewProductsFound $event): void
    {
        Notification::send(Subscriber::active()->get(), new ProductsFound($event->products));

    }
}
