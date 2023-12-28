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

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $attributes = [
        'firstname' => 'Unknown', // Set your default value here
        'dob'       => '', // Set your default value here
        'mobile'    => 'no number', // Set your default value here
        'email'     => 'no number', // Set your default value here
        'password'  => 'no number', // Set your default value here
        'gender'    => 'm',
    ];

    protected $fillable = ['firstname', 'lastname', 'dob', 'mobile', 'gender', 'email', 'password'];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
