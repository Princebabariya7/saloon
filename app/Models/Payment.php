<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Payment extends Model
{
    use HasFactory, Sortable;

    protected $fillable = ['appointment_id', 'gateway', 'transaction_id', 'transaction_detail', 'status', 'total'];

    protected $attributes = [
        'gateway'            => 'not selected',
        'transaction_id'     => 'not selected',
        'transaction_detail' => 'not selected',
        'status'             => 'not selected',
        'total'              => 'not selected',
    ];
    protected $table      = 'payment';

    public function scopeSearch($query, $search)
    {
        if ($search)
        {
            $query->Where('buyer_name', 'LIKE', '%' . $search . '%');
            $query->orwhere('buyer_email', 'LIKE', '%' . $search . '%');
            $query->orwhere('transaction_id', 'LIKE', '%' . $search . '%');
            $query->orwhere('transaction_detail', 'LIKE', '%' . $search . '%');
            $query->orwhere('status', 'LIKE', '%' . $search . '%');
        }
        return $query;
    }

    public function scopeStatus($query, $status)
    {

        if ($status)
        {
            $query->where('status', $status);
        }

        return $query;
    }


}
