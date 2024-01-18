<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'detail', 'duration', 'status'];

    protected $attributes = [
        'name' => 'Unknown', // Set Default value
        'price'       => 'Unknown', // Set Default value
        'detail'       => 'Unknown', // Set Default value
        'duration'     => 'Unknown', // Set Default value
        'status'        => 'Unknown', // Set Default value
    ];

    protected $table = 'packages';

}
