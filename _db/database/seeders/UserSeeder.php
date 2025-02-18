<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Lê Thanh Bá',
            'phone' => '123',
            'password' => password_hash('123', PASSWORD_ARGON2I),
            'email' => fake()->unique()->safeEmail(),
            'avatar' => 'user-1.jpg',
        ]);

        User::create([
            'name' => 'Phạm Ngọc Tuấn',
            'phone' => '456',
            'password' => password_hash('456', PASSWORD_ARGON2I),
            'email' => null,
            'avatar' => 'user-2.jpg',
        ]);

        User::create([
            'name' => 'Lê Văn Tâm',
            'phone' => '0912345678',
            'password' => password_hash('123', PASSWORD_ARGON2I),
            'email' => fake()->unique()->safeEmail(),
            'avatar' => 'user-3.jpg',
        ]);

        User::create([
            'name' => 'Phạm Thị Ngọc',
            'phone' => '0934567890',
            'password' => password_hash('123', PASSWORD_ARGON2I),
            'email' => null,
            'avatar' => 'user-4.jpg',
        ]);

        User::create([
            'name' => 'Hoàng Văn Bình',
            'phone' => '0901234567',
            'password' => password_hash('123', PASSWORD_ARGON2I),
            'email' => fake()->unique()->safeEmail(),
            'avatar' => 'user-5.jpg',
        ]);

        User::create([
            'name' => 'Nguyễn Thị Hạnh',
            'phone' => '0923456781',
            'password' => password_hash('123', PASSWORD_ARGON2I),
            'email' => null,
            'avatar' => 'user-6.jpg',
        ]);

        User::create([
            'name' => 'Trần Văn Minh',
            'phone' => '0932456782',
            'password' => password_hash('123', PASSWORD_ARGON2I),
            'email' => fake()->unique()->safeEmail(),
            'avatar' => 'user-7.jpg',
        ]);

        User::create([
            'name' => 'Phạm Thị Lan',
            'phone' => '0943456783',
            'password' => password_hash('123', PASSWORD_ARGON2I),
            'email' => null,
            'avatar' => 'user-8.jpg',
        ]);

        User::create([
            'name' => 'Lê Minh Hoàng',
            'phone' => '0953456784',
            'password' => password_hash('123', PASSWORD_ARGON2I),
            'email' => fake()->unique()->safeEmail(),
            'avatar' => 'user-9.jpg',
        ]);

        User::create([
            'name' => 'Đặng Thị Cẩm',
            'phone' => '0963456785',
            'password' => password_hash('123', PASSWORD_ARGON2I),
            'email' => null,
            'avatar' => 'user-10.jpg',
        ]);

        User::create([
            'name' => 'Ngô Văn Sơn',
            'phone' => '0973456786',
            'password' => password_hash('123', PASSWORD_ARGON2I),
            'email' => fake()->unique()->safeEmail(),
            'avatar' => 'user-11.jpg',
        ]);

        User::create([
            'name' => 'Vũ Thị Yến',
            'phone' => '0983456787',
            'password' => password_hash('123', PASSWORD_ARGON2I),
            'email' => null,
            'avatar' => 'user-12.jpg',
        ]);

        User::create([
            'name' => 'Đỗ Văn Khoa',
            'phone' => '0993456788',
            'password' => password_hash('123', PASSWORD_ARGON2I),
            'email' => fake()->unique()->safeEmail(),
            'avatar' => 'user-13.jpg',
        ]);

        User::create([
            'name' => 'Phan Thị Mai',
            'phone' => '0911456789',
            'password' => password_hash('123', PASSWORD_ARGON2I),
            'email' => null,
            'avatar' => 'user-14.jpg',
        ]);

        User::create([
            'name' => 'Lý Văn Hải',
            'phone' => '0922456780',
            'password' => password_hash('123', PASSWORD_ARGON2I),
            'email' => fake()->unique()->safeEmail(),
            'avatar' => 'user-15.jpg',
        ]);

        User::create([
            'name' => 'Nguyễn Thị Quỳnh',
            'phone' => '0932456781',
            'password' => password_hash('123', PASSWORD_ARGON2I),
            'email' => null,
            'avatar' => 'user-16.jpg',
        ]);

        User::create([
            'name' => 'Trần Văn Long',
            'phone' => '0942456782',
            'password' => password_hash('123', PASSWORD_ARGON2I),
            'email' => fake()->unique()->safeEmail(),
            'avatar' => 'user-17.jpg',
        ]);

        User::create([
            'name' => 'Phạm Thị Thanh',
            'phone' => '0952456783',
            'password' => password_hash('123', PASSWORD_ARGON2I),
            'email' => null,
            'avatar' => 'user-18.jpg',
        ]);

        User::create([
            'name' => 'Hoàng Minh Châu',
            'phone' => '0962456784',
            'password' => password_hash('123', PASSWORD_ARGON2I),
            'email' => fake()->unique()->safeEmail(),
            'avatar' => 'user-19.jpg',
        ]);

        User::create([
            'name' => 'Nguyễn Thị Hoa',
            'phone' => '0972456785',
            'password' => password_hash('123', PASSWORD_ARGON2I),
            'email' => null,
            'avatar' => 'user-20.jpg',
        ]);

        // User::count(20)->create(); // Tạo 20 người dùng
    }
}
