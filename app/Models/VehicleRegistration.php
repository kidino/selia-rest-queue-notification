<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleRegistration extends Model
{
    protected $fillable = [
        'date_reg',
        'type',
        'maker',
        'model',
        'colour',
        'fuel',
        'state'
    ];


    protected $casts = [
        'date_reg' => 'date',
    ];

}
