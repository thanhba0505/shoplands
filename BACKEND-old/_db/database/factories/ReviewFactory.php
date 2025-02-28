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
        $comment = '';

        if ($this->faker->boolean()) {
            $comment = $this->faker->text(200);
        }

        // Tạo rating dựa trên tỷ lệ
        $rating = $this->generateRating();

        return [
            'rating' => $rating, // Đánh giá ngẫu nhiên theo tỷ lệ
            'comment' => $comment, // Câu bình luận ngẫu nhiên
            'date_time' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'user_id' => User::inRandomOrder()->first()->id, // Lấy ngẫu nhiên user từ bảng users
            'product_variant_id' => ProductVariant::inRandomOrder()->first()->id, // Lấy ngẫu nhiên product_variant từ bảng product_variants
        ];
    }

    private function generateRating(): int
    {
        // Tỷ lệ phân bố
        $distribution = [
            1 => 10, // 1 sao chiếm 15%
            2 => 5,  // 2 sao chiếm 5%
            3 => 5, // 3 sao chiếm 10%
            4 => 20, // 4 sao chiếm 30%
            5 => 60, // 5 sao chiếm 40%
        ];

        // Tạo một số ngẫu nhiên từ 1 đến 100
        $randomNumber = random_int(1, 100);

        // Tính toán rating dựa trên tỷ lệ
        $cumulativeProbability = 0;
        foreach ($distribution as $rating => $probability) {
            $cumulativeProbability += $probability;
            if ($randomNumber <= $cumulativeProbability) {
                return $rating;
            }
        }

        // Trường hợp mặc định (nếu có lỗi)
        return 5;
    }
}
