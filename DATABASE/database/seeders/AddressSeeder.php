<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Seeder;
use App\Models\Address;
use App\Models\User;
use App\Models\Seller;

class AddressSeeder extends Seeder {
    public function run(): void {

        // Thêm địa chỉ cho User
        $sellers = Seller::all();
        foreach ($sellers as $seller) {
            Address::create([
                'address_line' => "72 Thành Thái, Phường 14, Quận 10, Hồ Chí Minh, Vietnam",
                'default' => 1,
                'province_id' => 79,
                'province_name' => "Hồ Chí Minh",
                'district_id' => 771,
                'district_name' => "Quận 10",
                'ward_id' => 27169,
                'ward_name' => "Phường 14",
                'account_id' => $seller->account_id,
            ]);
        }
    }
}
