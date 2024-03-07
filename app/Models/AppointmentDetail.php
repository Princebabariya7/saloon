<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class AppointmentDetail extends Model
{
    use HasFactory, Sortable;

    protected $table    = 'appointment_detail';
    protected $fillable = ['appointment_id', 'service_id'];

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

    public function scopeSearch($query, $search)
    {
        if ($search)
        {
            $query->where('users.firstname', 'LIKE', '%' . $search . '%');
            $query->orwhere('users.lastname', 'LIKE', '%' . $search . '%');
            $query->orwhere('appointments.status', 'LIKE', '%' . $search . '%');
            $query->orwhere('appointments.type', 'LIKE', '%' . $search . '%');
            $query->orwhere('services.name', 'LIKE', '%' . $search . '%');
        }
        return $query;
    }

    public function scopeStatusType($query, $status, $type)
    {

        if ($status)
        {
            $query->where('appointments.status', 'LIKE', '%' . $status . '%');
        }

        if ($type)
        {
            $query->where('appointments.type', 'LIKE', '%' . $type . '%');
        }

        return $query;
    }

}
