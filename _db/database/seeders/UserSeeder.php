<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'test user 1',
            'phone' => '123',
            'password' => password_hash('123', PASSWORD_ARGON2I), //seller
        ]);

        User::factory()->create([
            'name' => 'test user 2',
            'phone' => '456',
            'password' => password_hash('123', PASSWORD_ARGON2I),
        ]);

        User::factory()->count(20)->create(); // Tạo 20 người dùng
    }
}
