<?php

namespace Modules\Product\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Category\App\Models\Category;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Product\App\Models\Product::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $name = implode(" ", fake()->words(fake()->numberBetween(3, 6)));
        return [
            'name' => $name,
            'description' => fake()->paragraphs(1, true),
            'price' => fake()->randomFloat(2, 10, 1000),
            'category_id' => \Modules\Category\App\Models\Category::inRandomOrder()->pluck('id')->first() ?? 1,
        ];
    }
}
