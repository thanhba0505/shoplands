<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coupon;

class CouponSeeder extends Seeder
{
    public function run()
    {
        Coupon::factory()->count(10)->create(); // Tạo 10 coupon ngẫu nhiên
    }
}
