<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Register extends Model
{
    use HasFactory;

    protected $fillable = ['firstname','lastname','dob','mobile','gender','email','password'];


    protected $table = 'register';
}
