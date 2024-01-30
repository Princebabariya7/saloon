<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Appointment extends Model
{
    use HasFactory, Sortable;

    protected $fillable = ['type', 'date', 'time', 'status', 'user_id', 'service_id'];

    protected $attributes = [
        'type'       => 'not selected',
        'date'       => 'not selected',
        'time'       => 'not selected',
        'status'     => 'Unknown',
    ];

    protected $table = 'appointments';


    public function services()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }
}