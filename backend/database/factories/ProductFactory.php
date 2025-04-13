<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true),
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(2, 10, 999),
            'stock' => $this->faker->numberBetween(0, 100),
            'image' => $this->faker->imageUrl(640, 480, 'products'),
        ];
    }
}
