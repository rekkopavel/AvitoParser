<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Porduct extends Model
{
    protected $fillable = [
        'title',
        'city',
        'uri',
    ];
}
