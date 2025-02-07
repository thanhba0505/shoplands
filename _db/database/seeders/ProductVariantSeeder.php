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
                    $promotionPrice = max(round($price_temp * rand(80, 95) / 100, -3), $price -  50000);
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
