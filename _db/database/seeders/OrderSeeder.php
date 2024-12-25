<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariant;
use App\Models\User;
use App\Models\Seller;
use App\Models\Coupon;
use App\Models\OrderStatus;
use App\Models\ShippingFee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $shippingMethods = ['Giao hàng nhanh', 'Giao hàng tiết kiệm', 'Giao hàng hỏa tốc'];

        $users = User::whereHas('addresses')->get();

        foreach ($users as $user) {
            $orderCount = rand(-3, 5);

            for ($i = 0; $i < $orderCount; $i++) {
                $seller = Seller::inRandomOrder()->first();

                $fromAddress = $seller->addresses()->inRandomOrder()->first();
                $toAddress = $user->addresses()->inRandomOrder()->first();

                $shippingMethod = $shippingMethods[array_rand($shippingMethods)];
                $sameProvince = $fromAddress->province == $toAddress->province;

                $shippingFee = ShippingFee::where('shipping_method', $shippingMethod)
                    ->where('same_province', $sameProvince)
                    ->first();

                $coupon = Coupon::where('seller_id', $seller->id)->inRandomOrder()->first();

                if ($fromAddress && $toAddress && $shippingFee) {
                    // Tạo đơn hàng
                    $order = Order::factory()->create([
                        'user_id' => $user->id,
                        'seller_id' => $seller->id,
                        'from_address_id' => $fromAddress->id,
                        'to_address_id' => $toAddress->id,
                        'coupon_id' => $coupon ? $coupon->id : null,
                        'shipping_fee_id' => $shippingFee->id,
                        'subtotal_price' => 0,
                        'discount_amount' => 0,
                        'final_price' => 0,
                    ]);

                    $subtotalPrice = 0;
                    $productVariants = ProductVariant::inRandomOrder()->take(rand(1, 5))->get();

                    foreach ($productVariants as $productVariant) {
                        $quantity = rand(1, 5);
                        $price = round($productVariant->price * (rand(80, 99) / 100), -3);

                        OrderItem::create([
                            'order_id' => $order->id,
                            'product_variant_id' => $productVariant->id,
                            'quantity' => $quantity,
                            'price' => $price,
                        ]);

                        $subtotalPrice += $price * $quantity;
                    }

                    // Tính giảm giá từ coupon
                    $discountAmount = 0;
                    if ($coupon) {
                        if ($coupon->discount_type === 'percentage') {
                            $discountAmount = min($subtotalPrice * $coupon->discount_value / 100, $coupon->maximum_discount ?? PHP_INT_MAX);
                        } elseif ($coupon->discount_type === 'fixed') {
                            $discountAmount = min($coupon->discount_value, $coupon->maximum_discount ?? PHP_INT_MAX);
                        }
                    }

                    // Tính tổng tiền cuối cùng
                    $finalPrice = max($subtotalPrice - $discountAmount + $shippingFee->shipping_fee, 0);

                    // Cập nhật các cột
                    $order->update([
                        'subtotal_price' => $subtotalPrice,
                        'discount_amount' => $discountAmount,
                        'final_price' => $finalPrice,
                    ]);

                    // Tạo trạng thái "pending" cho đơn hàng
                    $pendingDate = now();
                    if ($coupon) {
                        $pendingDate = $this->getValidPendingDate($coupon->start_date, $coupon->end_date);
                    }

                    OrderStatus::create([
                        'status' => 'pending',
                        'date_time' => $pendingDate,
                        'order_id' => $order->id,
                    ]);
                }
            }
        }
    }

    private function getValidPendingDate($startDate, $endDate)
    {
        // Lấy ngày hợp lệ nằm trong khoảng thời gian hiệu lực của coupon
        return now()->between($startDate, $endDate) ? now() : $startDate;
    }
}
