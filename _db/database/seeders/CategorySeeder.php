<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Thời trang nam'],
            ['name' => 'Thời trang nữ'],
            ['name' => 'Thời trang trẻ em'],
            ['name' => 'Điện thoại và phụ kiện'],
            ['name' => 'Đồng hồ'],
            ['name' => 'Máy tính'],
            ['name' => 'Nhà cửa đời sống'],
            ['name' => 'Nhà sách online'],
            ['name' => 'Phụ kiện trang sức'],
            ['name' => 'Thể thao và du lịch'],
            ['name' => 'Thiết bị điện tử'],
            ['name' => 'Thiết bị gia dụng'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
