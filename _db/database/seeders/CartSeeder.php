<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\ProductVariant;
use App\Models\User;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    public function run(): void
    {
        // Lấy tất cả người dùng
        $users = User::all();

        foreach ($users as $user) {
            // Lấy số lượng giỏ hàng cho mỗi người dùng
            $cartCount = rand(-3, 10); // Mỗi user có từ 1 đến 5 giỏ hàng

            for ($i = 0; $i < $cartCount; $i++) {
                // Lấy ngẫu nhiên một product_variant_id
                $product_variant = ProductVariant::inRandomOrder()->first();

                // Kiểm tra nếu số lượng sản phẩm còn lại lớn hơn 0
                if ($product_variant->quantity > 0) {
                    // Kiểm tra xem giỏ hàng này đã có sản phẩm nào của user chưa
                    if (!Cart::where('user_id', $user->id)
                        ->where('product_variant_id', $product_variant->id)
                        ->exists()) {
                        // Lấy số lượng ngẫu nhiên không vượt quá số lượng còn lại
                        $quantity = rand(1, $product_variant->quantity);

                        // Tạo giỏ hàng mới với số lượng hợp lệ
                        Cart::factory()->create([
                            'user_id' => $user->id,
                            'product_variant_id' => $product_variant->id,
                            'quantity' => $quantity,
                        ]);
                    }
                }
            }
        }
    }
}
