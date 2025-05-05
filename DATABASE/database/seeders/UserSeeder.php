<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Nguyễn Văn A',
            'avatar' => 'user-1.jpg',
            'account_id' => 1 + 6
        ]);

        User::create([
            'name' => 'Ngô Thị Hai',
            'avatar' => 'user-2.jpg',
            'account_id' => 2 + 6
        ]);

        User::create([
            'name' => 'Lê Văn Tâm',
            'avatar' => 'user-3.jpg',
            'account_id' => 3 + 6
        ]);

        User::create([
            'name' => 'Phạm Thị Ngọc',
            'avatar' => 'user-4.jpg',
            'account_id' => 4 + 6
        ]);

        User::create([
            'name' => 'Hoàng Văn Bình',
            'avatar' => 'user-5.jpg',
            'account_id' => 5 + 6
        ]);

        User::create([
            'name' => 'Nguyễn Thị Hạnh',
            'avatar' => 'user-6.jpg',
            'account_id' => 6 + 6
        ]);

        User::create([
            'name' => 'Trần Văn Minh',
            'avatar' => 'user-7.jpg',
            'account_id' => 7 + 6
        ]);

        User::create([
            'name' => 'Phạm Thị Lan',
            'avatar' => 'user-8.jpg',
            'account_id' => 8 + 6
        ]);

        User::create([
            'name' => 'Lê Minh Hoàng',
            'avatar' => 'user-9.jpg',
            'account_id' => 9 + 6
        ]);

        User::create([
            'name' => 'Đặng Thị Cẩm',
            'avatar' => 'user-10.jpg',
            'account_id' => 10 + 6
        ]);

        User::create([
            'name' => 'Ngô Văn Sơn',
            'avatar' => 'user-11.jpg',
            'account_id' => 11 + 6
        ]);

        User::create([
            'name' => 'Vũ Thị Yến',
            'avatar' => 'user-12.jpg',
            'account_id' => 12 + 6
        ]);

        User::create([
            'name' => 'Đỗ Văn Khoa',
            'avatar' => 'user-13.jpg',
            'account_id' => 13 + 6
        ]);

        User::create([
            'name' => 'Phan Thị Mai',
            'avatar' => 'user-14.jpg',
            'account_id' => 14 + 6
        ]);

        User::create([
            'name' => 'Lý Văn Hải',
            'avatar' => 'user-15.jpg',
            'account_id' => 15 + 6
        ]);

        User::create([
            'name' => 'Nguyễn Thị Quỳnh',
            'avatar' => 'user-16.jpg',
            'account_id' => 16 + 6
        ]);

        User::create([
            'name' => 'Trần Văn Long',
            'avatar' => 'user-17.jpg',
            'account_id' => 17 + 6
        ]);

        User::create([
            'name' => 'Phạm Thị Thanh',
            'avatar' => 'user-18.jpg',
            'account_id' => 18 + 6
        ]);

        User::create([
            'name' => 'Hoàng Minh Châu',
            'avatar' => 'user-19.jpg',
            'account_id' => 19 + 6
        ]);

        User::create([
            'name' => 'Nguyễn Thị Hoa',
            'avatar' => 'user-20.jpg',
            'account_id' => 20 + 6
        ]);

        // User::count(20)->create(); // Tạo 20 người dùng
    }
}
