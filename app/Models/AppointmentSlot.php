<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentSlot extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'slot', 'appointment_id'];

    protected $table = 'appointment_time_slot';

}

