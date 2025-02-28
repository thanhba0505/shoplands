<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductDetailFactory extends Factory
{
    protected $model = ProductDetail::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->paragraph(),
            'product_id' => Product::inRandomOrder()->first()->id,
        ];
    }
}
