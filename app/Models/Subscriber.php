<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Subscriber extends Model
{
    use Notifiable;

    public function routeNotificationForTelegram()
    {
        return $this->telegram_id; // Предполагается, что это поле есть в БД
    }
}
