<?php

namespace Modules\Product\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Product\Database\Factories\CategoryFactory;
use Modules\Product\App\Models\Product;

class Category extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = array(
        'name',
        'slug',
    );

    protected static function newFactory(): CategoryFactory
    {
        return CategoryFactory::new();
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
