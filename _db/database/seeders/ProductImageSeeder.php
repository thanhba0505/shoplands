<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductImage;
use App\Models\Product;

class ProductImageSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();

        foreach ($products as $product) {
            // Tạo số lượng ảnh ngẫu nhiên
            $images = ProductImage::factory()
                ->count(rand(1, 5))
                ->make([
                    'product_id' => $product->id,
                ]);

            $isFirst = true; // Biến kiểm tra ảnh đầu tiên
            foreach ($images as $image) {
                if ($isFirst) {
                    $image->default = true; // Ảnh đầu tiên là ảnh mặc định
                    $isFirst = false;
                } else {
                    $image->default = false; // Các ảnh còn lại không phải mặc định
                }
                $image->save();
            }
        }
    }
}
