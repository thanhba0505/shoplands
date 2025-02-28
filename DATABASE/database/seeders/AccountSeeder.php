<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Account;

class AccountSeeder extends Seeder
{
    public function run(): void
    {
        Account::factory()->create([
            'phone' => '789',
            'password' => password_hash('789', PASSWORD_ARGON2I),
            'role' => 'admin',
            'status' => 'active',
        ]);

        for ($i = 0; $i < 5; $i++) {
            if ($i == 0) {
                Account::factory()->create([
                    'phone' => '456',
                    'password' => password_hash('456', PASSWORD_ARGON2I),
                    'role' => 'seller',
                    'status' => 'active',
                ]);
            } else {
                Account::factory()->create([
                    'role' => 'seller',
                    'status' => 'active',
                ]);
            }
        }

        for ($i = 0; $i < 20; $i++) {
            if ($i == 0) {
                Account::factory()->create([
                    'phone' => '123',
                    'password' => password_hash('123', PASSWORD_ARGON2I),
                    'role' => 'user',
                    'status' => 'active',
                ]);
            } else {
                Account::factory()->create([
                    'role' => 'user',
                    'status' => 'active',
                ]);
            }
        }
    }
}
