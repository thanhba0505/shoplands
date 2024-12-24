<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([ProvincesTableSeeder::class]);
        $this->call([UserSeeder::class]);
        $this->call([SellerSeeder::class]);
        $this->call([AddressSeeder::class]);
        $this->call([CouponSeeder::class]);
        $this->call([ShippingFeeSeeder::class]);
        $this->call([CategorySeeder::class]);
        $this->call([ProductSeeder::class]);
    }
}
