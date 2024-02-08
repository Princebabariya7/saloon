<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = ['buyer_name','buyer_email'];

    protected $attributes = [
        'buyer_name' => 'not selected',
        'buyer_email' => 'not selected'
    ];
        protected $table = 'payment';
}
