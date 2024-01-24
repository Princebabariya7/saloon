<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'status'];

    protected $attributes = [
        'type'   => 'Unknown',
        'status' => 'Unknown',
    ];

    protected $table = 'categories';

    public static function getList()
    {
        return ['' => 'Select Category'] + self::pluck('type', 'id')->toArray();
    }
}
