<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\User;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition(): array
    {
        return [
            'rating' => $this->faker->numberBetween(1, 5), // Đánh giá ngẫu nhiên từ 1 đến 5
            'comment' => $this->faker->text(200), // Câu bình luận ngẫu nhiên
            'user_id' => User::inRandomOrder()->first()->id, // Lấy ngẫu nhiên user từ bảng users
            'product_variant_id' => ProductVariant::inRandomOrder()->first()->id, // Lấy ngẫu nhiên product_variant từ bảng product_variants
        ];
    }
}
