

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image','status'];

    protected $attributes = [
        'name' => 'Unknown', // Set Default value
        'image'       => 'Unknown', // Set Default value
        'status'        => 'Unknown', // Set Default value
    ];

    protected $table = 'galleries';

}
