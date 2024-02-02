<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Thomisticus\NestedAttributes\Traits\HasNestedAttributes;
use App\Traits\AuthTrait;
use Auth;


/**
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property string $description
 * @property Date $created_at
 * @property Date $updated_at
 * @property
 */
class Products extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];
    public function unity()
    {
        return $this->belongsTo(Unity::class);
    }

    /** @return mixed  */
    public function categories() {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id',
                                    'category_id')->withTimestamps();
        //return $this->belongsToMany(CategoryProduct::class);
    }

    // // Gerenciar IDS das categorias
    // $product = new Product();
    // $product->categories->attach(1) - ADicionar
    // $product->categories->dettach() - Excluir
    // $product->categories->sync([...])
}
