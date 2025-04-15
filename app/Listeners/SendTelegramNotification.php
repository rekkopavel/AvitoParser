<?php
declare(strict_types=1);

namespace App\Listeners;

use App\Events\NewProductsFound;
use App\Models\Subscriber;
use App\Notifications\ProductsFound;
use App\Services\LogService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Notification;

class SendTelegramNotification
{

    public function handle(NewProductsFound $event): void
    {

       $logService =  App::make(LogService::class);
        try {
            Notification::send(Subscriber::all(), new ProductsFound($event->products));
        } catch (\Throwable $e){
            $logService->emergency('SendTelegramNotification logs: ', $e);

        }
    }
}
