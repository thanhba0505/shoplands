<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Seller;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Log;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $statuses = ['active', 'locked', 'hidden', 'deleted'];

        $rand = rand(1, 100);

        $category = Category::inRandomOrder()->first();
        $category_id = $rand > 80 ? null : ($category ? $category->id : null);


        // Log::info('--------', ['rand' => $rand, 'category_id' => $category_id]);

        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement($statuses),
            'seller_id' => Seller::inRandomOrder()->first()->id,
            'category_id' => $category_id,
        ];
    }
}
