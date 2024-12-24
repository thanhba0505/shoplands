<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seller;
use App\Models\User;

class SellerSeeder extends Seeder
{
    public function run(): void
    {
        Seller::factory()->count(User::count() - 10)->create(); // Tạo 10 seller
    }
}
