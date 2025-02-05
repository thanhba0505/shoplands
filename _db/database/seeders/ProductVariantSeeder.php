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
