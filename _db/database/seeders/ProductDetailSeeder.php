<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductDetail;
use App\Models\Product;

class ProductDetailSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();

        foreach ($products as $product) {
            // Tạo 1 hoặc nhiều chi tiết cho mỗi sản phẩm
            ProductDetail::factory()
                ->count(rand(0, 10))
                ->create([
                    'product_id' => $product->id,
                ]);
        }
    }
}
