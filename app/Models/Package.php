<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'detail', 'duration', 'status'];

    protected $attributes = [
        'name' => 'Unknown',
        'price'       => 'Unknown',
        'detail'       => 'Unknown',
        'duration'     => 'Unknown',
        'status'        => 'Unknown',
    ];

    protected $table = 'packages';

}
