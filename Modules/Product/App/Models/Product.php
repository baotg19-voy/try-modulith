<?php

namespace Modules\Product\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Product\App\Models\Category;
use Modules\Product\Database\Factories\ProductFactory;

class Product extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = array(
        'name',
        'description',
        'price',
        'category_id',
     );

    protected static function newFactory(): ProductFactory
    {
        return ProductFactory::new();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
