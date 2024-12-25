<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use App\Models\Seller;
use App\Models\Address;
use App\Models\Coupon;
use App\Models\ShippingFee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $shippingMethods = ['Giao hàng nhanh', 'Giao hàng tiết kiệm', 'Giao hàng hỏa tốc'];

        // Lọc chỉ lấy user có ít nhất một địa chỉ
        $users = User::whereHas('addresses')->get();

        foreach ($users as $user) {
            $orderCount = rand(1, 5); // Mỗi user có từ 1-5 đơn hàng

            for ($i = 0; $i < $orderCount; $i++) {
                $seller = Seller::inRandomOrder()->first();

                // Lấy địa chỉ
                $fromAddress = $seller->addresses()->inRandomOrder()->first();
                $toAddress = $user->addresses()->inRandomOrder()->first();

                Log::info('--------', ['fromAddress' => $fromAddress->province_id, 'toAddress' => $toAddress->province_id]);

                // Xác định phương thức giao hàng
                $shippingMethod = $shippingMethods[array_rand($shippingMethods)];

                // Kiểm tra cùng tỉnh hay khác tỉnh
                $sameProvince = $fromAddress->province == $toAddress->province;

                // Tra cứu phí giao hàng
                $shippingFee = ShippingFee::where('shipping_method', $shippingMethod)
                    ->where('same_province', $sameProvince)
                    ->first();

                // Lấy coupon thuộc seller (nếu có)
                $coupon = Coupon::where('seller_id', $seller->id)->inRandomOrder()->first();

                if ($fromAddress && $toAddress && $shippingFee) {
                    Order::factory()->create([
                        'total_price' => null,
                        'user_id' => $user->id,
                        'seller_id' => $seller->id,
                        'from_address_id' => $fromAddress->id,
                        'to_address_id' => $toAddress->id,
                        'coupon_id' => $coupon ? $coupon->id : null, // Sử dụng coupon nếu có
                        'shipping_fee_id' => $shippingFee->id,       // Gán phí giao hàng
                    ]);
                }
            }
        }
    }
}
