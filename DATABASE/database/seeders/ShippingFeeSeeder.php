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
                'shipping_method' => 'Giao hàng nhanh',
                'same_province' => true,
                'shipping_fee' => 20000,
            ],
            [
                'shipping_method' => 'Giao hàng nhanh',
                'same_province' => false,
                'shipping_fee' => 30000,
            ],
            [
                'shipping_method' => 'Giao hàng tiết kiệm',
                'same_province' => true,
                'shipping_fee' => 10000,
            ],
            [
                'shipping_method' => 'Giao hàng tiết kiệm',
                'same_province' => false,
                'shipping_fee' => 15000,
            ],
            [
                'shipping_method' => 'Giao hàng hỏa tốc',
                'same_province' => true,
                'shipping_fee' => 70000,
            ],
            [
                'shipping_method' => 'Giao hàng hỏa tốc',
                'same_province' => false,
                'shipping_fee' => 120000,
            ],
        ];

        foreach ($data as $item) {
            ShippingFee::create($item);
        }
    }
}
