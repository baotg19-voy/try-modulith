<?php

namespace Modules\Product\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Product\App\Models\Product;
use Modules\Product\App\Models\Review;

class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Review::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::inRandomOrder()->pluck('id')->first(),
            'author_name' => fake()->name(),
            'rating' => fake()->numberBetween(1, 5),
            'comment' => fake()->paragraph()
        ];
    }
}
