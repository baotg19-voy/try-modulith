<?php

namespace Modules\Review\App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Review\Database\Factories\ReviewFactory;

class Review extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'product_id',
        'author_name',
        'rating',
        'comment'
    ];

    protected static function newFactory(): ReviewFactory
    {
        return ReviewFactory::new();
    }
}
