<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Subscriber extends Model
{
    use Notifiable;
    protected $fillable = [
        'name',
        'telegram_id',
        'mail',
        'active',
    ];

    public function routeNotificationForTelegram()
    {
        return $this->telegram_id;
    }
}
