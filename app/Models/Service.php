<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['service', 'detail', 'price', 'duration', 'status', 'category_id'];

    protected $attributes = [

        'service'  => 'Unknown',
        'detail'   => 'Unknown',
        'price'    => 'Unknown',
        'duration' => 'Unknown',
        'status'   => 'Unknown',
    ];
    protected $table      = 'services';

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function onlineorders()
    {
        return $this->belongsTo(Onlineorders::class, 'service_id', 'id');
    }
}
