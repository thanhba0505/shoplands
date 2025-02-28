<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seller;
use App\Models\User;

class SellerSeeder extends Seeder
{
    public function run(): void
    {
        $sellers = [
            [
                'name' => 'Thế Giới Thời Trang',
                'description' => 'Cung cấp các sản phẩm thời trang cao cấp dành cho nam, nữ và trẻ em.',
                'background' => 'seller-1.jpg',
                'logo' => 'logo-1.jpg',
                'user_id' => 2,
            ],
            [
                'name' => 'Phụ Kiện Sành Điệu',
                'description' => 'Chuyên phụ kiện thời trang, trang sức và đồng hồ.',
                'background' => 'seller-2.jpg',
                'logo' => 'logo-2.jpg',
                'user_id' => 4,
            ],
            [
                'name' => 'Công Nghệ Số',
                'description' => 'Nhà cung cấp thiết bị điện tử, điện thoại và máy tính hàng đầu.',
                'background' => 'seller-3.jpg',
                'logo' => 'logo-3.jpg',
                'user_id' => 6,
            ],
            [
                'name' => 'Nhà Cửa Online',
                'description' => 'Đầy đủ các sản phẩm phục vụ cho cuộc sống gia đình và nhà cửa.',
                'background' => 'seller-4.jpg',
                'logo' => 'logo-4.jpg',
                'user_id' => 8,
            ],
            [
                'name' => 'Thể Thao và Sách',
                'description' => 'Các sản phẩm thể thao và sách phục vụ nhu cầu giải trí và rèn luyện.',
                'background' => 'seller-5.jpg',
                'logo' => 'logo-5.jpg',
                'user_id' => 10,
            ],
        ];

        foreach ($sellers as $seller) {
            Seller::create($seller);
        }


        // // Tỷ lệ phần trăm user sẽ trở thành seller
        // $percentage = 0.3; // 80% user trở thành seller

        // // Lấy danh sách user
        // $users = User::all();

        // // Lặp qua user và tạo seller
        // foreach ($users as $user) {
        //     // Random dựa trên tỷ lệ
        //     if ($user->id == 1) {
        //         Seller::factory()->create([
        //             'user_id' => 1,
        //         ]);
        //         continue;
        //     }

        //     if ($user->id == 2) {
        //         continue;
        //     }

        //     if (rand(0, 100) <= $percentage * 100) {
        //         Seller::factory()->create([
        //             'user_id' => $user->id,
        //         ]);
        //     }
        // }
    }
}
