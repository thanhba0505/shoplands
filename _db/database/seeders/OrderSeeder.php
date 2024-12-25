<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariant;
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
                    // Tạo đơn hàng
                    $order = Order::factory()->create([
                        'user_id' => $user->id,
                        'seller_id' => $seller->id,
                        'from_address_id' => $fromAddress->id,
                        'to_address_id' => $toAddress->id,
                        'coupon_id' => $coupon ? $coupon->id : null, // Sử dụng coupon nếu có
                        'shipping_fee_id' => $shippingFee->id,       // Gán phí giao hàng
                        'total_price' => 0,                          // Sẽ tính lại sau
                    ]);

                    $totalPrice = 0;

                    // Tạo các OrderItem
                    $productVariants = ProductVariant::inRandomOrder()->take(rand(1, 5))->get(); // Lấy 1-5 sản phẩm

                    foreach ($productVariants as $productVariant) {
                        Log::info($productVariant->id);
                        $quantity = rand(1, 5); // Số lượng mỗi sản phẩm
                        $price = $productVariant->price * (rand(80, 99) / 100); // Giá giảm nhẹ (80%-99%)

                        OrderItem::create([
                            'order_id' => $order->id,
                            'product_variant_id' => $productVariant->id,
                            'quantity' => $quantity,
                            'price' => $price,
                        ]);

                        // Cộng dồn vào tổng giá trị
                        $totalPrice += $price * $quantity;
                    }

                    // Cập nhật total_price cho order
                    $order->update([
                        'total_price' => $totalPrice + $shippingFee->shipping_fee,
                    ]);
                }
            }
        }
    }
}
