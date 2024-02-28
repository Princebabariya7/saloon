<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Service extends Model
{
    use HasFactory, Sortable;

    protected $fillable = ['name', 'detail', 'price', 'duration', 'image', 'status', 'category_id'];

    protected $attributes = [

        'name'  => 'Unknown',
        'detail'   => 'Unknown',
        'price'    => 'Unknown',
        'duration' => 'Unknown',
        'image' => 'not selected',
        'status'   => 'Unknown',
    ];

    protected $table      = 'services';

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function scopeSearch($query, $search)
    {
        if ($search)
        {
            $query->Where('name', 'LIKE', '%' . $search . '%');
            $query->orwhere('detail', 'LIKE', '%' . $search . '%');
            $query->orwhere('price', 'LIKE', '%' . $search . '%');
            $query->orwhere('duration', 'LIKE', '%' . $search . '%');
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
