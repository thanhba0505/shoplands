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
                'method' => 'Giao hàng nhanh',
                'price' => 25000,
            ],
            [
                'method' => 'Giao hàng tiết kiệm',
                'price' => 10000,
            ],
            [
                'method' => 'Giao hàng hỏa tốc',
                'price' => 70000,
            ],
        ];

        foreach ($data as $item) {
            ShippingFee::create($item);
        }
    }
}
