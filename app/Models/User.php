<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $table = 'users';

    protected $attributes = [
        'user_status' => 'user',
    ];

    protected $fillable = ['firstname', 'lastname', 'mobile', 'gender', 'email', 'password', 'address', 'city', 'state', 'zipcode', 'user_status'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = ['deleted_at'];

    public function appointment()
    {
        return $this->hasMany(Appointment::class, 'user_id', 'id');
    }

    public function appointments()
    {
        return $this->hasMany(AppointmentSlot::class, 'user_id', 'id');
    }
}
