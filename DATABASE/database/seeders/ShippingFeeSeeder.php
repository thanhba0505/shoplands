<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShippingFee;

class ShippingFeeSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'method' => 'Giao hàng nhanh (2 - 4 ngày',
                'price' => 25000,
            ],
            [
                'method' => 'Giao hàng tiết kiệm (5 - 7 ngày)',
                'price' => 10000,
            ],
            [
                'method' => 'Giao hàng hỏa tốc (8h - 24h)',
                'price' => 70000,
            ],
        ];

        foreach ($data as $item) {
            ShippingFee::create($item);
        }
    }
}
