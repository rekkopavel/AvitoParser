<?php

namespace App\Providers;

use App\Broadcasting\TelegramChannel;
use GuzzleHttp\Client;
use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\ServiceProvider;

class NotificationServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->extend(ChannelManager::class, function ($service, $app) {
            $service->extend('telegram', function ($app) {
                return new TelegramChannel($app->make(Client::class), $app->make(\App\Services\LogService::class));
            });

            return $service;
        });
    }

    public function boot(): void
    {
        //
    }
}
