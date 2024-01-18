<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['date_time', 'customer_name', 'address', 'service', 'mode', 'amount', 'status'];

    protected $attributes = [
        'date_time'     => 'Unknown', // Set Default value
        'customer_name' => 'Unknown', // Set Default value
        'address'       => 'Unknown', // Set Default value
        'service'       => 'Unknown', // Set Default value
        'mode'          => 'Unknown', // Set Default value
        'amount'        => 'Unknown', // Set Default value
        'status'        => 'Unknown', // Set Default value
    ];

    protected $table = 'orders';

}

