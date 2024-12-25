<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seller;
use App\Models\User;

class SellerSeeder extends Seeder
{
    public function run(): void
    {
        // Tỷ lệ phần trăm user sẽ trở thành seller
        $percentage = 0.3; // 80% user trở thành seller

        // Lấy danh sách user
        $users = User::all();

        // Lặp qua user và tạo seller
        foreach ($users as $user) {
            // Random dựa trên tỷ lệ
            if (rand(0, 100) <= $percentage * 100) {
                Seller::factory()->create([
                    'user_id' => $user->id,
                ]);
            }
        }
    }
}
