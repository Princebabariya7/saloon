<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Onlineorder extends Model
{
    use HasFactory;

    protected $fillable = ['categories', 'service', 'type', 'date', 'status', 'user_id'];

    protected $attributes = [
        'categories' => 'not selected',
        'service'    => 'not selected',
        'type'       => 'not selected',
        'date'       => 'not selected',
        'status'     => 'not selected',
    ];

    protected $table = 'onlineorders';

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
