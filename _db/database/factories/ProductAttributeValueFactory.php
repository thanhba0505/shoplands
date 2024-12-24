<?php

namespace Database\Factories;

use App\Models\ProductAttributeValue;
use App\Models\ProductAttribute;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductAttributeValueFactory extends Factory
{
    protected $model = ProductAttributeValue::class;

    public function definition(): array
    {
        return [
            'value' => $this->faker->word(),
            'product_attribute_id' => ProductAttribute::inRandomOrder()->first()->id,
        ];
    }
}
