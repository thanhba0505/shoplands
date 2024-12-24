<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Province;

class ProvincesTableSeeder extends Seeder
{
    /**
     * Seed the provinces table.
     */
    public function run(): void
    {
        // Tạo 10 bản ghi bằng factory
        Province::factory(10)->create();
    }
}
