<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Register extends Model
{
    use HasFactory;

    protected $fillable = ['firstname','lastname','dob','mobile','gender','email','password'];

    protected $attributes = [
        'firstname' => 'Unknown', // Set your default value here
        'dob' => '', // Set your default value here
        'mobile' => 'no number', // Set your default value here
        'email' => 'no number', // Set your default value here
        'password' => 'no number', // Set your default value here
     ];


    protected $table = 'register';
//    protected  $primaryKey = 'id';
}
