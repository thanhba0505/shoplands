<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = \App\Models\User::class;

    public function definition(): array
    {
        return [
            'phone' => '0' . $this->faker->unique()->numerify('#########'),
            'password' => bcrypt('123'), // Mật khẩu mặc định
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'avatar' => 'https://th.bing.com/th/id/OIP.NWY_ywjL5lqFqUN-J4p1ggHaHa?rs=1&pid=ImgDetMain', // URL ảnh đại diện giả lập
        ];
    }
}
