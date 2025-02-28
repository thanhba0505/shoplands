<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seller;
use App\Models\User;

class SellerSeeder extends Seeder
{
    public function run(): void
    {
        $sellers = [
            [
                'store_name' => 'Thế Giới Thời Trang',
                'owner_name' => 'Phạm Thị Ngọc',
                'bank_name' => 'MB bank',
                'bank_number' => '83659834',
                'status' => 'approved',
                'description' => 'Cung cấp các sản phẩm thời trang cao cấp dành cho nam, nữ và trẻ em.',
                'background' => 'seller-1.jpg',
                'logo' => 'logo-1.jpg',
                'account_id' => 2,
            ],
            [
                'store_name' => 'Phụ Kiện Sành Điệu',
                'owner_name' => 'Hoàng Văn Bình',
                'bank_name' => 'TP bank',
                'bank_number' => '73257326',
                'status' => 'approved',
                'description' => 'Chuyên phụ kiện thời trang, trang sức và đồng hồ.',
                'background' => 'seller-2.jpg',
                'logo' => 'logo-2.jpg',
                'account_id' => 3,
            ],
            [
                'store_name' => 'Công Nghệ Số',
                'owner_name' => 'Nguyễn Thị Hạnh',
                'bank_name' => 'HD bank',
                'bank_number' => '93658993',
                'status' => 'approved',
                'description' => 'Nhà cung cấp thiết bị điện tử, điện thoại và máy tính hàng đầu.',
                'background' => 'seller-3.jpg',
                'logo' => 'logo-3.jpg',
                'account_id' => 4,
            ],
            [
                'store_name' => 'Nhà Cửa Online',
                'owner_name' => 'Trần Văn Minh',
                'bank_name' => 'TP bank',
                'bank_number' => '43658934',
                'status' => 'pending',
                'description' => 'Đầy đủ các sản phẩm phục vụ cho cuộc sống gia đình và nhà cửa.',
                'background' => 'seller-4.jpg',
                'logo' => 'logo-4.jpg',
                'account_id' => 5,
            ],
            [
                'store_name' => 'Thể Thao và Sách',
                'owner_name' => 'Phạm Thị Lan',
                'bank_name' => 'MP bank',
                'bank_number' => '27358923',
                'status' => 'rejected',
                'description' => 'Các sản phẩm thể thao và sách phục vụ nhu cầu giải trí và rèn luyện.',
                'background' => 'seller-5.jpg',
                'logo' => 'logo-5.jpg',
                'account_id' => 6,
            ],
        ];

        foreach ($sellers as $seller) {
            Seller::create($seller);
        }
    }
}
