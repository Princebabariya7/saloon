<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['type','status'];

    protected $attributes = [
        'type' => 'Unknown', // Set Default value
        'status' => 'Unknown', // Set Default value
    ];

    protected $table = 'categories';

}
