<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = ['buyer_name','buyer_email','appointment_id','gateway','transaction_id','transaction_detail','status'];

    protected $attributes = [
        'buyer_name' => 'not selected',
        'buyer_email' => 'not selected',
        'gateway'=>'not selected',
        'transaction_id'=>'not selected',
        'transaction_detail'=>'not selected',
        'status'=>'not selected',
    ];
        protected $table = 'payment';
}
