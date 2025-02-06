<?php

require_once 'app/Models/Product.php';
require_once 'app/Models/ProductVariant.php';

class ProductDetailController
{
    public function show()
    {
        $id = Request::get('id');

        $productModel = new Product();
        $product = $productModel->getByProductId($id);

        $productVariantModel = new ProductVariant();
        $productVariantResult = $productVariantModel->getByProductId($id);

        $productVariant = [];

        foreach ($productVariantResult as $row) {
            $productVariantId = $row['product_variant_id'];

            if (!isset($productVariant[$productVariantId])) {
                $productVariant[$productVariantId] = [
                    'price' => $row['product_variant_price'],
                    'promotion_price' => $row['product_variant_promotion_price'],
                    'quantity' => $row['product_variant_quantity'],
                    'sold_quantity' => $row['product_variant_sold_quantity'],
                ];
            }

            $attributeId = $row['product_attribute_id'];
            $attributeValueId = $row['product_attribute_value_id'];

            $productVariant[$productVariantId]['attributes'][$attributeId] = $attributeValueId;
        }

        $attributes = [];

        foreach ($productVariantResult as $row) {
            $attributeId = $row['product_attribute_id'];
            $attributeName = $row['product_attribute_name'];
            $attributeValueId = $row['product_attribute_value_id'];
            $attributeValue = $row['product_attribute_value'];

            // Nếu attribute chưa tồn tại, khởi tạo
            if (!isset($attributes[$attributeId])) {
                $attributes[$attributeId] = [
                    'name' => $attributeName,
                    'values' => []
                ];
            }

            // Chỉ thêm giá trị nếu chưa tồn tại trong mảng values
            if (!in_array($attributeValue, $attributes[$attributeId]['values'])) {
                $attributes[$attributeId]['values'][$attributeValueId] = $attributeValue;
            }
        }

        $data = [
            'title' => 'Product Detail Page',
            'id' => $id,
            'product' => $product,
            'productVariant' => $productVariant,
            'attributes' => $attributes
        ];

        return View::make('Customer/product-detail', $data);
    }
}
