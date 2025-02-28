<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Thời trang nam', 'slug' => 'thoi-trang-nam'],
            ['name' => 'Thời trang nữ', 'slug' => 'thoi-trang-nu'],
            ['name' => 'Thời trang trẻ em', 'slug' => 'thoi-trang-tre-em'],
            ['name' => 'Điện thoại và phụ kiện', 'slug' => 'dien-thoai-va-phu-kien'],
            ['name' => 'Đồng hồ', 'slug' => 'dong-ho'],
            ['name' => 'Máy tính', 'slug' => 'may-tinh'],
            ['name' => 'Nhà cửa đời sống', 'slug' => 'nha-cua-doi-song'],
            ['name' => 'Nhà sách online', 'slug' => 'nha-sach-online'],
            ['name' => 'Phụ kiện trang sức', 'slug' => 'phu-kien-trang-suc'],
            ['name' => 'Thể thao và du lịch', 'slug' => 'the-thao-va-du-lich'],
            ['name' => 'Thiết bị điện tử', 'slug' => 'thiet-bi-dien-tu'],
            ['name' => 'Thiết bị gia dụng', 'slug' => 'thiet-bi-gia-dung'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
