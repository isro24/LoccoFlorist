<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Category;
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
            'name' => $this->faker->unique()->words(2, true),
            'description' => $this->faker->sentence(),
            'price' => 50000,
            'status' => true,
            'is_best_seller' => false,
            'image' => 'products/dummy.jpg',
            'admin_id' => Admin::factory(),
            'category_id' => Category::factory(),
        ];
    }
}
