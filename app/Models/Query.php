<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $title
 * @property string $city
 * @property string $uri
 * @property bool $active
 */
class Query extends Model
{
    protected $fillable = [
        'title',
        'city',
        'uri',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function scopeActive($query):Builder
    {
        return $query->where('active', true);
    }

}
