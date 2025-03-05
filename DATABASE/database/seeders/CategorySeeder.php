<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Thời trang nam', 'slug' => 'thoi-trang-nam', 'image_path' => 'thoi-trang-nam.webp'],
            ['name' => 'Thời trang nữ', 'slug' => 'thoi-trang-nu', 'image_path' => 'thoi-trang-nu.webp'],
            ['name' => 'Thời trang trẻ em', 'slug' => 'thoi-trang-tre-em', 'image_path' => 'thoi-trang-tre-em.webp'],
            ['name' => 'Điện thoại và phụ kiện', 'slug' => 'dien-thoai-va-phu-kien', 'image_path' => 'dien-thoai-va-phu-kien.webp'],
            ['name' => 'Đồng hồ', 'slug' => 'dong-ho', 'image_path' => 'dong-ho.webp'],
            ['name' => 'Máy tính', 'slug' => 'may-tinh', 'image_path' => 'may-tinh.webp'],
            ['name' => 'Nhà cửa đời sống', 'slug' => 'nha-cua-doi-song', 'image_path' => 'nha-cua-doi-song.webp'],
            ['name' => 'Nhà sách online', 'slug' => 'nha-sach-online', 'image_path' => 'nha-sach-online.webp'],
            ['name' => 'Phụ kiện trang sức', 'slug' => 'phu-kien-trang-suc', 'image_path' => 'phu-kien-trang-suc.webp'],
            ['name' => 'Thể thao và du lịch', 'slug' => 'the-thao-va-du-lich', 'image_path' => 'the-thao-va-du-lich.webp'],
            ['name' => 'Thiết bị điện tử', 'slug' => 'thiet-bi-dien-tu', 'image_path' => 'thiet-bi-dien-tu.webp'],
            ['name' => 'Thiết bị gia dụng', 'slug' => 'thiet-bi-gia-dung', 'image_path' => 'thiet-bi-gia-dung.webp'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
