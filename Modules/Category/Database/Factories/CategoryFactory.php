<?php

namespace Modules\Category\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Category\App\Models\Category::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $wordCount = fake()->numberBetween(3, 10);
        $name = implode(" ", fake()->words($wordCount));
        return [
            'name' => $name,
            'slug' => Str::slug($name)
        ];
    }
}
