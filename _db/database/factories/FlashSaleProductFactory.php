<?php

namespace Database\Factories;

use App\Models\FlashSaleProduct;
use App\Models\ProductVariant;
use App\Models\FlashSaleTime;
use Illuminate\Database\Eloquent\Factories\Factory;

class FlashSaleProductFactory extends Factory
{
    protected $model = FlashSaleProduct::class;

    public function definition(): array
    {
        return [
            'price' => $this->faker->randomFloat(2, 100, 1000),
            'quantity' => $this->faker->numberBetween(10, 100),
            'sold_quantity' => $this->faker->numberBetween(0, 10),
            'date' => $this->faker->dateTimeBetween('now', '+1 day')->format('Y-m-d'),
            'product_variant_id' => ProductVariant::inRandomOrder()->first()->id,
            'flash_sale_time_id' => FlashSaleTime::inRandomOrder()->first()->id,
        ];
    }
}
