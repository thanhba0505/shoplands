<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProvinceFactory extends Factory
{
    /**
     * The name of the corresponding model.
     */
    protected $model = \App\Models\Province::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->state(), // Tạo dữ liệu giả cho cột 'name'
        ];
    }
}
