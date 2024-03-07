<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingsModel extends Model
{
    protected $fillable = ['setting_key', 'setting_value'];

    protected $attributes = [
        'setting_key'   => 'Unknown',
        'setting_value' => 'Unknown',
    ];

    protected $table = 'settings';
    use HasFactory;
}
