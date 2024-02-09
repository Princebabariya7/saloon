<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentDetail extends Model
{
    use HasFactory;

    protected $table = 'appointment_detail';
    protected $fillable = ['appointment_id', 'service_id'];

    protected $attributes = [
        'appointment_id'       => 'not selected',
        'service_id'       => 'not selected',
    ];

    public function appointmentDetail()
    {
        return $this->hasMany(Appointment::class, 'appointment_id', 'id');
    }
}
