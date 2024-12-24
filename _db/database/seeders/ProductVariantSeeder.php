<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeValue;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Log;

class ProductVariantSeeder extends Seeder
{
    public function run(): void
    {
        // Lấy tất cả sản phẩm
        $products = Product::all();

        foreach ($products as $product) {
            $count = rand(0, 3);
            // Log::info('------------------------------------------------------------------------------------------ ', ['product_id' => $product->id, 'count' => $count]);


            if ($count == 0) {
                ProductVariant::factory()->create([
                    'product_id' => $product->id,
                    'product_attribute_value_id' => null,
                ]);
                // Log::info('---0-----------', ['product_id' => $product->id, 'product_attribute_value_id' => null]);
            } else {
                for ($i = 0; $i < $count; $i++) {
                    $product_attribute_id = ProductAttribute::factory()->create();

                    $count_attribute_value = rand(2, 5);

                    // Log::info('-------1-------', ['product_id' => $product->id, 'product_attribute_id' => $product_attribute_id->id, 'count_attribute_value' => $count_attribute_value]);

                    for ($j = 0; $j < $count_attribute_value; $j++) {
                        $product_attribute_value_id = ProductAttributeValue::factory()->create([
                            'product_attribute_id' => $product_attribute_id->id,
                        ]);

                        ProductVariant::factory()->create([
                            'product_attribute_value_id' => $product_attribute_value_id->id,
                            'product_id' => $product->id,
                        ]);

                        // Log::info('-------------4-', ['product_id' => $product->id, 'product_attribute_id' => $product_attribute_id->id, 'product_attribute_value_id' => $product_attribute_value_id->id]);
                    }
                }
            }
        }
    }
}
