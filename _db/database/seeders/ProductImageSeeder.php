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
            // Tạo từ 1 đến 5 ảnh cho mỗi sản phẩm
            ProductImage::factory()
                ->count(rand(1, 5))
                ->create([
                    'product_id' => $product->id,
                ]);
        }
    }
}
