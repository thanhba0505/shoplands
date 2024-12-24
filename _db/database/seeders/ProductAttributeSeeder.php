<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductAttribute;

class ProductAttributeSeeder extends Seeder
{
    public function run(): void
    {
        ProductAttribute::factory()
            ->count(10) // Số lượng thuộc tính sản phẩm cần tạo
            ->create();
    }
}
