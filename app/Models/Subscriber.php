<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


/**
 * @property string $name
 * @property string $telegram_id
 * @property string $mail
 * @property bool $active
 */
class Subscriber extends Model
{
    use Notifiable;

    protected $fillable = [
        'name',
        'telegram_id',
        'mail',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function scopeActive($query):Builder
    {
        return $query->where('active', true);
    }

    public function routeNotificationForTelegram()
    {
        return $this->telegram_id;
    }
}
