<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductImageFactory extends Factory
{
    protected $model = ProductImage::class;

    public function definition(): array
    {
        return [
            'image_path' => 'http://localhost/code-php/shopee/public/uploads/img/cap-sac.webp',
            'product_id' => Product::inRandomOrder()->first()->id,
        ];
    }
}
