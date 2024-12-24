<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FlashSaleTime;

class FlashSaleTimeSeeder extends Seeder
{
    public function run(): void
    {
        // 6 khoảng flash sale cho cả ngày
        FlashSaleTime::create([
            'description' => 'Flash Sale từ 00:00 đến 04:00',
            'time_start' => '00:00:00',
            'time_end' => '04:00:00',
        ]);

        FlashSaleTime::create([
            'description' => 'Flash Sale từ 04:00 đến 08:00',
            'time_start' => '04:00:00',
            'time_end' => '08:00:00',
        ]);

        FlashSaleTime::create([
            'description' => 'Flash Sale từ 08:00 đến 12:00',
            'time_start' => '08:00:00',
            'time_end' => '12:00:00',
        ]);

        FlashSaleTime::create([
            'description' => 'Flash Sale từ 12:00 đến 16:00',
            'time_start' => '12:00:00',
            'time_end' => '16:00:00',
        ]);

        FlashSaleTime::create([
            'description' => 'Flash Sale từ 16:00 đến 20:00',
            'time_start' => '16:00:00',
            'time_end' => '20:00:00',
        ]);

        FlashSaleTime::create([
            'description' => 'Flash Sale từ 20:00 đến 24:00',
            'time_start' => '20:00:00',
            'time_end' => '23:59:59',
        ]);
    }
}
