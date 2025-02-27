<?php

namespace Database\Seeders;

use App\Models\ProductDetail;
use Illuminate\Database\Seeder;
use App\Models\ProductVariant;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeValue;
use App\Models\ProductImage;
use App\Models\ProductVariantValue;

class ProductVariantSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            1 => [
                'price' => 70000,
                'attributes' => [
                    'Màu sắc' => ['Kem be', 'Đen'],
                    'Size' => ['S', 'M'],
                ],
                'image_count' => 3,
                'details' => [
                    ['Cổ áo', 'Trễ vai'],
                    ['Dịp', 'Hằng Ngày'],
                    ['Kiểu váy', 'Váy xoè'],
                    ['Chiều dài váy', 'Midi'],
                    ['Xuất xứ', 'Việt Nam'],
                    ['Chất liệu', 'Tơ xốp'],
                    ['Mùa', '4 mùa'],
                    ['Tên tổ chức chịu trách nhiệm sản xuất', 'HMStyle'],
                ],
            ],
            2 => [
                'price' => 179000,
                'attributes' => [
                    'Màu sắc' => ['Nâu', 'Đen'],
                    'Size' => ['S', 'M'],
                ],
                'image_count' => 5,
                'details' => [
                    ['Phong cách', 'Basic, Korean, Minimalist, Retro, Sexy'],
                ],
            ],
            3 => [
                'price' => 285000,
                'attributes' => [
                    'Size' => ['S', 'M', 'L'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Kiểu váy', 'Khác'],
                    ['Tên tổ chức chịu trách nhiệm sản xuất', 'Đang cập nhật'],
                    ['Mùa', 'Mùa đông'],
                    ['Loại trang phục', 'Khác'],
                    ['Xuất xứ', 'Trung Quốc'],
                    ['Mẫu', 'Sọc'],
                ],
            ],
            4 => [
                'price' => 175000,
                'attributes' => [
                    'Màu' => ['Đen', 'Trắng'],
                ],
                'image_count' => 3,
                'details' => [
                    ['Kiểu váy', 'Váy chữ A'],
                    ['Tên tổ chức chịu trách nhiệm sản xuất', 'Đang cập nhật'],
                    ['Mùa', 'Mùa hè'],
                    ['Chất liệu', 'Cotton, kaki'],
                    ['Địa chỉ tổ chức chịu trách nhiệm sản xuất', 'Đang cập nhật'],
                    ['Rất lớn', 'Không'],
                    ['Petite', 'Không'],
                    ['Bản eo', 'Khác'],
                    ['Xuất xứ', 'Việt Nam'],
                    ['Mẫu', 'Trơn'],
                ],
            ],
            5 => [
                'price' => 179000,
                'attributes' => [
                    'Màu' => ['Trắng tinh', 'Trắng ngà'],
                    'Size' => ['S', 'M', 'L', 'XL'],
                ],
                'image_count' => 2,
                'details' => [
                    ['Chất liệu', 'Cotton'],
                    ['Tên tổ chức chịu trách nhiệm sản xuất', 'Đang cập nhật'],
                    ['Phong cách', 'Cơ bản, Hàn Quốc, Công sở'],
                    ['Địa chỉ tổ chức chịu trách nhiệm sản xuất', 'Đang cập nhật'],
                    ['Xuất xứ', 'Việt Nam'],
                    ['Mẫu', 'Trơn'],
                    ['Chiều dài tay áo', 'Dài tay'],
                    ['Cropped Top', 'Không'],
                ],
            ],
            6 => [
                'price' => 149000,
                'attributes' => [
                    'Màu' => ['Đen', 'Hồng nhạt', 'Đỏ', 'Trắng', 'Xám', 'Nâu'],
                ],
                'image_count' => 6,
                'details' => [
                    ['Thương hiệu', 'SUNTEE'],
                    ['Chiều dài áo', 'Dài'],
                    ['Xuất xứ', 'Việt Nam'],
                    ['Cổ áo', 'Cổ tròn'],
                    ['Chiều dài tay áo', 'Tay ngắn'],
                    ['Chất liệu', 'Cotton'],
                    ['Rất lớn', 'Có'],
                    ['Sản phẩm đặt theo yêu cầu', 'Không'],
                    ['Mẫu', 'In'],
                    ['Dịp', 'Hằng Ngày'],
                    ['Phong cách', 'Thể thao, Cơ bản, Hàn Quốc, Tối giản'],
                    ['Cropped Top', 'Không'],
                    ['Petite', 'Có'],
                    ['Mùa', '4 mùa'],
                    ['Tên tổ chức chịu trách nhiệm sản xuất', 'Xưởng may SUNTEE'],
                ],
            ],
            7 => [
                'price' => 149000,
                'attributes' => [
                    'Màu' => ['Trắng hồng', 'Xanh đậm', 'Xanh dương', 'Đỏ'],
                    'Size' => ['S', 'M', 'L', 'XL'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Chiều dài áo', 'Ngắn'],
                    ['Xuất xứ', 'Việt Nam'],
                    ['Cổ áo', 'Cổ tròn'],
                    ['Chiều dài tay áo', 'Tay ngắn'],
                    ['Chất liệu', 'Cotton'],
                    ['Cropped Top', 'Không'],
                ],
            ],
            8 => [
                'price' => 790000,
                'attributes' => [
                    'Màu' => ['Ghi tiêu', 'Ghi sữa', 'Đen', 'Xanh than'],
                    'Size' => ['S', 'M', 'L', 'XL', 'XXL', '3XL'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Chiều dài tay áo', 'Dài tay'],
                    ['Địa chỉ tổ chức chịu trách nhiệm sản xuất', 'Đang cập nhật'],
                    ['Mùa', 'Mùa đông'],
                    ['Chất liệu', 'Nỉ'],
                    ['Phong cách', 'Cơ bản, Hàn Quốc, Tối giản'],
                ],
            ],
            9 => [
                'price' => 710000,
                'attributes' => [
                    'Màu' => ['Đen', 'Kaki đậm', 'Kaki nâu nhạt'],
                    'Size' => ['XS', 'S', 'M', 'L', 'XL', 'XXL'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Tên tổ chức chịu trách nhiệm sản xuất', 'Đang cập nhật'],
                    ['Chiều dài tay áo', 'Dài tay'],
                    ['Petite', 'Không'],
                    ['Chất liệu', 'Khác'],
                    ['Địa chỉ tổ chức chịu trách nhiệm sản xuất', 'Đang cập nhật'],
                    ['Rất lớn', 'Không'],
                    ['Sản phẩm đặt theo yêu cầu', 'Không'],
                    ['Phong cách', 'Hàn Quốc'],
                    ['Mẫu', 'Trơn'],
                    ['Xuất xứ', 'Trung Quốc'],
                ],
            ],
            10 => [
                'price' => 136000,
                'attributes' => [
                    'Màu' => ['Hồng', 'Đen'],
                    'Size' => ['S', 'M', 'L', 'XL'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'Lovito'],
                    ['Dịp', 'Hằng Ngày'],
                    ['Rất lớn', 'Không'],
                    ['Kiểu váy', 'Váy chữ A'],
                    ['Chiều dài váy', 'Mini'],
                    ['Chất liệu', '100% Polyester'],
                    ['Mẫu', 'Ditsy Floral'],
                ],
            ],
            11 => [
                'price' => 130000,
                'attributes' => [
                    'Màu' => ['Xám Đậm', 'Đen', 'Nâu'],
                    'Size' => ['S', 'M', 'L', 'XL', 'XXL'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Cổ áo', 'Cổ sơ mi'],
                    ['Xuất xứ', 'Việt Nam'],
                    ['Chiều dài tay áo', 'Tay ngắn'],
                    ['Địa chỉ tổ chức chịu trách nhiệm sản xuất', 'NTHOME PHƯƠNG CANH TỪ LIÊM HÀ NỘI'],
                    ['Chất liệu', 'Kaki'],
                    ['Mẫu', 'BASIC'],
                    ['Tên tổ chức chịu trách nhiệm sản xuất', '20SILK'],
                ],
            ],
            12 => [
                'price' => 120000,
                'attributes' => [
                    'Màu' => ['Đen', 'Xám', 'Kem', 'Than'],
                    'Size' => ['M (42-57kg)', 'L (57-63kg)', 'XL (63-73kg)', 'XXL (73-85kg)', 'XXL (85-95kg)'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Kiểu dáng quần', 'Ống rộng'],
                    ['Xuất xứ', 'Trung Quốc'],
                    ['Phong cách', 'Cơ bản, Nhiệt đới, Thể thao'],
                    ['Cổ áo', 'Cổ tròn'],
                    ['Chất liệu', 'Cotton, Da lộn mỏng'],
                    ['Mẫu', 'Họa tiết, Trơn'],
                    ['Tên tổ chức chịu trách nhiệm sản xuất', 'UMA STORE'],
                ],
            ],
            13 => [
                'price' => 120000,
                'attributes' => [
                    'Màu' => ['Xám Bạc', 'Xanh Brown', 'Black', 'Xanh Retro'],
                    'Size' => ['26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Kiểu dáng quần', 'Ống rộng'],
                    ['Xuất xứ', 'Việt Nam'],
                    ['Phong cách', 'Thể thao, Cơ bản, Hàn Quốc, Đường phố, Nhiệt đới'],
                    ['Cổ áo', 'Cổ tròn'],
                    ['Chất liệu', 'Denim'],
                    ['Mẫu', 'Trơn'],
                ],
            ],
            14 => [
                'price' => 259000,
                'attributes' => [
                    'Màu' => ['Nâu trầm', 'Đen', 'Ghi'],
                    'Size' => ['M (40-55kg)', 'L (56-68kg)', 'XL (69-85kg)'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Kiểu dáng áo', 'Rộng'],
                    ['Xuất xứ', 'Trung Quốc'],
                    ['Phong cách', 'Cơ bản, Hàn Quốc, Công sở, Nhiệt đới'],
                    ['Kiểu nút', 'Hai nút'],
                    ['Chất liệu', 'Flannel nhập Hàn cao cấp'],
                    ['Tall Fit', 'Có'],
                ],
            ],
            15 => [
                'price' => 154000,
                'attributes' => [
                    'Màu' => ['Tiêu', 'Đen', 'Xanh'],
                    'Size' => ['M (42-57kg)', 'L (57-63kg)', 'XL (63-73kg)', 'XXL (73-85kg)'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Xuất xứ', 'Việt Nam'],
                    ['Chất liệu', 'Nỉ'],
                    ['Mẫu', 'Trơn'],
                    ['Chiều dài tay áo', 'Dài tay'],
                    ['Gửi từ', 'Hà Nội'],
                ],
            ],
            16 => [
                'price' => 159000,
                'attributes' => [
                    'Màu' => ['Be', 'Đen', 'Xám Đậm'],
                    'Size' => ['M (42-57kg)', 'L (57-63kg)', 'XL (63-73kg)', 'XXL (73-85kg)'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'LANSBOTER'],
                    ['Chất liệu', 'Đan'],
                    ['Mẫu', 'Trơn'],
                    ['Rất lớn', 'Không'],
                    ['Gửi từ', 'Nước ngoài'],
                ],
            ],
            17 => [
                'price' => 89000,
                'attributes' => [
                    'Màu' => ['Trắng', 'Đen', 'Xanh', 'Bạc Hà'],
                    'Size' => ['M (42-57kg)', 'L (57-63kg)', 'XL (63-73kg)', 'XXL (73-85kg)'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Dáng kiểu áo', 'Rộng'],
                    ['Cổ áo', 'Cổ sơ mi'],
                    ['Kiểu cổ áo', 'Cổ áo truyền thống'],
                    ['Phong cách', 'Thể thao, Cơ bản, Hàn Quốc, Đường phố, Công sở'],
                    ['Xuất xứ', 'Việt Nam'],
                    ['Mẫu', 'Khác, Trơn'],
                    ['Chiều dài tay áo', 'Tay ngắn'],
                    ['Dịp', 'Buổi tiệc'],
                    ['Chất liệu', 'Lụa mềm'],
                    ['Gửi từ', 'TP. Hồ Chí Minh'],
                ],
            ],
            18 => [
                'price' => 169000,
                'attributes' => [
                    'Màu' => ['Trắng', 'Đen', 'Đỏ', 'Be'],
                    'Size' => ['M (42-57kg)', 'L (57-63kg)', 'XL (63-73kg)', 'XXL (73-85kg)'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'ZONEF'],
                    ['Xuất xứ', 'Việt Nam'],
                    ['Mùa', 'Mùa đông'],
                    ['Chất liệu', 'Nỉ'],
                    ['Mẫu', 'Trơn'],
                    ['Gửi từ', 'Hà Nội'],
                ],
            ],
            19 => [
                'price' => 514000,
                'attributes' => [
                    'Màu' => ['Nâu', 'Đen', 'Xanh', 'Be'],
                    'Size' => ['M (42-57kg)', 'L (57-63kg)', 'XL (63-73kg)', 'XXL (73-85kg)'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Phong cách', 'Công sở'],
                    ['Tall Fit', 'Không'],
                    ['Xuất xứ', 'Việt Nam'],
                    ['Dáng kiểu áo', 'Slim'],
                    ['Chất liệu', 'Denim'],
                    ['Mẫu', 'Trơn'],
                    ['Rất lớn', 'Có'],
                    ['Tên tổ chức chịu trách nhiệm sản xuất', 'Đang cập nhật'],
                    ['Gửi từ', 'Hải Phòng'],
                ],
            ],
            20 => [
                'price' => 140000,
                'attributes' => [
                    'Màu' => ['Nâu', 'Đen', 'Xám Ghi', 'Xanh Rêu'],
                    'Size' => ['M (42-57kg)', 'L (57-63kg)', 'XL (63-73kg)', 'XXL (73-85kg)'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Chất liệu', 'Nylon'],
                    ['Mẫu', 'Trơn'],
                    ['Rất lớn', 'Có'],
                    ['Kiểu Áo khoác', 'Áo gió'],
                    ['Gửi từ', 'TP. Hồ Chí Minh'],
                ],

            ],
            21 => [
                'price' => 199000,
                'attributes' => [
                    'Màu' => ['Nâu', 'Đen'],
                    'Size' => ['M (42-57kg)', 'L (57-63kg)', 'XL (63-73kg)', 'XXL (73-85kg)'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Phong cách', 'Thể thao, Hàn Quốc, Đường phố'],
                    ['Cổ áo', 'Cổ tròn'],
                    ['Chất liệu', 'Khác'],
                    ['Mẫu', 'Trơn'],
                    ['Gửi từ', 'Hà Nội'],
                ],
            ],
            22 => [
                'price' => 95000,
                'attributes' => [
                    'Màu' => ['Trắng', 'Đen', 'Đen viền Trắng', 'Trắng viền Đen'],
                    'Size' => ['M (42-57kg)', 'L (57-63kg)', 'XL (63-73kg)', 'XXL (73-85kg)'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Xuất xứ', 'Trung Quốc'],
                    ['Chất liệu', 'Lanh'],
                    ['Cổ áo', 'Cổ sơ mi'],
                    ['Mẫu', 'Sọc, Thêu'],
                    ['Phong cách', 'Cơ bản, Đường phố, Hàn Quốc'],
                    ['Gửi từ', 'Hà Nội'],
                ],
            ],
            23 => [
                'price' => 68000,
                'attributes' => [
                    'Màu' => ['Trắng', 'Đen', 'Xám', 'Xanh Đen'],
                    'Size' => ['M (42-57kg)', 'L (57-63kg)', 'XL (63-73kg)', 'XXL (73-85kg)'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Kiểu dáng quần', 'Ống rộng'],
                    ['Xuất xứ', 'Việt Nam'],
                    ['Phong cách', 'Cơ bản'],
                    ['Loại trang phục', 'Quần, Áo'],
                    ['Mẫu', 'Họa tiết, In'],
                    ['Chiều dài áo', 'Dài'],
                    ['Rất lớn', 'Có'],
                    ['Cổ áo', 'Cổ tròn'],
                    ['Sản phẩm đặt theo yêu cầu', 'Không'],
                    ['Chiều dài tay áo', 'Ngắn tay'],
                    ['Kiểu nút', 'Không'],
                    ['Chất liệu', 'Thun mè'],
                    ['Tên tổ chức chịu trách nhiệm sản xuất', 'thoitrangnamdt'],
                    ['Địa chỉ tổ chức chịu trách nhiệm sản xuất', 'Gò Vấp, HCM'],
                    ['Mùa', 'Bốn mùa'],
                    ['Gửi từ', 'TP. Hồ Chí Minh'],
                ],
            ],
            24 => [
                'price' => 85000,
                'attributes' => [
                    'Màu' => ['Xám', 'Đen', 'Than', 'Ghi'],
                    'Size' => ['M (42-57kg)', 'L (57-63kg)', 'XL (63-73kg)', 'XXL (73-85kg)'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Chiều dài quần', 'Chiều dài đầy đủ'],
                    ['Phong cách', 'Cơ bản'],
                    ['Tall Fit', 'Không'],
                    ['Chất liệu', 'Nỉ'],
                    ['Xuất xứ', 'Việt Nam'],
                    ['Mẫu', 'Trơn'],
                    ['Kiểu dáng quần', 'Đứng'],
                    ['Rất lớn', 'Không'],
                    ['Bản eo', 'Bản to'],
                    ['Gửi từ', 'Hà Nội'],
                ],
            ],
            25 => [
                'price' => 282285,
                'attributes' => [
                    'Màu' => ['Đen nhạt', 'Đen', 'Xanh đậm', 'Xanh da trời'],
                    'Size' => ['29', '30', '31', '32', '33', '34', '35'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'TORANO'],
                    ['Phong cách', 'Cơ bản, Hàn Quốc, Đường phố, Công sở, Nhiệt đới'],
                    ['Mẫu', 'Trơn'],
                    ['Xuất xứ', 'Việt Nam'],
                    ['Chiều dài quần', 'Chiều dài đầy đủ'],
                    ['Chất liệu', 'Jeans'],
                    ['Gửi từ', 'Hà Nội'],
                ],

            ],
            26 => [
                'price' => 109000,
                'attributes' => [
                    'Màu' => ['Trắng', 'Đen', 'Trắng (cao cấp)', 'Đen (cao cấp)'],
                    'Size' => ['M (42-57kg)', 'L (57-63kg)', 'XL (63-73kg)', 'XXL (73-85kg)'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Phong cách', 'Đường phố'],
                    ['Tall Fit', 'Không'],
                    ['Chiều dài áo', 'Dài'],
                    ['Xuất xứ', 'Việt Nam'],
                    ['Chiều dài tay áo', 'Tay ngắn'],
                    ['Dáng kiểu áo', 'Cổ điển'],
                    ['Cổ áo', 'Cổ tròn'],
                    ['Chất liệu', 'Cotton'],
                    ['Mẫu', 'Khác'],
                    ['Mùa', 'Mùa hè'],
                    ['Rất lớn', 'Không'],
                    ['Gửi từ', 'Quảng Ninh'],
                ],
            ],
            27 => [
                'price' => 89000,
                'attributes' => [
                    'Màu' => ['Đen (khóa lộ)', 'Đen (khóa ẩn)'],
                    'Size' => ['M (42-57kg)', 'L (57-63kg)', 'XL (63-73kg)', 'XXL (73-85kg)'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Chiều dài quần', 'Chiều dài đầy đủ'],
                    ['Phong cách', 'Thể thao, Cơ bản, Hàn Quốc, Đường phố, Nhiệt đới'],
                    ['Loại khóa', 'Khóa kéo'],
                    ['Xuất xứ', 'Việt Nam'],
                    ['Mẫu', 'Trơn'],
                    ['Kiểu dáng quần', 'Thường'],
                    ['Rất lớn', 'Có'],
                    ['Bản eo', 'Giữa eo'],
                    ['Gửi từ', 'TP. Hồ Chí Minh'],
                ],
            ],
            28 => [
                'price' => 134000,
                'attributes' => [
                    'Màu' => ['Đen', 'Kem', 'Nâu Bò', 'Xám'],
                    'Size' => ['M (42-57kg)', 'L (57-63kg)', 'XL (63-73kg)', 'XXL (73-85kg)'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'Abandon'],
                    ['Cổ áo', 'Cổ sơ mi'],
                    ['Kiểu cổ áo', 'Có nút'],
                    ['Phong cách', 'Cơ bản'],
                    ['Xuất xứ', 'Việt Nam'],
                    ['Kiểu cổ tay áo', 'Barrel Cuff'],
                    ['Chất liệu', 'Khác'],
                    ['Mẫu', 'Trơn'],
                    ['Chiều dài tay áo', 'Tay ngắn'],
                    ['Dịp', 'Hàng Ngày'],
                    ['Gửi từ', 'Hà Nội'],
                ],
            ],
            29 => [
                'price' => 134000,
                'attributes' => [
                    'Màu' => ['Đen', 'Xanh', 'Xanh Retro', 'Xám'],
                    'Size' => ['26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Chất liệu', 'Denim'],
                    ['Phong cách', 'Hàn Quốc, Đường phố'],
                    ['Bản eo', 'Bản to'],
                    ['Kiểu dáng quần', 'Ống rộng'],
                    ['Chiều dài quần', 'Chiều dài đầy đủ'],
                    ['Mẫu', 'Wash'],
                    ['Gửi từ', 'TP. Hồ Chí Minh'],
                ],
            ],
            30 => [
                'price' => 119000,
                'attributes' => [
                    'Màu' => ['Đen', 'Xám'],
                    'Size' => ['M (42-57kg)', 'L (57-63kg)', 'XL (63-73kg)', 'XXL (73-85kg)'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Chất liệu', 'Denim'],
                    ['Mẫu', 'In'],
                    ['Kiểu Áo khoác', 'Áo khoác bomber'],
                    ['Gửi từ', 'Hải Dương'],
                ],
            ],
            31 => [
                'price' => 109000,
                'attributes' => [
                    'Màu' => ['Caro - Đen', 'Caro - Trắng'],
                    'Size' => ['5 (8-12kg)', '6 (13-17kg)', '7 (18-22kg)', '8 (23-27kg)', '9 (28-32kg)', '10 (33-36kg)'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Mẫu', 'Họa tiết, Sọc caro'],
                    ['Chiều dài áo', 'Short'],
                    ['Sản phẩm đặt theo yêu cầu', 'Đúng'],
                    ['Chất liệu', 'Khác'],
                    ['Độ tuổi khuyến nghị', '3 - 4 tuổi'],
                    ['Tên tổ chức chịu trách nhiệm sản xuất', 'Đang cập nhật'],
                    ['Xuất xứ', 'Việt Nam'],
                    ['Địa chỉ tổ chức chịu trách nhiệm sản xuất', 'Đang cập nhật'],
                    ['Chiều dài tay áo', 'Ngắn Tay'],
                    ['Gửi từ', 'TP. Hồ Chí Minh'],
                ],
            ],
            32 => [
                'price' => 359000,
                'attributes' => [
                    'Màu' => ['Cam', 'Xanh', 'Đen', 'Hồng'],
                    'Size' => ['90 (9-11kg)', '100 (14-16kg)', '120 (21-25kg)', '140 (26-30kg)', '150 (31-35kg)'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'Uni Friend'],
                    ['Xuất xứ', 'Hàn Quốc'],
                    ['Mẫu', 'Họa tiết, Trơn, Sọc'],
                    ['Chủ đề mẫu đồ họa', 'Du lịch'],
                    ['Chất liệu', 'Cotton'],
                    ['Kiểu đóng gói', 'Đơn'],
                    ['Độ tuổi khuyến nghị', 'Lớn'],
                    ['Chiều dài tay áo', 'Ngắn tay'],
                    ['Tên tổ chức chịu trách nhiệm sản xuất', 'GYEONGWON FNV CO.,LTD.'],
                    ['Địa chỉ tổ chức chịu trách nhiệm sản xuất', '133827 KOLON Digital Tower Phase1, 2002~'],
                    ['Gửi từ', 'TP. Hồ Chí Minh'],
                ],

            ],
            33 => [
                'price' => 99000,
                'attributes' => [
                    'Màu' => ['Đen', 'Be', 'Xanh Than', 'Vàng Nâu', 'Trắng', 'Trắng Xanh'],
                    'Size' => ['6 (18-25kg)', '8 (24-27kg)', '10 (28-31kg)', '12 (32-37kg)', '14 (38-45kg)', '16 (46-50kg)'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Mẫu', 'Họa tiết'],
                    ['Chất liệu', 'Cotton'],
                    ['Độ tuổi khuyến nghị', '11 - 12 tuổi'],
                    ['Xuất xứ', 'Việt Nam'],
                    ['Tên tổ chức chịu trách nhiệm sản xuất', 'Hộ kinh doanh cá thể'],
                    ['Địa chỉ tổ chức chịu trách nhiệm sản xuất', 'Nam Định'],
                    ['Gửi từ', 'Nam Định'],
                ],

            ],
            34 => [
                'price' => 239000,
                'attributes' => [
                    'Màu' => ['U4033', 'U4034', '04U35', '04U36'],
                    'Size' => ['90 (9-11kg)', '100 (14-16kg)', '120 (21-25kg)', '140 (26-30kg)', '150 (31-35kg)', '160 (36-40kg)'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'Uni Friend'],
                    ['Mẫu', 'In động vật'],
                    ['Chất liệu', 'Cotton'],
                    ['Xuất xứ', 'Hàn Quốc'],
                    ['Tên tổ chức chịu trách nhiệm sản xuất', 'GYEONGWON FNV CO.,LTD'],
                    ['Địa chỉ tổ chức chịu trách nhiệm sản xuất', '133827 KOLON Digital Tower Phase1, 2002~'],
                    ['Gửi từ', 'TP. Hồ Chí Minh'],
                ],

            ],
            35 => [
                'price' => 20000,
                'attributes' => [
                    'Màu' => ['Labubu Hồng', 'Phi hành gia', 'Minion', 'Labubu xám'],
                    'Size' => ['2 (4-6kg)', '3 (6-8kg)', '4 (8-10kg)', '5 (10-12kg)', '6 (13-15kg)'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Chất liệu', 'Thun tăm lạnh'],
                    ['Gửi từ', 'TP. Hồ Chí Minh'],
                ],
            ],
            36 => [
                'price' => 631000,
                'attributes' => [
                    'Màu' => ['Hồng', 'Be'],
                    'Size' => ['90 (9-11kg)', '100 (14-16kg)', '120 (21-25kg)', '140 (26-30kg)', '150 (31-35kg)', '160 (36-40kg)'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Chất liệu', 'Cotton'],
                    ['Gửi từ', 'Nước ngoài'],
                ],
            ],
            37 => [
                'price' => 360000,
                'attributes' => [
                    'Màu' => ['Vàng', 'Xanh Ngọc'],
                    'Size' => ['90 (9-11kg)', '100 (14-16kg)', '120 (21-25kg)', '140 (26-30kg)', '150 (31-35kg)', '160 (36-40kg)'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Xuất xứ', 'Việt Nam'],
                    ['Gửi từ', 'Hà Nội'],
                ],
            ],
            38 => [
                'price' => 170000,
                'attributes' => [
                    'Màu' => ['Công an vàng', 'Công an xanh', 'Hải quân'],
                    'Size' => ['1 (8-10kg)', '2 (11-12kg)', '3 (13-14kg)', '4 (15-16kg)', '5 (17-18kg)', '6 (19-20kg)'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Gửi từ', 'TP. Hồ Chí Minh'],
                ],
            ],
            39 => [
                'price' => 105000,
                'attributes' => [
                    'Màu' => ['Trắng', 'Xám Xanh'],
                    'Size' => ['6 (18-25kg)', '8 (24-27kg)', '10 (28-31kg)', '12 (32-37kg)'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Mẫu', 'Họa tiết'],
                    ['Chiều dài áo', 'Short'],
                    ['Sản phẩm đặt theo yêu cầu', 'Đúng'],
                    ['Chất liệu', 'Cotton'],
                    ['Tên tổ chức chịu trách nhiệm sản xuất', 'Đang cập nhật'],
                    ['Xuất xứ', 'Việt Nam'],
                    ['Địa chỉ tổ chức chịu trách nhiệm sản xuất', 'Đang cập nhật'],
                    ['Chiều dài tay áo', 'Cộc tay'],
                    ['Gửi từ', 'TP. Hồ Chí Minh'],
                ],
            ],
            40 => [
                'price' => 29000,
                'attributes' => [
                    'Màu' => ['Thỏ hồng', 'Xanh Dương', 'Gấu nón', 'Khủng long xe'],
                    'Size' => ['2 (4-6kg)', '3 (6-8kg)', '4 (8-10kg)', '5 (10-12kg)', '6 (13-15kg)'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Chất liệu', 'Thun tăm lạnh'],
                    ['Gửi từ', 'TP. Hồ Chí Minh'],
                ],
            ],
            41 => [
                'price' => 79000,
                'attributes' => [
                    'Màu' => ['Đen', 'Xám', 'Đỏ', 'Hồng'],
                    'Size' => ['4 (14-17kg)', '6 (18-25kg)', '8 (24-27kg)', '10 (28-31kg)', '12 (32-37kg)', '14 (38-45kg)'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Chất liệu', 'Khác'],
                    ['Xuất xứ', 'Việt Nam'],
                    ['Độ tuổi khuyến nghị', '5-6 tuổi'],
                    ['Gửi từ', 'Nam Định'],
                ],
            ],
            42 => [
                'price' => 119000,
                'attributes' => [
                    'Màu' => ['Đỏ', 'Nâu', 'Xám'],
                    'Size' => ['100', '110', '120', '130', '140', '150', '160'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Chất liệu', 'Lụa'],
                    ['Gửi từ', 'Hà Nội'],
                ],
            ],
            43 => [
                'price' => 109000,
                'attributes' => [
                    'Màu' => ['Vàng Đen', 'Vàng Trắng', 'Xanh Trắng'],
                    'Size' => ['5 (8-12kg)', '6 (13-17kg)', '7 (18-22kg)', '8 (23-27kg)', '9 (28-32kg)', '10 (33-36kg)'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Mẫu', 'Họa tiết'],
                    ['Chất liệu', 'Khác'],
                    ['Độ tuổi khuyến nghị', '3 - 4 tuổi'],
                    ['Tên tổ chức chịu trách nhiệm sản xuất', 'Đang cập nhật'],
                    ['Xuất xứ', 'Việt Nam'],
                    ['Địa chỉ tổ chức chịu trách nhiệm sản xuất', 'Đang cập nhật'],
                    ['Chiều dài tay áo', 'Cộc Tay'],
                    ['Gửi từ', 'TP. Hồ Chí Minh'],
                ],

            ],
            44 => [
                'price' => 59000,
                'attributes' => [
                    'Màu' => ['Xanh Than', 'Đen', 'Xám', 'Xanh dương'],
                    'Size' => ['4 (14-17kg)', '6 (18-25kg)', '8 (24-27kg)', '10 (28-31kg)', '12 (32-37kg)', '14 (38-45kg)'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Chất liệu', 'Cotton'],
                    ['Mẫu', 'Khác'],
                    ['Xuất xứ', 'Việt Nam'],
                    ['Gửi từ', 'Nam Định'],
                ],
            ],
            45 => [
                'price' => 189000,
                'attributes' => [
                    'Màu' => ['Đen', 'Xanh', 'Xanh oliu'],
                    'Size' => ['100', '110', '120', '130', '140', '150', '160'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Chất liệu', 'Cotton'],
                    ['Gửi từ', 'Hà Nội'],
                ],
            ],
            46 => [
                'price' => 99000,
                'attributes' => [
                    'Màu' => ['Hồng nhạt', 'Xám nâu', 'Tím nhạt', 'Xám lông chuột'],
                    'Size' => ['100', '110', '120', '130', '140', '150', '160'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'SAMKIDS'],
                    ['Mẫu', 'Họa tiết'],
                    ['Chất liệu', 'Cotton'],
                    ['Xuất xứ', 'Việt Nam'],
                    ['Chiều dài tay áo', 'Ngắn Tay'],
                    ['Tên tổ chức chịu trách nhiệm sản xuất', 'SAMKIDS'],
                    ['Địa chỉ tổ chức chịu trách nhiệm sản xuất', '24/3 Tân Xuân 3, xã Tân Xuân, huyện Hóc Môn'],
                    ['Gửi từ', 'TP. Hồ Chí Minh'],
                ],
            ],
            47 => [
                'price' => 89000,
                'attributes' => [
                    'Màu' => ['Họa tiết máy ảnh', 'Họa tiết mặt trời', 'Họa tiết hổ', 'Họa tiết ngôi sao'],
                    'Size' => ['100', '110', '120', '130', '140', '150', '160'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'Benty'],
                    ['Xuất xứ', 'Việt Nam'],
                    ['Mẫu', 'Họa tiết'],
                    ['Chất liệu', 'Cotton'],
                    ['Kiểu đóng gói', 'Đơn'],
                    ['Độ tuổi khuyến nghị', 'Lớn'],
                    ['Chiều dài tay áo', 'Ngắn tay'],
                    ['Chủ đề mẫu đồ họa', 'Sọc'],
                    ['Tên tổ chức chịu trách nhiệm sản xuất', 'BENTY JOIN STOCK COMPANY'],
                    ['Địa chỉ tổ chức chịu trách nhiệm sản xuất', 'Số 41 đường DT 717, Xóm 6, Thôn 1, Xã Đức Phú, Huyện Tánh Linh, Tỉnh Bình Thuận'],
                    ['Gửi từ', 'TP. Hồ Chí Minh'],
                ],

            ],
            48 => [
                'price' => 78000,
                'attributes' => [
                    'Màu' => ['Hồng', 'Vàng', 'Xanh Dương', 'Tím'],
                    'Size' => ['4 (14-17kg)', '6 (18-25kg)', '8 (24-27kg)', '10 (28-31kg)', '12 (32-37kg)', '14 (38-45kg)'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Chất liệu', 'Cotton'],
                    ['Gửi từ', 'Việt Nam'],
                ],
            ],
            49 => [
                'price' => 46000,
                'attributes' => [
                    'Màu' => ['Đen', 'Hồng', 'Xanh Than', 'Xám'],
                    'Size' => ['M (15-19kg)', 'L (20-23kg)', 'XL (24-27kg)', 'XXL (28-31kg)', 'XXXL (32-37kg)', 'XXXXL (38-45kg)'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Gửi từ', 'TP. Hồ Chí Minh'],
                ],
            ],
            50 => [
                'price' => 72000,
                'attributes' => [
                    'Màu' => ['Đen', 'Ghi', 'Be', 'Tím'],
                    'Size' => ['M (15-19kg)', 'L (20-23kg)', 'XL (24-27kg)', 'XXL (28-31kg)', 'XXXL (32-37kg)', 'XXXXL (38-45kg)'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Gửi từ', 'TP. Hồ Chí Minh'],
                ],
            ],
            51 => [
                'price' => 46000,
                'attributes' => [
                    'Màu' => ['Dây da den - Mặt đen', 'Dây da đen - Mặt trắng', 'Dây da nâu - Mặt trắng', 'Dây thép - Mặt đen', 'Dây thép - Mặt trắng', 'Xám'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'PABLO RAEZ'],
                    ['Mặt đồng hồ', 'Kim'],
                    ['Đồng hồ đeo tay', 'Thạch anh'],
                    ['Kiểu đồng hồ', 'Công việc, Thời trang, Thể thao'],
                    ['Loại bảo hành', 'Bảo hành nhà cung cấp'],
                    ['Đường kính vỏ đồng hồ', '40mm'],
                    ['Kiểu vỏ đồng hồ', 'Tròn'],
                    ['Chất liệu vỏ đồng hồ', 'Hợp kim'],
                    ['Kiểu khóa đồng hồ', 'Khóa gài/móc'],
                    ['Chất liệu dây đeo', 'Da'],
                    ['Hạn bảo hành', '12 tháng'],
                    ['Chống nước', 'Có'],
                ],
            ],
            52 => [
                'price' => 388000,
                'attributes' => [
                    'Màu' => ['Đen', 'Bạc Đen', 'Bạc Vàng Trắng', 'Vàng Đen', 'Bạc Trắng', 'Vàng'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'WISHDOIT'],
                    ['Mặt đồng hồ', 'Kim'],
                    ['Đồng hồ đeo tay', 'Thạch anh'],
                    ['Kiểu đồng hồ', 'Công việc, Thời trang, Khác'],
                    ['Đường kính vỏ đồng hồ', '42mm'],
                    ['Kiểu vỏ đồng hồ', 'Tròn'],
                    ['Chất liệu vỏ đồng hồ', 'Thép không gỉ'],
                    ['Chất liệu dây đeo', 'Thép không gỉ'],
                    ['Tính năng', 'Đo độ cao, Bấm giờ, Ngày, Phản quang, Chống Sốc'],
                    ['Độ sâu chống nước', '30m - 50m'],
                    ['Kính đồng hồ', 'Kính Cường Lực'],
                    ['Chất liệu', 'Thép không gỉ'],
                    ['Chống nước', 'Có'],
                    ['Hạn bảo hành', 'Có'],
                    ['Kiểu khóa đồng hồ', 'Bướm đồng hồ khóa'],
                    ['Loại da', 'Khắc tên bạn miễn phí trên đồng hồ'],
                    ['Loại bảo hành', 'Bảo hành nhà cung cấp'],
                    ['Gửi từ', 'Nước ngoài'],
                ],

            ],
            53 => [
                'price' => 990000,
                'attributes' => [
                    'Màu' => ['Mẫu 1', 'Mẫu 2', 'Mẫu 3', 'Mẫu 4'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'DIZIZID'],
                    ['Mặt đồng hồ', 'Kim'],
                    ['Đồng hồ đeo tay', 'Khác'],
                    ['Kiểu đồng hồ', 'Công việc, Thời trang, Khác'],
                    ['Loại bảo hành', 'Bảo hành nhà cung cấp'],
                    ['Đường kính vỏ đồng hồ', '40mm'],
                    ['Kiểu vỏ đồng hồ', 'Tròn'],
                    ['Chất liệu vỏ đồng hồ', 'Thép không gỉ'],
                    ['Kiểu khóa đồng hồ', 'Khóa gài/móc'],
                    ['Chất liệu dây đeo', 'Thép không gỉ'],
                    ['Hạn bảo hành', '12 tháng'],
                    ['Chống nước', 'Có'],
                    ['Gửi từ', 'Hà Nội'],
                ],

            ],
            54 => [
                'price' => 178000,
                'attributes' => [
                    'Màu' => ['Đen', 'Trắng', 'Mạ Vàng', 'Mạ Vàng Hồng'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'SKMEI'],
                    ['Mặt đồng hồ', 'Kỹ thuật số'],
                    ['Loại bảo hành', 'Bảo hành nhà cung cấp'],
                    ['Chất liệu dây đeo', 'Hợp kim'],
                    ['Hạn bảo hành', '3 tháng'],
                    ['Chống nước', 'Có'],
                    ['Gửi từ', 'TP. Hồ Chí Minh'],
                ],

            ],
            55 => [
                'price' => 1250000,
                'attributes' => [
                    'Màu' => ['Đen', 'Cam', 'Xanh dương', 'Đỏ'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Mặt đồng hồ', 'Kim'],
                    ['Đồng hồ đeo tay', 'Thạch anh'],
                    ['Kiểu đồng hồ', 'Công việc, Thời trang, Thể thao'],
                    ['Loại bảo hành', 'Bảo hành nhà cung cấp'],
                    ['Kiểu vỏ đồng hồ', 'Vuông'],
                    ['Chất liệu vỏ đồng hồ', 'Thép không gỉ'],
                    ['Kiểu khóa đồng hồ', 'Khóa gài/móc'],
                    ['Chất liệu dây đeo', 'Silicone'],
                    ['Tính năng', 'Ngày, Phản quang, Chống nước, Chống trầy xước'],
                    ['Độ sâu chống nước', '<30m'],
                    ['Kính đồng hồ', 'Kính Cường Lực'],
                    ['Hạn bảo hành', '6 tháng'],
                    ['Chất liệu', 'Hợp kim, Thép không gỉ, Thủy tinh'],
                    ['Chống nước', 'Có'],
                    ['Đường kính vỏ đồng hồ', '48mm'],
                    ['Gửi từ', 'TP. Hồ Chí Minh'],
                ],

            ],
            56 => [
                'price' => 288000,
                'attributes' => [
                    'Màu' => ['Model A', 'Model B', 'Model C', 'Model D'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'POEDAGAR'],
                    ['Mặt đồng hồ', 'Kim'],
                    ['Đồng hồ đeo tay', 'Thạch anh'],
                    ['Kiểu đồng hồ', 'Công việc, Thời trang'],
                    ['Loại bảo hành', 'Không bảo hành'],
                    ['Kiểu vỏ đồng hồ', 'Tròn'],
                    ['Chất liệu vỏ đồng hồ', 'Thép không gỉ'],
                    ['Kiểu khóa đồng hồ', 'Cài khóa'],
                    ['Chất liệu dây đeo', 'Thép không gỉ'],
                    ['Tính năng', 'Ngày, Phản quang'],
                    ['Độ sâu chống nước', '<30m'],
                    ['Kính đồng hồ', 'Kính Thủy tinh'],
                    ['Hạn bảo hành', 'Không bảo hành'],
                    ['Chất liệu', 'Khác, Kim loại, Thép, Hợp kim, Thép không gỉ'],
                    ['Chống nước', 'Có'],
                    ['Đường kính vỏ đồng hồ', '41mm'],
                    ['Gửi từ', 'Long An'],
                ],
            ],
            57 => [
                'price' => 165000,
                'attributes' => [
                    'Màu' => ['Đen', 'Trắng', 'Vàng', 'Xanh Đen', 'Bạc'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Mặt đồng hồ', 'Kim'],
                    ['Đồng hồ đeo tay', 'Thạch anh'],
                    ['Kiểu đồng hồ', 'Công việc, Thời trang, Khác, Thể thao'],
                    ['Loại bảo hành', 'Bảo hành nhà cung cấp'],
                    ['Đường kính vỏ đồng hồ', '40mm'],
                    ['Kiểu vỏ đồng hồ', 'Tròn'],
                    ['Chất liệu vỏ đồng hồ', 'Hợp kim'],
                    ['Kiểu khóa đồng hồ', 'Cài khóa'],
                    ['Chất liệu dây đeo', 'Hợp kim'],
                    ['Độ sâu chống nước', '<30m'],
                    ['Kính đồng hồ', 'Kính Cường Lực'],
                    ['Hạn bảo hành', '12 tháng'],
                    ['Chất liệu', 'Thép'],
                    ['Chống nước', 'Có'],
                    ['Tính năng', 'Xem giờ'],
                    ['Loại da', 'Thép'],
                    ['Gửi từ', 'TP. Hồ Chí Minh'],
                ],

            ],
            58 => [
                'price' => 219000,
                'attributes' => [
                    'Màu' => ['Đen Đỏ', 'Trắng', 'Trắng Đen', 'Đen Bạc', 'Xanh Đen'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'Sanda'],
                    ['Mặt đồng hồ', 'Kim - Kỹ thuật số'],
                    ['Đồng hồ đeo tay', 'Thạch anh'],
                    ['Kiểu đồng hồ', 'Thời trang, Thể thao'],
                    ['Loại bảo hành', 'Không bảo hành'],
                    ['Kiểu vỏ đồng hồ', 'Tròn'],
                    ['Chất liệu vỏ đồng hồ', 'Nhựa'],
                    ['Kiểu khóa đồng hồ', 'Khóa gài/móc'],
                    ['Chất liệu dây đeo', 'Cao su'],
                    ['Tính năng', 'Báo Thức, Bấm giờ, Ngày, Múi giờ kép, Phản quang'],
                    ['Độ sâu chống nước', '30m - 50m'],
                    ['Kính đồng hồ', 'Kính Thủy tinh'],
                    ['Hạn bảo hành', 'Không bảo hành'],
                    ['Chống nước', 'Có'],
                    ['Đường kính vỏ đồng hồ', '56mm'],
                    ['Gửi từ', 'Nước ngoài'],
                ],

            ],
            59 => [
                'price' => 315000,
                'attributes' => [
                    'Màu' => ['A', 'B'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'Olevs'],
                    ['Mặt đồng hồ', 'Kim'],
                    ['Đồng hồ đeo tay', 'Thạch anh'],
                    ['Kiểu đồng hồ', 'Thời trang'],
                    ['Loại bảo hành', 'Không bảo hành'],
                    ['Đường kính vỏ đồng hồ', '32mm'],
                    ['Kiểu vỏ đồng hồ', 'Tròn'],
                    ['Chất liệu vỏ đồng hồ', 'Thép không gỉ'],
                    ['Kiểu khóa đồng hồ', 'Cài khóa'],
                    ['Chất liệu dây đeo', 'Thép không gỉ'],
                    ['Tính năng', 'Chống Sốc'],
                    ['Độ sâu chống nước', '30m - 50m'],
                    ['Kính đồng hồ', 'Kính Cường Lực'],
                    ['Hạn bảo hành', 'Không bảo hành'],
                    ['Chống nước', 'Có'],
                    ['Gửi từ', 'Nước ngoài'],
                ],

            ],
            60 => [
                'price' => 461000,
                'attributes' => [
                    'Màu' => ['Trắng + Vàng Hồng', 'Hồng + Vàng Hồng', 'Xanh lá cây + Vàng Hồng', 'Trắng'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'Olevs'],
                    ['Mặt đồng hồ', 'Kim'],
                    ['Đồng hồ đeo tay', 'Thạch anh'],
                    ['Kiểu đồng hồ', 'Công việc, Thời trang'],
                    ['Loại bảo hành', 'Không bảo hành'],
                    ['Đường kính vỏ đồng hồ', '30mm'],
                    ['Kiểu vỏ đồng hồ', 'Tròn'],
                    ['Chất liệu vỏ đồng hồ', 'Thép không gỉ'],
                    ['Kiểu khóa đồng hồ', 'Cài khóa'],
                    ['Chất liệu dây đeo', 'Thép không gỉ'],
                    ['Tính năng', 'Phản quang, Chống Sốc, Không thấm nước'],
                    ['Độ sâu chống nước', '30m - 50m'],
                    ['Kính đồng hồ', 'Kính Cường Lực'],
                    ['Hạn bảo hành', '12 tháng'],
                    ['Gửi từ', 'Nước ngoài'],
                ],
            ],
            61 => [
                'price' => 789000,
                'attributes' => [],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'LAVESTA'],
                    ['Xuất xứ', 'Việt Nam'],
                    ['Độ dài của dây chuyền', 'Ngắn'],
                    ['Chất liệu', 'Kim cương'],
                    ['Giới tính', 'Nữ'],
                    ['Gửi từ', 'Hà Nội'],
                ],

            ],
            62 => [
                'price' => 35000,
                'attributes' => [
                    'Mẫu' => ['1', '2', '3', '4'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'MAYEBE LAVEND'],
                    ['Kiểu vòng tay/ vòng cổ', 'Dạng chuỗi'],
                    ['Chất liệu', 'Khác'],
                    ['Giới tính', 'Unisex'],
                    ['Gửi từ', 'Nước ngoài'],
                ],

            ],
            63 => [
                'price' => 187000,
                'attributes' => [],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'Asimi Jewelry'],
                    ['Phong cách', 'Bình thường, Thanh lịch, Dân tộc, Cổ điển'],
                    ['Địa chỉ tổ chức chịu trách nhiệm sản xuất', 'Đang cập nhật'],
                    ['Xuất xứ', 'Việt Nam'],
                    ['Kiểu vòng tay/ vòng cổ', 'Mặt dây chuyền'],
                    ['Độ dài của dây chuyền', 'Dài'],
                    ['Chất liệu', 'Bạc'],
                    ['Giới tính', 'Nữ'],
                    ['Tên tổ chức chịu trách nhiệm sản xuất', 'Đang cập nhật'],
                    ['Gửi từ', 'TP. Hồ Chí Minh'],
                ],
            ],
            64 => [
                'price' => 750000,
                'attributes' => [],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'CATERINA DIAMOND'],
                    ['Phong cách', 'Thanh lịch'],
                    ['Xuất xứ', 'Việt Nam'],
                    ['Kiểu vòng tay/ vòng cổ', 'Mặt dây chuyền'],
                    ['Độ dài của dây chuyền', 'Dài'],
                    ['Chất liệu', 'Kim cương'],
                    ['Giới tính', 'Nữ'],
                    ['Tên tổ chức chịu trách nhiệm sản xuất', 'Đang cập nhật'],
                    ['Địa chỉ tổ chức chịu trách nhiệm sản xuất', 'CATERINA DIAMOND'],
                    ['Gửi từ', 'Hà Nội'],
                ],

            ],
            65 => [
                'price' => 432000,
                'attributes' => [
                    'Đóng gói' => ['Love Box', 'Hộp Da PU', 'Hộp Giấy'],
                    'Phân Loại' => ['1 Đôi', 'Nhẫn Nam', 'Nhẫn Nữ'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'Bảo Ngọc Jewelry'],
                    ['Bộ phụ kiện', 'Có'],
                    ['Phụ kiện đôi', 'Có'],
                    ['Phong cách', 'Bình thường, Thanh lịch'],
                    ['Dịp', 'Ngày kỷ niệm'],
                    ['Xuất xứ', 'Việt Nam'],
                    ['Chất liệu', 'Bạc'],
                    ['Giới tính', 'Unisex'],
                    ['Tên tổ chức chịu trách nhiệm sản xuất', 'Hộ Kinh Doanh Bảo Ngọc'],
                    ['Địa chỉ tổ chức chịu trách nhiệm sản xuất', '460 Khương Đình, Thanh Xuân, Hà Nội'],
                    ['Gửi từ', 'Hà Nội'],
                ],
            ],
            66 => [
                'price' => 389000,
                'attributes' => [],
                'image_count' => 4,
                'details' => [
                    ['Bộ phụ kiện', 'Không'],
                    ['Phụ kiện đôi', 'Có'],
                    ['Phong cách', 'Thanh lịch'],
                    ['Dịp', 'Ngày kỷ niệm'],
                    ['Xuất xứ', 'Việt Nam'],
                    ['Chất liệu', 'Bạc'],
                    ['Giới tính', 'Unisex'],
                    ['Tên tổ chức chịu trách nhiệm sản xuất', 'Trang sức bạc AURA'],
                    ['Địa chỉ tổ chức chịu trách nhiệm sản xuất', 'Đà Nẵng'],
                    ['Gửi từ', 'Đà Nẵng'],
                ],
            ],
            67 => [
                'price' => 260000,
                'attributes' => [
                    'Màu' => ['Đen', 'Vàng Hồng'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Phong cách', 'Thanh lịch'],
                    ['Dịp', 'Ngày kỷ niệm'],
                    ['Xuất xứ', 'Việt Nam'],
                    ['Giới tính', 'Unisex'],
                    ['Kiểu vòng tay/ vòng cổ', 'Dạng chuỗi'],
                    ['Hạn bảo hành', '24 tháng'],
                    ['Sản phẩm đặt theo yêu cầu', 'Đúng'],
                    ['Tên tổ chức chịu trách nhiệm sản xuất', 'Đang cập nhật'],
                    ['Chất liệu', 'Bạc Ý S925'],
                    ['Gửi từ', 'TP. Hồ Chí Minh'],
                ],

            ],
            68 => [
                'price' => 177000,
                'attributes' => [],
                'image_count' => 4,
                'details' => [
                    ['Phong cách', 'Bình thường'],
                    ['Dịp', 'Ngày kỷ niệm'],
                    ['Xuất xứ', 'Việt Nam'],
                    ['Giới tính', 'Unisex'],
                    ['Kiểu vòng tay/ vòng cổ', 'Dạng chuỗi'],
                    ['Hạn bảo hành', '24 tháng'],
                    ['Sản phẩm đặt theo yêu cầu', 'Đúng'],
                    ['Tên tổ chức chịu trách nhiệm sản xuất', 'Đang cập nhật'],
                    ['Chất liệu', 'Bạc Ý S925'],
                    ['Gửi từ', 'TP. Hồ Chí Minh'],
                ],

            ],
            69 => [
                'price' => 38000,
                'attributes' => [
                    'Tùy chọn' => ['1', '2', '3', '4'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'MAYEBE LAVEND'],
                    ['Chất liệu', 'Khác'],
                    ['Giới tính', 'Unisex'],
                    ['Kiểu vòng tay/ vòng cổ', 'Dạng chuỗi'],
                    ['Gửi từ', 'Nước ngoài'],
                ],

            ],
            70 => [
                'price' => 650000,
                'attributes' => [],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'CATERINA DIAMOND'],
                    ['Dịp', 'Ngày kỷ niệm'],
                    ['Xuất xứ', 'Việt Nam'],
                    ['Địa chỉ tổ chức chịu trách nhiệm sản xuất', 'Đang cập nhật'],
                    ['Kiểu khuyên tai', 'Khuyên tai gài'],
                    ['Chất liệu', 'Kim cương'],
                    ['Giới tính', 'Nữ'],
                    ['Tên tổ chức chịu trách nhiệm sản xuất', 'Đang cập nhật'],
                    ['Phong cách', 'Thanh lịch'],
                    ['Gửi từ', 'Hà Nội'],
                ],
            ],
            71 => [
                'price' => 18900,
                'attributes' => [
                    'Loại' => ['PPF - Nhám', 'PPF - Trong suốt'],
                    'Mã máy' => ['16 ProMax', '16 Pro', '16 Plus', '16', '15 ProMax', '15 Pro', '15 Plus', '15', '14 ProMax', '14 Pro', '14 Plus', '14', '13 ProMax', '13 Pro', '13 Plus', '13', '12 ProMax'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Loại miếng dán bảo vệ màn hình', 'Dán mặt sau'],
                    ['Địa chỉ tổ chức chịu trách nhiệm sản xuất', 'Đang cập nhật'],
                    ['Loại miếng dán bảo vệ màn hình', 'Trong suốt'],
                    ['Chất liệu miếng dán màn hình', 'Kính cường lực'],
                    ['Thương hiệu điện thoại tương thích', 'Others'],
                    ['Loại bảo hành', 'Bảo hành nhà sản xuất'],
                    ['Hạn bảo hành', 'Không bảo hành'],
                    ['Model điện thoại', 'PPF'],
                    ['Gửi từ', 'TP. Hồ Chí Minh'],
                ],
            ],
            72 => [
                'price' => 28900,
                'attributes' => [
                    'Màu' => ['Labubu - Hồng', 'Labubu - Nâu'],
                    'Mã máy' => ['16 ProMax', '16 Pro', '16 Plus', '16', '15 ProMax', '15 Pro', '15 Plus', '15', '14 ProMax', '14 Pro', '14 Plus', '14', '13 ProMax', '13 Pro', '13 Plus', '13', '12 ProMax'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Chất liệu', 'Kim loại'],
                    ['Thương hiệu điện thoại tương thích', 'Apple'],
                    ['Loại ốp', 'Khác'],
                    ['Gửi từ', 'Nước ngoài'],
                ],

            ],
            73 => [
                'price' => 260000,
                'attributes' => [
                    'Loại' => ['Giá đỡ chân gương', 'Giá đỡ ghi đông'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Chất liệu ', 'Kim loại, Cao su'],
                    ['Gửi từ', 'TP. Hồ Chí Minh'],
                ],
            ],
            74 => [
                'price' => 39900,
                'attributes' => [
                    'Màu' => ['Thỏ', 'Thỏ - Màu Nước', 'Bé Na - Màu Nước', 'Voi'],
                    'Mã máy' => ['16 ProMax', '16 Pro', '16 Plus', '16', '15 ProMax', '15 Pro', '15 Plus', '15', '14 ProMax', '14 Pro', '14 Plus', '14', '13 ProMax', '13 Pro', '13 Plus', '13', '12 ProMax'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Chất liệu dây đeo', 'Silicone'],
                    ['Tên tổ chức chịu trách nhiệm sản xuất', 'Đang cập nhật'],
                    ['Loại bảo hành', 'Bảo hành nhà cung cấp'],
                    ['Địa chỉ tổ chức chịu trách nhiệm sản xuất', 'Đang cập nhật'],
                    ['Thương hiệu điện thoại tương thích', 'Apple'],
                    ['Gửi từ', 'TP. Hồ Chí Minh'],
                ],

            ],
            75 => [
                'price' => 30000,
                'attributes' => [
                    'Mã máy' => ['S10', 'S10+', 'SS Note 9', 'SS Note 10', 'SS Note 10+', 'SS Note 20', 'Note 20 Ultra [CS]', 'S20', 'S20+', 'S20 Ultra', 'S21', 'S21+', 'S21 Ultra', 'S10-5G', 'S20-Fe', 'S21-Fe', 'S22', 'S22 Ultra', 'S23', 'S23 Ultra', 'S23 Fe'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Chất liệu dây đeo', 'Nhựa'],
                    ['Chất liệu', 'Nhựa'],
                    ['Tên tổ chức chịu trách nhiệm sản xuất', 'Đang cập nhật'],
                    ['Hạn bảo hành', 'Không bảo hành'],
                    ['Loại bảo hành', 'Không bảo hành'],
                    ['Địa chỉ tổ chức chịu trách nhiệm sản xuất', 'Đang cập nhật'],
                    ['Thương hiệu điện thoại tương thích', 'Samsung'],
                    ['Loại ốp', 'Khác'],
                    ['Tính năng vỏ, ốp', 'Chống sốc'],
                    ['Loại cáp điện thoại', 'Khác'],
                    ['Loại miếng dán bảo vệ màn hình', 'Khác'],
                    ['Model điện thoại', 'Các dòng màn cong'],
                    ['Gửi từ', 'TP. Hồ Chí Minh'],
                ],

            ],
            76 => [
                'price' => 17690000,
                'attributes' => [],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'Asus'],
                    ['Kích thước màn hình laptop', '14 Inches'],
                    ['Loại laptop', 'Ultrabook'],
                    ['Nhà sản xuất chip đồ họa', 'Integrated'],
                    ['Dung lượng lưu trữ', '512GB'],
                    ['Hệ điều hành', 'Windows'],
                    ['Tình trạng', 'Mới'],
                    ['Hạn bảo hành', '24 tháng'],
                    ['Tần số CPU', '4.7Ghz'],
                    ['Bộ xử lý', 'Intel Core i5-13500H'],
                    ['Gửi từ', 'Hà Nội'],
                ],
            ],
            77 => [
                'price' => 10500000,
                'attributes' => [],
                'image_count' => 4,
                'details' => [
                    ['Kích thước màn hình laptop', '> 15 Inches'],
                    ['Loại laptop', 'Gaming'],
                    ['Loại bảng', 'IPS'],
                    ['Loại lưu trữ', 'SSD'],
                    ['Cổng/ Giao diện', 'Ethernet LAN, HDMI, USB 2.0, USB 3.0, USB Type-C'],
                    ['Bộ xử lý', 'Intel Core i7'],
                    ['Hệ điều hành', 'Windows'],
                    ['Tình trạng', 'Mới'],
                    ['Hạn bảo hành', '24 tháng'],
                    ['Loại bảo hành', 'Bảo hành nhà cung cấp'],
                    ['Dung lượng pin', '5000mAh'],
                    ['Trọng lượng', '2300g'],
                    ['Gửi từ', 'TP. Hồ Chí Minh'],
                ],

            ],
            78 => [
                'price' => 18290000,
                'attributes' => [
                    'Màu' => ['Gold', 'Silver', 'Space Gray'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'Apple'],
                    ['Gửi từ', 'TP. Hồ Chí Minh'],
                ],
            ],
            79 => [
                'price' => 22990000,
                'attributes' => [],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'HUAWEI'],
                    ['Thiết bị đọc sách điện tử', 'Có'],
                    ['Dung lượng lưu trữ', '512GB'],
                    ['Hạn bảo hành', '12 tháng'],
                    ['Loại cáp điện thoại', 'Type C'],
                    ['Điện thoại di động', 'Yes'],
                    ['Tích hợp pin', 'Có'],
                    ['Tình trạng', 'Mới'],
                    ['SIRIM Certified', 'Yes'],
                    ['MCMC Approved', 'Yes'],
                    ['Hệ điều hành', 'HarmonyOS'],
                    ['Model máy tính bảng', 'Màn hình Tandem OLED PaperMatte**'],
                    ['Kích thước (dài x rộng x cao)', '5.5mm x 271.25mm x 182.53mm'],
                    ['Kích thước màn hình', '11.5 inches'],
                    ['Dung lượng pin', '8800mAh'],
                    ['Độ phân giải camera chính', '13MP'],
                    ['Gửi từ', 'TP. Hồ Chí Minh'],
                ],

            ],
            80 => [
                'price' => 20990000,
                'attributes' => [
                    'Model' => ['83GS001RVN', '83GS004RVN'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'Lenovo'],
                    ['Kích thước màn hình laptop', '> 15 Inches'],
                    ['Loại laptop', 'Gaming'],
                    ['Hệ điều hành', 'Windows'],
                    ['Tình trạng', 'Mới'],
                    ['Hạn bảo hành', '3 năm'],
                    ['Loại bảo hành', 'Bảo hành nhà sản xuất'],
                    ['Nhà sản xuất chip đồ họa', 'GeForce RTX 3050 6GB GDDR6 Intel UHD Graphics 710'],
                    ['Laptop Model', '83GS001RVN'],
                    ['Loại lưu trữ', '512GB SSD M.2 NVMe'],
                    ['Gửi từ', 'TP. Hồ Chí Minh'],
                ],

            ],
            81 => [
                'price' => 1220000,
                'attributes' => [],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'SAILAZA'],
                    ['Hạn bảo hành', '12 tháng'],
                    ['Loại bảo hành', 'Bảo hành nhà sản xuất'],
                    ['Loại cân & phân tích lượng mỡ', 'Điện tử'],
                    ['Sản phẩm đặt theo yêu cầu', 'Không'],
                    ['Xuất xứ', 'Việt Nam'],
                    ['Số seri', 'SA-2312'],
                    ['Tên tổ chức chịu trách nhiệm sản xuất', 'Công ty TNHH Sailaza'],
                    ['Địa chỉ tổ chức chịu trách nhiệm sản xuất', '15 Hồ Trung Lượng, Q. Cẩm Lệ, TP. Đà Nẵng'],
                    ['Gửi từ', 'TP. Hồ Chí Minh'],
                ],

            ],
            82 => [
                'price' => 579800,
                'attributes' => [
                    'Mô Hình' => ['HT208A', 'HT208D'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'HABOTEST'],
                    ['Gửi từ', 'TP. Hồ Chí Minh'],
                ],
            ],
            83 => [
                'price' => 18900,
                'attributes' => [
                    'Phân loại' => ['3250W - 2 ổ 3USB 1.8m', '3250W - 2 ổ 3USB 3m', '3250W - 3 ổ 1.8m', '3250W - 3 ổ 3m'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'Deli'],
                    ['Hạn bảo hành', '3 năm'],
                    ['Loại bảo hành', 'Bảo hành nhà cung cấp'],
                    ['Gửi từ', 'TP. Hồ Chí Minh'],
                ],
            ],
            84 => [
                'price' => 19200,
                'attributes' => [],
                'image_count' => 4,
                'details' => [
                    ['Gửi từ', 'Hà Nội'],
                ],
            ],
            85 => [
                'price' => 55000,
                'attributes' => [
                    'Mẫu' => ['Bộ sạc C8001', 'Hộp 4 Pin AA 1200', 'Hộp 4 Pin AAA 600'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'BESTON'],
                    ['Hạn bảo hành', '6 tháng'],
                    ['Loại bảo hành', 'Bảo hành nhà sản xuất'],
                    ['Loại pin sạc', 'Nickel-Metal Hydride (NiMH)'],
                    ['Dung lượng pin', '1200mAh'],
                    ['Tên tổ chức chịu trách nhiệm sản xuất', 'Beston VietNam'],
                    ['Địa chỉ tổ chức chịu trách nhiệm sản xuất', 'Beston VietNam'],
                    ['Gửi từ', 'TP. Hồ Chí Minh'],
                ],

            ],
            86 => [
                'price' => 35000,
                'attributes' => [
                    'Phân loại' => ['Sắc hạ', 'Tết'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'Top Gia'],
                    ['Kiểu đóng gói', 'Đơn'],
                    ['Số lớp', '4 lớp'],
                    ['Số cái', '10'],
                    ['Gửi từ', 'TP. Hồ Chí Minh'],
                ],

            ],
            87 => [
                'price' => 666000,
                'attributes' => [
                    'Phân loại' => ['Sang trọng', 'Sao', 'Green zoo', 'Thỏ Hồng', 'Khủng long', 'Smile corgi', 'Dứa', 'Gấu nâu'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'YANYANGTIAN'],
                    ['Địa chỉ tổ chức chịu trách nhiệm sản xuất', 'Đang cập nhật'],
                    ['Sản phẩm đặt theo yêu cầu', 'Không'],
                    ['Tên tổ chức chịu trách nhiệm sản xuất', 'Đang cập nhật'],
                    ['Chiều dài', '2m'],
                    ['Kích thước (dài x rộng x cao)', '2*2.2M'],
                    ['Gửi từ', 'Bình Dương'],
                ],

            ],
            88 => [
                'price' => 329000,
                'attributes' => [
                    'Mẫu thang' => ['IN20M6_20cm', 'IN24M6_24cm', 'IN26M6_26cm', 'IN16M6_16cm', 'IN18M6_18cm', 'IN28M6_28cm'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Xuất xứ', 'Trong nước'],
                    ['Loại chảo', 'Chảo xào'],
                    ['Loại bảo hành', 'Bảo hành nhà sản xuất'],
                    ['Gửi từ', 'TP. Hồ Chí Minh'],
                ],

            ],
            89 => [
                'price' => 824000,
                'attributes' => [
                    'Size' => ['IN03 - 3 bậc', 'IN04 - 4 bậc', 'IN05 - 5 bậc', 'IN06 - 6 bậc', 'DL03 - 3 bậc', 'DL04 - 4 bậc', 'DL05 - 5 bậc', 'DL06 - 6 bậc'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Số sản phẩm còn lại', '87'],
                    ['Thương hiệu', 'nikita'],
                    ['Loại thang', 'Thang ghế gia đình'],
                    ['Tên tổ chức chịu trách nhiệm sản xuất', 'nikita'],
                    ['Địa chỉ tổ chức chịu trách nhiệm sản xuất', 'nikita'],
                    ['Gửi từ', 'TP. Hồ Chí Minh'],
                ],

            ],
            90 => [
                'price' => 97000,
                'attributes' => [
                    'Phân Loại' => ['Cây treo đồ', 'Kệ 2 tầng gỗ', 'Kệ 2 tầng trắng', 'Kệ 2 tầng đen'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'Behomes'],
                    ['Hạn bảo hành', '12 tháng'],
                    ['Trọng lượng được hỗ trợ', '80kg'],
                    ['Kích thước (dài x rộng x cao)', '91 x 32 x 148 cm'],
                    ['Tên tổ chức chịu trách nhiệm sản xuất', 'Hung Tai Phat Audio Co., Ltd'],
                    ['Địa chỉ tổ chức chịu trách nhiệm sản xuất', 'Đồng Nai'],
                    ['Gửi từ', 'Đồng Nai'],
                ],
            ],
            91 => [
                'price' => 375000,
                'attributes' => [
                    'Mẫu' => ['Đầy đủ cao cấp', 'Đen Premium', 'Trắng Premium', 'Xanh Premium', 'Đầy đủ cao cấp Trắng', 'LT-118'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'dodoto'],
                    ['Xuất xứ', 'Trung Quốc'],
                    ['Hạn bảo hành', '12 tháng'],
                    ['Loại máy hút bụi và thiết bị làm sạch', 'Máy hút bụi cầm tay'],
                    ['Chức năng máy hút bụi', 'Chống bụi'],
                    ['Có cáp/ Không cáp', 'Không cáp'],
                    ['Tính năng máy hút bụi', 'Đầu hút bụi kèm theo, Pin sạc'],
                    ['Tính năng robot hút bụi', 'Bộ lọc HEPA'],
                    ['Tình trạng', 'Mới'],
                    ['Tiêu thụ điện năng', '120W'],
                    ['Thời gian hoạt động', '25mins'],
                    ['Dung tích', '0.4L'],
                    ['Dung lượng pin', '4000mAh'],
                    ['Trọng lượng', '400g'],
                    ['Công suất hút', '20000Pa'],
                    ['Tên tổ chức chịu trách nhiệm sản xuất', 'dodoto'],
                    ['Địa chỉ tổ chức chịu trách nhiệm sản xuất', 'Cầu Giấy, Hà Nội'],
                ],

            ],
            92 => [
                'price' => 1449000,
                'attributes' => [
                    'Máy sữa hạt' => ['Máy GLP18 nắp inox', 'Máy GLX99 pro'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'GILUX'],
                    ['Xuất xứ', 'Việt Nam'],
                    ['Hạn bảo hành', '12 tháng'],
                    ['Loại bảo hành', 'Bảo hành nhà cung cấp'],
                    ['Dung tích', '1.75L'],
                    ['Điện áp đầu vào', '220V'],
                    ['Gửi từ', 'Hà Nội'],
                ],

            ],
            93 => [
                'price' => 221000,
                'attributes' => [
                    'Phân Loại' => ['DT01', 'DT04', 'DT05'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'KANIC'],
                    ['Trọng lượng', '500g'],
                    ['Hạn bảo hành', '12 tháng'],
                    ['Loại bảo hành', 'Bảo hành nhà cung cấp'],
                    ['Tính năng máy trộn', 'Bát xoay, Khởi động êm, Điều chỉnh tốc độ'],
                    ['Loại máy trộn', 'Trộn đứng'],
                    ['Tên tổ chức chịu trách nhiệm sản xuất', 'Đang cập nhật'],
                    ['Địa chỉ tổ chức chịu trách nhiệm sản xuất', 'Đang cập nhật'],
                    ['Sản phẩm đặt theo yêu cầu', 'Không'],
                    ['Tiêu thụ điện năng', '180W'],
                    ['Kích thước (dài x rộng x cao)', '17 x 13 x 7cm'],
                    ['Điện áp đầu vào', '220V'],
                    ['Gửi từ', 'TP. Hồ Chí Minh'],
                ],

            ],
            94 => [
                'price' => 21500,
                'attributes' => [],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'LIGHTBULB'],
                    ['Hạn bảo hành', 'Không bảo hành'],
                    ['Loại bảo hành', 'Bảo hành nhà cung cấp'],
                    ['Tên tổ chức chịu trách nhiệm sản xuất', 'Đang cập nhật'],
                    ['Sản phẩm đặt theo yêu cầu', 'Đúng'],
                    ['Địa chỉ tổ chức chịu trách nhiệm sản xuất', 'Đang cập nhật'],
                    ['Điện áp đầu vào', '0V'],
                    ['Công suất', '0'],
                    ['Gửi từ', 'TP. Hồ Chí Minh'],
                ],

            ],
            95 => [
                'price' => 200000,
                'attributes' => [],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'Gaabor'],
                    ['Xuất xứ', 'Trung Quốc'],
                    ['Dung tích', '1.5L'],
                    ['Điện áp đầu vào', '220V'],
                    ['Gửi từ', 'TP. Hồ Chí Minh'],
                ],

            ],
            96 => [
                'price' => 359000,
                'attributes' => [],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'Nguyễn Vũ Hoàng Hiệp'],
                    ['Loại phiên bản', 'Phiên bản hàng năm'],
                    ['Nhập khẩu/ trong nước', 'Trong nước'],
                    ['Ngôn ngữ', 'Tiếng Việt'],
                    ['Loại nắp', 'Bìa cứng'],
                    ['Nhà phát hành', 'ANTBOOK'],
                    ['ISBN', '978-604-41-3448-2'],
                    ['Năm xuất bản', '2024'],
                    ['Số giấy phép xuất bản', '1575-2024/CXBIPH/102-48/TN'],
                    ['Tên tổ chức chịu trách nhiệm sản xuất', 'Nhà xuất bản Thanh Niên'],
                    ['Địa chỉ tổ chức chịu trách nhiệm sản xuất', '151 Trung Kính, Cầu Giấy, Hà Nội'],
                    ['Số trang', '212'],
                    ['Nhà xuất bản', 'Nhà Xuất bản Thanh Niên'],
                    ['Gửi từ', 'Hà Nội'],
                ],

            ],
            97 => [
                'price' => 162000,
                'attributes' => [
                    'Phân Loại' => ['Tư Duy Mở', 'Thao Túng Tâm Lý', 'Lý Thuyết Trò Chơi', 'Tư Duy Ngược'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'Nhiều tác giả'],
                    ['Nhập khẩu/ trong nước', 'Trong nước'],
                    ['Sản phẩm đặt theo yêu cầu', 'Đúng'],
                    ['Tên tổ chức chịu trách nhiệm sản xuất', 'Đang cập nhật'],
                    ['Địa chỉ tổ chức chịu trách nhiệm sản xuất', 'Đang cập nhật'],
                    ['Quantity per Pack', '1'],
                    ['Loại phiên bản', 'Phiên bản thông thường'],
                    ['Loại nắp', 'Bìa mềm'],
                    ['Nhà phát hành', '2022'],
                    ['Ngôn ngữ', 'Tiếng Việt'],
                    ['Số trang', '214'],
                    ['Nhà xuất bản', '2022'],
                    ['Năm xuất bản', '2022'],
                    ['Gửi từ', 'Hà Nội'],
                ],

            ],
            98 => [
                'price' => 140000,
                'attributes' => [],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'Nguyễn Anh Dũng'],
                    ['Nhập khẩu/ trong nước', 'Trong nước'],
                    ['Ngôn ngữ', 'Tiếng Việt'],
                    ['Địa chỉ tổ chức chịu trách nhiệm sản xuất', 'Đang cập nhật'],
                    ['Loại nắp', 'Bìa mềm'],
                    ['Loại phiên bản', 'Phiên bản thông thường'],
                    ['Nhà phát hành', 'CTY CP SBOOKS'],
                    ['Năm xuất bản', '2023'],
                    ['Tên tổ chức chịu trách nhiệm sản xuất', 'NXB Thế Giới'],
                    ['Số trang', '548'],
                    ['Nhà xuất bản', 'NXB Thế Giới'],
                    ['Gửi từ', 'TP. Hồ Chí Minh'],
                ],

            ],
            99 => [
                'price' => 84000,
                'attributes' => [],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'Mỹ Thuận'],
                    ['Loại phiên bản', 'Phiên bản thông thường'],
                    ['Nhập khẩu/ trong nước', 'Trong nước'],
                    ['Ngôn ngữ', 'Tiếng Việt'],
                    ['Loại nắp', 'Bìa mềm'],
                    ['Địa chỉ tổ chức chịu trách nhiệm sản xuất', 'Đang cập nhật'],
                    ['Nhà phát hành', 'CTY CP SBOOKS'],
                    ['ISBN', '9786044774589'],
                    ['Năm xuất bản', '2023'],
                    ['Tên tổ chức chịu trách nhiệm sản xuất', 'NXB Văn Học'],
                    ['Số trang', '248'],
                    ['Gửi từ', 'TP. Hồ Chí Minh'],
                ],

            ],
            100 => [
                'price' => 45000,
                'attributes' => [
                    'Phân loại' => ['Từ chiến thuật đến chiến thắng', 'Biến giao tiếp thành thế mạnh', 'Khéo léo bắt chuyện'],
                ],
                'image_count' => 4,
                'details' => [
                    ['Thương hiệu', 'Nhiều tác giả'],
                    ['Nhập khẩu/ trong nước', 'Trong nước'],
                    ['Ngôn ngữ', 'Tiếng Việt'],
                    ['Loại nắp', 'Bìa mềm'],
                    ['Loại phiên bản', 'Phiên bản thông thường'],
                    ['Nhà phát hành', 'Qbooks'],
                    ['Năm xuất bản', '2024'],
                    ['Số trang', '160-230'],
                    ['Nhà xuất bản', 'Thanh Niên'],
                    ['Gửi từ', 'Hà Nội'],
                ],

            ],
            // 101 => [
            //     'price' => 18900,
            //     'attributes' => [],
            //     'image_count' => 4,
            //     'details' => [
            //         ['Loại miếng dán bảo vệ màn hình', 'Dán mặt sau'],
            //     ],
            // ],
            // 102 => [
            //     'price' => 18900,
            //     'attributes' => [],
            //     'image_count' => 4,
            //     'details' => [
            //         ['Loại miếng dán bảo vệ màn hình', 'Dán mặt sau'],
            //     ],
            // ],
            // 103 => [
            //     'price' => 18900,
            //     'attributes' => [],
            //     'image_count' => 4,
            //     'details' => [
            //         ['Loại miếng dán bảo vệ màn hình', 'Dán mặt sau'],
            //     ],
            // ],
            // 104 => [
            //     'price' => 18900,
            //     'attributes' => [],
            //     'image_count' => 4,
            //     'details' => [
            //         ['Loại miếng dán bảo vệ màn hình', 'Dán mặt sau'],
            //     ],
            // ],
            // 105 => [
            //     'price' => 18900,
            //     'attributes' => [],
            //     'image_count' => 4,
            //     'details' => [
            //         ['Loại miếng dán bảo vệ màn hình', 'Dán mặt sau'],
            //     ],
            // ],
        ];



        foreach ($data as $productId => $productData) {
            $price = $productData['price'];
            $attributes = $productData['attributes'];

            // Lấy tổ hợp thuộc tính
            $attributeCombinations = $this->generateCombinations($attributes);

            $isPromotion = rand(0, 10) >= 7;

            foreach ($attributeCombinations as $combination) {

                $promotionPrice = null;
                $price_temp = $price;

                if (rand(0, 10) >= 6) {
                    $price_temp = max(round($price * rand(80, 100) / 100, -3), $price -  50000);
                }

                if ($isPromotion && rand(0, 10) >= 5) {
                    $promotionPrice = max(round($price_temp * rand(80, 95) / 100, -3), $price_temp -  50000);
                }

                $productVariant = ProductVariant::create([
                    'product_id' => $productId,
                    'price' => $price_temp,
                    'promotion_price' => $promotionPrice,
                    'quantity' => rand(10, 200),
                    'sold_quantity' => rand(10, 150),
                ]);

                // Lưu các thuộc tính và giá trị
                foreach ($combination as $name => $value) {
                    $attribute = ProductAttribute::firstOrCreate(['name' => $name]);
                    $attributeValue = ProductAttributeValue::firstOrCreate([
                        'product_attribute_id' => $attribute->id,
                        'value' => $value,
                    ]);

                    // Liên kết ProductVariant và AttributeValue
                    ProductVariantValue::create([
                        'product_variant_id' => $productVariant->id,
                        'product_attribute_value_id' => $attributeValue->id,
                    ]);
                }
            }

            // Tạo hình ảnh
            for ($i = 1; $i <= $productData['image_count']; $i++) {
                ProductImage::create([
                    'product_id' => $productId,
                    'image_path' => sprintf('product_%02d_%d.jpg', $productId, $i),
                    'default' => $i === 1,
                ]);
            }

            // Tạo chi tiết sản phẩm
            foreach ($productData['details'] as $detail) {
                [$name, $description] = $detail;
                ProductDetail::create([
                    'product_id' => $productId,
                    'name' => $name,
                    'description' => $description,
                ]);
            }
        }
    }

    private function generateCombinations(array $attributes): array
    {
        $keys = array_keys($attributes);
        $values = array_values($attributes);

        $combinations = [[]];

        foreach ($values as $keyIndex => $valueGroup) {
            $newCombinations = [];
            foreach ($combinations as $combination) {
                foreach ($valueGroup as $value) {
                    $newCombination = $combination;
                    $newCombination[$keys[$keyIndex]] = $value;
                    $newCombinations[] = $newCombination;
                }
            }
            $combinations = $newCombinations;
        }

        return $combinations;
    }
}
