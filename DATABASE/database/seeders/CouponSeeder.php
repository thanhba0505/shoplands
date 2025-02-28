<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coupon;
use App\Models\Seller;

class CouponSeeder extends Seeder
{
    public function run()
    {
        // Lấy danh sách tất cả các seller
        $sellers = Seller::all();

        foreach ($sellers as $seller) {
            $couponCount = rand(5, 10);

            for ($i = 0; $i < $couponCount; $i++) {
                Coupon::factory()->create([
                    'seller_id' => $seller->id,
                ]);
            }
        }
    }
}
