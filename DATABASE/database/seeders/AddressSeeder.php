<?php

namespace Database\Seeders;

use App\Models\Account;
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
        $accounts = Account::all();
        foreach ($accounts as $account) {
            $addressCount = rand(1, 5); // Mỗi account có từ 1-3 địa chỉ

            for ($i = 0; $i < $addressCount; $i++) {
                Address::create([
                    'address_line' => fake()->address(),
                    'default' => $i === 0, // Địa chỉ đầu tiên là mặc định
                    'province_id' => $provinces->random()->id,
                    'account_id' => $account->id,
                ]);
            }
        }
    }
}
