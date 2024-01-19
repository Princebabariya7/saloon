<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['date_time', 'customer_name', 'address', 'service', 'mode', 'amount', 'status'];

    protected $attributes = [
        'date_time'     => 'Unknown',
        'customer_name' => 'Unknown',
        'address'       => 'Unknown',
        'service'       => 'Unknown',
        'mode'          => 'Unknown',
        'amount'        => 'Unknown',
        'status'        => 'Unknown',
    ];

    protected $table = 'orders';

}

