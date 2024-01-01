<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $fillable = ['service', 'price', 'image'];

    protected $attributes = [
        'service' => 'not selected', // Set your default value here
        'price' => 'not selected', // Set your default value here
        'image' => 'not selected', // Set your default value here
    ];
    protected $table = "prices";

}
