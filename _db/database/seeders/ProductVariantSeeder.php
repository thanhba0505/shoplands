<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeValue;
use App\Models\ProductVariant;
use App\Models\ProductVariantValue;
use Illuminate\Support\Facades\Log;

class ProductVariantSeeder extends Seeder
{
    public function run(): void
    {
        // Lấy tất cả sản phẩm
        $products = Product::all();

        foreach ($products as $product) {
            // Số lượng thuộc tính cho sản phẩm
            $count_product_attribute = rand(0, 3); // Ít nhất phải có 1 thuộc tính

            if ($count_product_attribute == 0) {
                ProductVariant::factory()->create([
                    'product_id' => $product->id,
                ]);
            } else {
                $attributes = [];
                for ($i = 0; $i < $count_product_attribute; $i++) {
                    // Tạo thuộc tính (ví dụ: Màu, Size)
                    $product_attribute = ProductAttribute::factory()->create();

                    // Số lượng giá trị thuộc tính (ví dụ: Đỏ, Xanh, S, M)
                    $count_attribute_value = rand(2, 3);

                    $attribute_values = [];
                    for ($j = 0; $j < $count_attribute_value; $j++) {
                        $attribute_value = ProductAttributeValue::factory()->create([
                            'product_attribute_id' => $product_attribute->id,
                        ]);
                        $attribute_values[] = $attribute_value->id;
                    }

                    // Lưu các giá trị thuộc tính để tạo biến thể
                    $attributes[] = $attribute_values;
                }

                Log::info('---', ['attributes' => $attributes]);

                // Nếu có ít nhất một thuộc tính, tạo tất cả các biến thể (Cartesian Product)
                if (!empty($attributes)) {
                    $cartesian_product = $this->cartesianProduct($attributes);
                    Log::info('--------', ['cartesian_product' => $cartesian_product]);

                    foreach ($cartesian_product as $index => $variant_values) {
                        // Tạo một biến thể sản phẩm
                        $product_variant = ProductVariant::factory()->create([
                            'product_id' => $product->id,
                        ]);

                        Log::info('----====---', ['index' => $index, 'product_variant' => $product_variant->id]);

                        // // Tạo các giá trị thuộc tính cho biến thể
                        foreach ($variant_values as $value_id) {
                            $product_variant_value = ProductVariantValue::factory()->create([
                                'product_variant_id' => $product_variant->id,
                                'product_attribute_value_id' => $value_id,
                            ]);

                            Log::info("----------***---------", ['product_variant_value' => $product_variant_value->id, 'product_variant_id' => $product_variant->id, 'product_attribute_value_id' => $value_id]);
                        }

                        // foreach ($variant_values as $value_id) {
                        //     ProductVariantValue::factory()->create([
                        //         'product_variant_id' => $product_variant->id,
                        //         'product_attribute_value_id' => $value_id,
                        //     ]);
                        // }
                    }
                }
            }
        }
    }

    /**
     * Hàm tạo Cartesian Product từ một mảng
     * @param array $arrays
     * @return array
     */
    private function cartesianProduct(array $arrays): array
    {
        $result = [[]];
        foreach ($arrays as $array) {
            $newResult = [];
            foreach ($result as $product) {
                foreach ($array as $item) {
                    $newResult[] = array_merge($product, [$item]);
                }
            }
            $result = $newResult;
        }
        return $result;
    }
}
