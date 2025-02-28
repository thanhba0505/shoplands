<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Address;
use App\Models\User;
use App\Models\Seller;
use App\Models\Province;

class AddressSeeder extends Seeder
{
    public function run(): void
    {
        // Lấy danh sách các tỉnh
        $provinces = Province::all();

        // Thêm địa chỉ cho User
        $users = User::all();
        foreach ($users as $user) {
            $addressCount = rand(-2, 5); // Mỗi user có từ 1-3 địa chỉ

            for ($i = 0; $i < $addressCount; $i++) {
                Address::create([
                    'address_line' => fake()->address(),
                    'default' => $i === 0, // Địa chỉ đầu tiên là mặc định
                    'province_id' => $provinces->random()->id,
                    'user_id' => $user->id,
                    'seller_id' => null, // Không gắn với seller
                ]);
            }
        }

        // Thêm địa chỉ cho Seller
        $sellers = Seller::all();
        foreach ($sellers as $seller) {
            $addressCount = 1; // Mỗi seller có từ 1-3 địa chỉ

            for ($i = 0; $i < $addressCount; $i++) {
                Address::create([
                    'address_line' => fake()->address(),
                    'default' => $i === 0, // Địa chỉ đầu tiên là mặc định
                    'province_id' => $provinces->random()->id,
                    'user_id' => null, // Không gắn với user
                    'seller_id' => $seller->id,
                ]);
            }
        }
    }
}
