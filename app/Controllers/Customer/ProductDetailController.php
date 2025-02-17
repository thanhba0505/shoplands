<?php

require_once 'app/Models/Product.php';
require_once 'app/Models/ProductVariant.php';
require_once 'app/Models/ProductImage.php';
require_once 'app/Models/ProductDetail.php';
require_once 'app/Models/Category.php';

class ProductDetailController
{
    public function show()
    {
        $id = Request::get('id');

        // Lấy thông tin chi tiêt sản phẩm
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

        // Lấy danh sách sản phẩm tương tự
        $similarProducts = $productModel->getProducts(6);

        // Lấy hình ảnh sản phẩm
        $imageModel = new ProductImage();
        $images = $imageModel->getImagesByProductId($id);

        // Lấy chi tiết sản phẩm
        $productDetailModel = new ProductDetail();
        $productDetail = $productDetailModel->getDetailByProductId($id);

        // Lấy danh mục của sản phẩm
        $categoryModel = new Category();
        $category = $categoryModel->getCategoryByProductId($id);

        $data = [
            'title' => 'Product Detail Page',
            'id' => $id,
            'product' => $product,
            'productVariant' => $productVariant,
            'attributes' => $attributes,
            'similarProducts' => $similarProducts,
            'images' => $images,
            'productDetail' => $productDetail,
            'category' => $category
        ];

        return View::make('Customer/product-detail', $data);
    }
}
