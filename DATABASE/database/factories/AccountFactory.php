<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Account;

class AccountFactory extends Factory
{
    protected $model = Account::class;

    public function definition(): array
    {
        return [
            'phone'         => $this->faker->unique()->numerify('09########'), // Random số điện thoại VN
            'password'      => password_hash('123', PASSWORD_ARGON2I), // Mặc định hash password là 'password'
            'role'          => $this->faker->randomElement(['user', 'seller', 'admin']), // Random vai trò
            'status'        => $this->faker->randomElement(['active', 'inactive', 'banned']), // Random trạng thái
            'time_start'    => $this->faker->dateTimeBetween('-5 year', '-1 year'), // Ngày tạo tài khoản
            'access_token'  => null, // Random access token
            'refresh_token' => null, // Random refresh token
        ];
    }
}
