<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Category extends Model
{
    use HasFactory, Sortable;

    protected $fillable = ['type', 'status'];

    protected $attributes = [
        'type'   => 'Unknown',
        'status' => 'Unknown',
    ];

    protected $table = 'categories';

    public static function getList()
    {
        return ['' => 'Select Category'] + self::pluck('type', 'id')->toArray();
    }

    public function scopeSearch($query, $search)
    {
        if ($search)
        {
            $query->Where('type', 'LIKE', '%' . $search . '%');
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
