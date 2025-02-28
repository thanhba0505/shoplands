<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\ProductVariant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartFactory extends Factory
{
    protected $model = Cart::class;

    public function definition(): array
    {
        return [
            'quantity' => $this->faker->numberBetween(1, 10), // Số lượng từ 1 đến 10
            'user_id' => User::inRandomOrder()->first()->id, // Lấy ngẫu nhiên một user
            'product_variant_id' => ProductVariant::inRandomOrder()->first()->id, // Lấy ngẫu nhiên một product_variant
        ];
    }
}
