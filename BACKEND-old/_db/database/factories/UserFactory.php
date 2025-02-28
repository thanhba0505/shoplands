<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = \App\Models\User::class;

    public function definition(): array
    {
        return [
            'phone' => '0' . $this->faker->unique()->numerify('#########'),
            'password' => password_hash('123', PASSWORD_ARGON2I),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'avatar' => 'avatar.png', // URL ảnh đại diện giả lập
        ];
    }
}
