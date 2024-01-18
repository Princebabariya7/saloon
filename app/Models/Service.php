<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['category', 'service', 'detail', 'price', 'duration', 'status','category_id'];

    protected $attributes = [
        'category' => 'Unknown', // Set Default value
        'service'  => 'Unknown', // Set Default value
        'detail'   => 'Unknown', // Set Default value
        'price'    => 'Unknown', // Set Default value
        'duration' => 'Unknown', // Set Default value
        'status'   => 'Unknown', // Set Default value
    ];
    protected $table = 'services';

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

}
