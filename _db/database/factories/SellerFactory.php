<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SellerFactory extends Factory
{
    protected $model = \App\Models\Seller::class;

    public function definition(): array
    {
        $userIds = User::pluck('id')->toArray();

        return [
            'name' => $this->faker->company(),
            'description' => $this->faker->text(),
            'background' => 'https://www.everydayonsales.com/wp-content/uploads/2023/02/Shopee-Payday-Sale.jpg', // URL nền giả lập
            'logo' => 'https://th.bing.com/th/id/OIP.NWY_ywjL5lqFqUN-J4p1ggHaHa?rs=1&pid=ImgDetMain', // URL logo giả lập
            'user_id' => $this->faker->unique()->randomElement($userIds),
        ];
    }
}
