<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([ProvincesSeeder::class]); // 63
        $this->call([UserSeeder::class]); // ----------- x = 20
        $this->call([SellerSeeder::class]); // 0.3x
        $this->call([AddressSeeder::class]); // user seler
        $this->call([CouponSeeder::class]); // seller
        $this->call([ShippingFeeSeeder::class]); // 6
        $this->call([CategorySeeder::class]); // 12
        $this->call([ProductSeeder::class]); // ------------ y = 60
        // $this->call([ProductImageSeeder::class]); // product
        // $this->call([ProductDetailSeeder::class]); // product
        // $this->call([FlashSaleTimeSeeder::class]); // 6
        $this->call([ProductVariantSeeder::class]); // product
        // $this->call([ProductAttributeSeeder::class]); // product
        // $this->call([ProductAttributeValueSeeder::class]); // product
        // $this->call([ProductVariantValueSeeder::class]); // product
        // $this->call([FlashSaleProductSeeder::class]); // product_variant
        // $this->call([ReviewSeeder::class]);  // user
        // $this->call([CartSeeder::class]); // user
        // $this->call([OrderSeeder::class]); // user

    }
}
