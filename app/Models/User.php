<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, Sortable;

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

    public function scopeSearch($query, $search)
    {
        if ($search)
        {
            $query->Where('firstname', 'LIKE', '%' . $search . '%');
            $query->orwhere('lastname', 'LIKE', '%' . $search . '%');
            $query->orwhere('email', 'LIKE', '%' . $search . '%');
            $query->orwhere('mobile', 'LIKE', '%' . $search . '%');
            $query->orwhere('user_status', 'LIKE', '%' . $search . '%');
        }
        return $query;
    }

    public function scopeStatus($query, $status)
    {

        if ($status)
        {
            $query->where('user_status', $status);
        }

        return $query;
    }
}
