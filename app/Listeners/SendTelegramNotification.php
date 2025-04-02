<?php
declare(strict_types=1);

namespace App\Listeners;

use App\Events\NewProductsfound;
use App\Models\Subscriber;
use App\Notifications\ProductsFound;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendTelegramNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewProductsfound $event): void
    {
        Notification::send(Subscriber::all(), new ProductsFound($event->productsLinks));
    }
}
