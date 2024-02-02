<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    use HasFactory;

    protected $table = 'category_product';

    public function products()
    {
        return $this->belongsToMany('App\Models\Products', 'product_id', 'category_id');
    }
}
