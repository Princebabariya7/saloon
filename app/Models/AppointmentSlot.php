<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentSlot extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'slot', 'appointment_id'];

    protected $attributes = [
        'date'       => 'not selected',
        'slot'       => 'not selected',
    ];

    protected $table = 'appointment_time_slot';


    public function slot()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id', 'id');
    }

}

