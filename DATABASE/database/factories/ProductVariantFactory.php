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
        $price = $this->faker->randomFloat(0, 10, 2000) * 1000;

        // Giá khuyến mãi (giữ nguyên tỷ lệ giảm giá)
        $promotionPrice = rand(1, 100) > 70 ? round($price * rand(80, 95) / 100, -3) : null;


        return [
            'price' => $price,
            'promotion_price' => $promotionPrice,
            'quantity' => $this->faker->numberBetween(1, 100),
            'sold_quantity' => $this->faker->numberBetween(0, 50),
            'product_id' => Product::inRandomOrder()->first()->id,
        ];
    }
}
