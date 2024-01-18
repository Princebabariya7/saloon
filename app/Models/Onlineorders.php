<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Onlineorders extends Model
{
    use HasFactory, Sortable;

    protected $fillable = ['categories', 'service', 'type', 'date', 'status', 'user_id', 'service_id'];

    protected $attributes = [
        'categories' => 'not selected',
        'service'    => 'not selected',
        'type'       => 'not selected',
        'date'       => 'not selected',
        'status'     => 'Unknown',
        'service_id' => '1',
    ];

    protected $table = 'onlineorders';

    public function services()
    {
        return $this->hasMany(Service::class,'id','service_id');
    }
}
