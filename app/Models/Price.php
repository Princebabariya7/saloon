<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Price extends Model
{
    use HasFactory, Sortable;

    protected $fillable = ['service', 'price', 'image'];

    protected $attributes = [
        'service' => 'not selected',
        'price' => 'not selected',
        'image' => 'not selected',
    ];
    protected $table = "prices";

}
