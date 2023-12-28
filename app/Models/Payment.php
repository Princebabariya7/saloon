<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = ['buyer_name','buyer_email','buyer_address','cd_number','month','year','cvv'];

    protected $attributes = [
        'buyer_name' => 'not selected', // Set your default value here
        'buyer_email' => 'not selected',
        'buyer_address' => 'not selected',
        'cd_number' => 'not selected',
        'month' => 'not selected',
        'year' => 'not selected',
        'cvv' => 'not selected',
    ];
        protected $table = 'payment';
}
