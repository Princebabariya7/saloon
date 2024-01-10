<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    protected $table = 'users';


    use HasApiTokens, HasFactory, Notifiable;

    protected $attributes = [
        'firstname' => 'Unknown',
        'dob'       => '',
        'mobile'    => 'no number',
        'email'     => 'no number',
        'password'  => 'no number',
        'gender'    => 'm',
    ];


    protected $fillable = ['firstname', 'lastname', 'dob', 'mobile', 'gender', 'email', 'password', 'address', 'city', 'state', 'zipcode'];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
