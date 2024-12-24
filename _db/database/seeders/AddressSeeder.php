<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Address;

class AddressSeeder extends Seeder
{
    public function run(): void
    {
        Address::factory()->count(30)->create(); // Tạo 10 địa chỉ
    }
}
