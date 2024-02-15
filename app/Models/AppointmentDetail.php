<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentDetail extends Model
{
    use HasFactory;

    protected $table    = 'appointment_detail';
    protected $fillable = ['appointment_id', 'service_id', 'user_id'];

    protected $attributes = [
        'appointment_id' => 'not selected',
        'service_id'     => 'not selected',
    ];

    public function services()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }
    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id', 'id');
    }
}
