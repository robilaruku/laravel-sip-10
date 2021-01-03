<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    const STATUS_ACTIVE = 'Active';
    const STATUS_INACTIVE = 'Inactive';

    protected $table = 'categories';

    protected $fillable = [
        'id',
        'name',
        'status'
    ];
}
