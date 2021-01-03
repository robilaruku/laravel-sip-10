<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'id',
        'category_id',
        'name',
        'sku',
        'description',
        'image',
        'price',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(\App\Category::class, 'category_id', 'id');
    }

}
