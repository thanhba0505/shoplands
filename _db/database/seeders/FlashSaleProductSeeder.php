<?php

namespace Database\Seeders;

use App\Models\FlashSaleProduct;
use Illuminate\Database\Seeder;

class FlashSaleProductSeeder extends Seeder
{
    public function run(): void
    {
        // Tạo 10 sản phẩm flash sale ngẫu nhiên
        FlashSaleProduct::factory()->count(100)->create();
    }
}
