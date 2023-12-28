<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = ['package','stylist','appointment_time'];

    protected $attributes = [
        'package' => 'Unknown', // Set your default value here
        'stylist' => 'Not selected', // Set your default value here
        'appointment_time' => 'no appointment', // Set your default value here
    ];
    protected $table = 'appointment';
}
