<?php

namespace Database\Factories;

use App\Models\Category;
use app\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->words(3, true),
            'category_id' => $this->faker->numberBetween(1, 4),
            'description' => $this->faker->text(),
            'seller' => $this->faker->name(),
            'price' => $this->faker->randomNumber(7)
        ];
    }
}
