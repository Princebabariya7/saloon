<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = ['package','stylist','appointment_time'];

    protected $attributes = [
        'package' => 'Unknown',
        'stylist' => 'Not selected',
        'appointment_time' => 'no appointment',
    ];
    protected $table = 'appointment';
}
