<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Gallery extends Model
{
    use HasFactory, Sortable;

    protected $fillable = ['name', 'image','status'];

    protected $attributes = [
        'name' => 'Unknown',
        'image'       => 'Unknown',
        'status'        => 'Unknown',
    ];

    protected $table = 'galleries';

    public function scopeSearch($query, $search)
    {
        if ($search)
        {
            $query->Where('name', 'LIKE', '%' . $search . '%');
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
