<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all(); // Lấy tất cả người dùng

        foreach ($users as $user) {
            $reviewedProducts = []; // Mảng để lưu trữ các product_id đã được review

            $count = rand(0, 10); // Số lượng review ngẫu nhiên mà người dùng có thể tạo

            for ($i = 0; $i < $count; $i++) {
                // Lấy một product ngẫu nhiên mà người dùng chưa review
                $product = Product::whereNotIn('id', $reviewedProducts)
                    ->inRandomOrder()
                    ->first();

                // Kiểm tra nếu không tìm thấy sản phẩm thì bỏ qua vòng lặp
                if (!$product) {
                    break;
                }

                // Chọn một product_variant ngẫu nhiên của sản phẩm đó
                $product_variant = ProductVariant::where('product_id', $product->id)
                    ->inRandomOrder()
                    ->first();

                // Kiểm tra nếu không tìm thấy product_variant thì bỏ qua vòng lặp
                if (!$product_variant) {
                    continue;
                }

                // Tạo review
                Review::factory()->create([
                    'user_id' => $user->id,
                    'product_variant_id' => $product_variant->id, // Gắn review cho product_variant
                ]);

                // Lưu product_id vào mảng đã review
                $reviewedProducts[] = $product->id;
            }
        }
    }
}
