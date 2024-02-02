<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Category extends Model
{
    protected $fillable = [
        'name'
    ];

    /** @return void  */
    public function products() {
        return $this->belongsToMany('App\Models\Products', 'CategoryProduct', 'product_id',
                                    'category_id');
        // return $this->belongsToMany(Products::class);
    }

        // // Gerenciar IDS das categorias
        // $category = new Category();
        // $category->products->attach(1) - ADicionar
        // $category->products->dettach(1) - Excluir
        // $category->products->sync([1, 2, 3])
}
