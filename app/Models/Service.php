<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'detail', 'price', 'duration', 'image', 'status', 'category_id'];

    protected $attributes = [

        'name'  => 'Unknown',
        'detail'   => 'Unknown',
        'price'    => 'Unknown',
        'duration' => 'Unknown',
        'image' => 'not selected',
        'status'   => 'Unknown',
    ];

    protected $table      = 'services';

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
