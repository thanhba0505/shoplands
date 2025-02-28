<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use App\Models\Seller;
use App\Models\Address;
use App\Models\ShippingFee;
use App\Models\Coupon;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'subtotal_price' => $this->faker->randomFloat(2, 100, 10000),
            'discount_amount' => $this->faker->randomFloat(2, 100, 10000),
            'final_price' => $this->faker->randomFloat(2, 100, 10000),
            'payment_method' => $this->faker->randomElement(['cod', 'online']),
            'cancel_reason' => null,
            'from_address_id' => Address::factory(), // Sẽ được cập nhật trong Seeder
            'to_address_id' => Address::factory(),   // Sẽ được cập nhật trong Seeder
            'user_id' => User::factory(),            // Sẽ được cập nhật trong Seeder
            'seller_id' => Seller::factory(),        // Sẽ được cập nhật trong Seeder
            'shipping_fee_id' => '1', // Sẽ được cập nhật trong Seeder
            'coupon_id' => '1', // Sẽ được cập nhật trong Seeder
        ];
    }
}
