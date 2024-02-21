<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Appointment extends Model
{
    use HasFactory, Sortable;

    protected $fillable = ['type', 'date', 'time', 'status', 'user_id'];

    protected $attributes = [
        'type'   => 'not selected',
        'date'   => 'not selected',
        'time'   => 'not selected',
        'status' => 'Unknown',
    ];

    protected $table = 'appointments';

    public function details()
    {
        return $this->hasMany(AppointmentDetail::class, 'appointment_id', 'id');
    }

    public function services()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
