<?php
declare(strict_types=1);

namespace App\Listeners;

use App\Events\NewProductsfound;
use App\Models\Subscriber;
use App\Notifications\ProductsFound;
use Illuminate\Support\Facades\Notification;

class SendTelegramNotification
{


    public function handle(NewProductsfound $event): void
    {
        Notification::send(Subscriber::all(), new ProductsFound($event->products));
    }
}
