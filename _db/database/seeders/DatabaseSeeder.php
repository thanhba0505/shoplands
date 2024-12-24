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
        // $this->call([ProductImageSeeder::class]);
        // $this->call([ProductDetailSeeder::class]);
        // $this->call([FlashSaleTimeSeeder::class]);
        $this->call([ProductVariantSeeder::class]);
        // $this->call([FlashSaleProductSeeder::class]);
        $this->call([ReviewSeeder::class]);
        $this->call([CartSeeder::class]);

    }
}
