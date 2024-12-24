<?php

namespace Database\Seeders;

use App\Models\ProductAttribute;
use Illuminate\Database\Seeder;
use App\Models\ProductAttributeValue;

class ProductAttributeValueSeeder extends Seeder
{
    public function run(): void
    {

        $product_attributes = ProductAttribute::all();

        foreach ($product_attributes as $product_attribute) {
            // Tạo 1 hoặc nhiều chi tiết cho mỗi sản phẩm
            ProductAttributeValue::factory()
                ->count(rand(1, 5))
                ->create([
                    'product_attribute_id' => $product_attribute->id,
                ]);
        }
    }
}
