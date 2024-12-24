<?php

namespace Database\Factories;

use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CouponFactory extends Factory
{
    protected $model = \App\Models\Coupon::class;

    public function definition(): array
    {
        $sellerId = Seller::inRandomOrder()->first()->id;

        $discountType = $this->faker->randomElement(['percentage', 'fixed']);
        $discountValue = $discountType === 'percentage' ? $this->faker->numberBetween(5, 50) : $this->faker->numberBetween(10, 200);
        $maximumDiscount = $discountType === 'percentage' ? $this->faker->numberBetween(100, 500) : null;
        $minimumOrderValue = $this->faker->numberBetween(100, 1000);
        $usageLimit = $this->faker->numberBetween(1, 100);

        // Ngẫu nhiên chọn ngày trong vòng 1 tháng trước và 1 tháng sau
        $startDate = $this->faker->dateTimeBetween('-1 month', '+1 month');

        // Thêm ngẫu nhiên từ 1 đến 30 ngày vào $startDate để tạo $endDate
        $endDate = \Carbon\Carbon::instance($startDate)->addDays($this->faker->numberBetween(1, 30));

        return [
            'code' => Str::upper(Str::random(10)),
            'description' => $this->faker->sentence(),
            'discount_type' => $discountType,
            'discount_value' => $discountValue,
            'maximum_discount' => $maximumDiscount,
            'minimum_order_value' => $minimumOrderValue,
            'usage_limit' => $usageLimit,
            'usage_count' => $this->faker->numberBetween(0, $usageLimit),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'seller_id' => $sellerId,
        ];
    }
}
