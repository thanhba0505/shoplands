<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductAttributeValue;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductVariantFactory extends Factory
{
    protected $model = ProductVariant::class;

    public function definition(): array
    {
        return [
            'price' => $this->faker->randomFloat(2, 100, 1000),
            'promotion_price' => $this->faker->randomFloat(2, 50, 500),
            'quantity' => $this->faker->numberBetween(1, 100),
            'sold_quantity' => $this->faker->numberBetween(0, 50),
            'product_attribute_value_id' => null,
            'product_id' => null,
        ];
    }
}
