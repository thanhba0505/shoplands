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
                'variants' => [
                    ['70000', '65000', 1320, 184, ['Màu sắc' => 'Kem be', 'Size' => 'S']],
                    ['72000', '64000', 967, 127, ['Màu sắc' => 'Kem be', 'Size' => 'M']],
                    ['75000', null, 1634, 234, ['Màu sắc' => 'Đen', 'Size' => 'S']],
                    ['75000', null, 345, 235, ['Màu sắc' => 'Đen', 'Size' => 'M']],
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
                'variants' => [
                    ['179000', null, 323, 123, ['Màu sắc' => 'Nâu', 'Size' => 'S']],
                    ['164000', null, 745, 96, ['Màu sắc' => 'Nâu', 'Size' => 'M']],
                    ['182000', null, 427, 13, ['Màu sắc' => 'Đen', 'Size' => 'S']],
                    ['170000', null, 234, 52, ['Màu sắc' => 'Đen', 'Size' => 'M']],
                ],
                'image_count' => 5,
                'details' => [
                    ['Phong cách', 'Basic, Korean, Minimalist, Retro, Sexy'],
                ],
            ],
            3 => [
                'variants' => [
                    ['285000', 223000, 327, 96, ['Size' => 'S']],
                    ['285000', 223000, 427, 13, ['Size' => 'M']],
                    ['285000', 223000, 234, 52, ['Size' => 'XL']],
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
        ];

        foreach ($data as $productId => $productData) {
            // Xử lý biến thể
            foreach ($productData['variants'] as $variant) {
                [$price, $promotion_price, $quantity, $sold_quantity, $attributes] = $variant;

                // Tạo ProductVariant
                $productVariant = ProductVariant::create([
                    'product_id' => $productId,
                    'price' => $price,
                    'promotion_price' => $promotion_price,
                    'quantity' => $quantity,
                    'sold_quantity' => $sold_quantity,
                ]);

                // Tạo thuộc tính và giá trị
                foreach ($attributes as $name => $value) {
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
}
