<?php

namespace App\Models;

use Carbon\Carbon;
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
    public    $sortable   = [
        'type',
        'date',
        'time',
        'status',
    ];

    protected $table = 'appointments';

    public function details()
    {
        return $this->hasMany(AppointmentDetail::class, 'id', 'appointment_id');
    }

    public function services()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('d-m-Y H:i:s');
    }

    public function getUsername()
    {
        return $this->firstname . ' ' . $this->lastname;
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
