<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    const STATUS_ACTIVE = 'Active';
    const STATUS_INACTIVE = 'Inactive';

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

    public function showImage()
    {
        if (empty($this->image)) {
            return asset('img/empty_image.png');
        }else{
            return asset('storage/'.$this->image);
        }
    }

}
