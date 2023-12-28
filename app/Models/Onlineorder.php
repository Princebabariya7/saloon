<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Onlineorder extends Model
{
    use HasFactory;
    protected $fillable = ['package','categories','service','address','city','state','zipcode','appointment_time'];

    protected $attributes = [
        'package' => 'not selected', // Set your default value here
        'categories' => 'not selected', // Set your default value here
        'service' => 'not selected', // Set your default value here
        'address' => 'not selected', // Set your default value here
        'city' => 'nt selected', // Set your default value here
        'state' => 'not selected', // Set your default value here
        'zipcode' => '', // Set your default value here
        'appointment_time' => 'not selected', // Set your default value here

    ];
    protected $table = 'onlineorders';
}
