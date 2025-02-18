<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\ReviewImage;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {

        $product_variants = ProductVariant::all();

        foreach ($product_variants as $product_variant) {
            $a = rand(0, 10);

            if ($a > 5) {
                $b = rand(0, 10);

                for ($i = 0; $i < $b; $i++) {
                    $review = Review::factory()->create([
                        'user_id' => User::inRandomOrder()->first()->id,
                        'product_variant_id' => $product_variant->id,
                    ]);

                    $c = rand(-10, 5);

                    if ($c > 0) {
                        for ($j = 0; $j < $c; $j++) {
                            // Lấy product_id từ product_variant
                            $product_id = $product_variant->product_id; 

                            // Lấy ngẫu nhiên 1 ảnh từ bảng product_images
                            $image = ProductImage::where('product_id', $product_id)
                                ->inRandomOrder()
                                ->first();

                            if ($image) {
                                ReviewImage::create([
                                    'review_id' => $review->id,
                                    'image_path' => $image->image_path, // Lưu đường dẫn ảnh
                                ]);
                            }
                        }
                    }
                }
            }
        }
    }
}
