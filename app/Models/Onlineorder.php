<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Onlineorder extends Model
{
    use HasFactory;
    protected $fillable = ['package','categories','service','address','city','state','zipcode','appointment_time'];

    protected $attributes = [
        'package' => 'not selected',
        'categories' => 'not selected',
        'service' => 'not selected',
        'address' => 'not selected',
        'city' => 'nt selected',
        'state' => 'not selected',
        'zipcode' => '',
        'appointment_time' => 'not selected',
    ];

    protected $table = 'onlineorders';
}
