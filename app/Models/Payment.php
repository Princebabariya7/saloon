<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Payment extends Model
{
    use HasFactory , Sortable;
    protected $fillable = ['buyer_name','buyer_email','appointment_id','gateway','transaction_id','transaction_detail','status','total'];

    protected $attributes = [
        'buyer_name' => 'not selected',
        'buyer_email' => 'not selected',
        'gateway'=>'not selected',
        'transaction_id'=>'not selected',
        'transaction_detail'=>'not selected',
        'status'=>'not selected',
        'total'=>'not selected',
    ];
        protected $table = 'payment';


//    public function getTransactionAmountAttribute()
//    {
//        $transaction_detail = json_decode($this->transaction_detail);
//
//        return $transaction_detail->total;
//    }

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
