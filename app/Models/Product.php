<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title',
        'city',
        'uri',
        'html',
    ];
    protected $casts = [
        'html' => 'string'
    ];


}
