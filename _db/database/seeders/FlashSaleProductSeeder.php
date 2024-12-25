<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductVariant;
use App\Models\FlashSaleTime;
use App\Models\FlashSaleProduct;

class FlashSaleProductSeeder extends Seeder
{
    public function run(): void
    {
        // Lấy tất cả sản phẩm variant
        $productVariants = ProductVariant::all();

        // Lấy tất cả các flash sale time
        $flashSaleTimes = FlashSaleTime::all();

        // Lặp qua từng sản phẩm variant
        foreach ($productVariants as $productVariant) {
            $randSale = rand(0, 100);

            // Nếu xác suất ngẫu nhiên lớn hơn 80, sản phẩm này sẽ tham gia flash sale
            if ($randSale > 60) {

                // Chọn ngẫu nhiên số lần tham gia flash sale (giới hạn từ 1 đến 3 lần)
                $saleCount = rand(1, 2); // Mỗi sản phẩm tham gia từ 1 đến 3 flash sale

                // Xáo trộn danh sách flash sale times để đảm bảo không trùng lặp
                $shuffledFlashSaleTimes = $flashSaleTimes->shuffle();

                // Lấy một số lượng flash sale time ngẫu nhiên cho sản phẩm
                $selectedFlashSaleTimes = $shuffledFlashSaleTimes->take($saleCount);

                // Tạo bản ghi flash sale cho sản phẩm với các flash sale time đã chọn
                foreach ($selectedFlashSaleTimes as $flashSaleTime) {
                    FlashSaleProduct::factory()->create([
                        'product_variant_id' => $productVariant->id,
                        'flash_sale_time_id' => $flashSaleTime->id, // Gán thời gian flash sale
                    ]);
                }
            }
        }
    }
}
