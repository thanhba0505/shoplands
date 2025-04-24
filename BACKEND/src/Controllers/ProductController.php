<?php

namespace App\Controllers;

use App\Helpers\Auth;
use App\Helpers\DataHelper;
use App\Helpers\FileSave;
use App\Helpers\Log;
use App\Helpers\Request;
use App\Helpers\Response;
use App\Helpers\Validator;
use App\Models\CategoryModel;
use App\Models\ProductAttributeModel;
use App\Models\ProductAttributeValueModel;
use App\Models\ProductDetailModel;
use App\Models\ProductImageModel;
use App\Models\ProductModel;
use App\Models\ProductVariantModel;
use App\Models\ProductVariantValueModel;

class ProductController {
    // Lấy danh sách san pham
    public function get() {
        try {
            $status = Request::get('status', 'all');
            $limit = Request::get('limit', 10);
            $page = max(0, Request::get('page', 0));
            $categories = Request::get('categories', []);
            $min_price = Request::get('min_price', null);
            $max_price = Request::get('max_price', null);
            $search = Request::get('search', "");
            $order_by_price = Request::get('order_by_price', null);
            $order_by_rating = Request::get('order_by_rating', null);
            $seller_id = Request::get('seller_id', null);

            $count =  0;

            $result = ProductModel::getListProducts(
                $status,
                $limit,
                $page,
                $categories,
                $search,
                $min_price,
                $max_price,
                $order_by_price,
                $order_by_rating,
                $seller_id
            );

            $products = $result['products'];
            $count = $result['count'];

            Response::json(['count' => $count, 'products' => $products], 200);
        } catch (\Throwable $th) {
            $this->logAndRespond("ProductController -> get: ", $th);
        }
    }

    // Tìm kiếm 1 sản phẩm
    public function find($id) {
        try {
            $product = ProductModel::find($id);

            if (!$product) {
                Response::json(['message' => 'Không tìm thấy sản phẩm'], 404);
                return;
            }

            Response::json($product);
        } catch (\Throwable $th) {
            $this->logAndRespond("AddressController -> userGet", $th);
        }
    }

    // Thêm 1 sản phẩm
    public function sellerAdd() {
        try {
            $seller = Auth::seller();

            $data = [
                'seller_id' => $seller['seller_id'],
                'name' => Request::post('name'),
                'description' => Request::post('description'),
                'category_id' => Request::post('category_id') === '' ? null : Request::post('category_id'),
                'product_details' => is_array(Request::post('product_details', [], true)) ? Request::post('product_details', [], true) : [],
                'product_variants' => is_array(Request::post('product_variants', [], true)) ? Request::post('product_variants', [], true) : [],
                'images' => Request::files('images')
            ];

            // Validate input data
            $this->checkAddProduct(
                $data['name'],
                $data['description'],
                $data['category_id'],
                $data['images'],
                $data['product_details'],
                $data['product_variants']
            );

            // Add product
            $product_id = ProductModel::add(
                $data['name'],
                $data['description'],
                $data['seller_id'],
                $data['category_id']
            );

            // Add product images
            $this->addProductImages($product_id, $data['images']);

            // Add product details
            $this->addProductDetails($product_id, $data['product_details']);

            // Add product variants
            $this->addProductVariants($product_id, $data['product_variants']);

            Response::json(['message' => 'Thêm sản phẩm thành công', 'product_id' => $product_id], 201);
        } catch (\Throwable $th) {
            $this->logAndRespond("AddressController -> sellerAdd", $th);
        }
    }

    // Thêm ảnh cho 1 sản phẩm
    private function addProductImages($product_id, $images) {
        $fileNames = [];

        foreach ($images as $image) {
            $fileSave = FileSave::productImage($image);
            if ($fileSave['success'] === true) {
                // ProductImageModel::add($product_id, $fileSave['file_name'], $default);
                $fileNames[] = $fileSave['file_name'];
            }
        }

        if (empty($fileNames)) {
            Response::json(['message' => 'Có lỗi xảy ra, số ảnh được tải lên ít hơn 1'], 400);
        }

        ProductImageModel::addList($product_id, $fileNames);
    }

    // Thêm chi tiết cho 1 sản phẩm
    private function addProductDetails($product_id, $product_details) {
        if (empty($product_details)) {
            return;
        }
        ProductDetailModel::addList($product_id, $product_details);
    }

    // Thêm thuộc tính
    private function addProductVariants($product_id, $product_variants) {
        if (count($product_variants) > 1) {
            $this->addVariantsWithAttributes($product_id, $product_variants);
        } else {
            $this->addSimpleVariants($product_id, $product_variants);
        }
    }

    // Thêm thuộc tính
    private function addVariantsWithAttributes($product_id, $product_variants) {
        $product_attributes = $this->extractUniqueAttributes($product_variants);

        // Verify combinations count
        $combinationsCount = 1;
        foreach ($product_attributes as $attribute) {
            $combinationsCount *= count($attribute['values']);
        }

        if ($combinationsCount !== count($product_variants)) {
            Response::json([
                'message' => 'Số lượng tổ hợp thuộc tính không khớp với số lượng biến thể sản phẩm.'
            ]);
        }

        // Add attributes and values
        $attribute_value = [];
        foreach ($product_attributes as $attribute) {
            $product_attribute_id = ProductAttributeModel::add($attribute['name']);

            foreach ($attribute['values'] as $value) {
                $product_attribute_value_id = ProductAttributeValueModel::add(
                    $value,
                    $product_attribute_id
                );

                $attribute_value[] = [
                    'name' => $attribute['name'],
                    'value' => $value,
                    'product_attribute_value_id' => $product_attribute_value_id
                ];
            }
        }

        // Add variants and link attributes
        foreach ($product_variants as $variant) {
            $product_variant_id = ProductVariantModel::add(
                $product_id,
                $variant['quantity'],
                $variant['price'],
                $variant['promotion_price'] ?? null
            );

            foreach ($variant['attributes'] as $attribute) {
                foreach ($attribute_value as $value) {
                    if ($value['name'] === $attribute['name'] && $value['value'] === $attribute['value']) {
                        ProductVariantValueModel::add(
                            $product_variant_id,
                            $value['product_attribute_value_id']
                        );
                    }
                }
            }
        }
    }

    // 
    private function addSimpleVariants($product_id, $product_variants) {
        foreach ($product_variants as $variant) {
            ProductVariantModel::add(
                $product_id,
                $variant['quantity'],
                $variant['price'],
                $variant['promotion_price'] ?? null
            );
        }
    }

    // 
    private function extractUniqueAttributes($product_variants) {
        $product_attributes = [];

        foreach ($product_variants as $variant) {
            foreach ($variant['attributes'] as $attribute) {
                $name = $attribute['name'];
                $value = $attribute['value'];

                if (!isset($product_attributes[$name])) {
                    $product_attributes[$name] = [
                        "name" => $name,
                        "values" => []
                    ];
                }

                if (!in_array($value, $product_attributes[$name]['values'])) {
                    $product_attributes[$name]['values'][] = $value;
                }
            }
        }

        return array_values($product_attributes);
    }

    // Kiểm tra thông tin thêm sản phẩm
    private function checkAddProduct($name, $description, $category_id, $images, $product_details, $product_variants) {
        // Check product name
        $checkName = Validator::isText($name, 'Tên sản phẩm', 3, 100);
        if ($checkName !== true) {
            Response::json(['message' => $checkName], 400);
        }

        // Check description
        $checkDescription = Validator::isText($description, 'Mota', 0, 5000, true);
        if ($checkDescription !== true) {
            Response::json(['message' => $checkDescription], 400);
        }

        // Check category
        if (!empty($category_id)) {
            $checkCategory = CategoryModel::find($category_id);
            if (!$checkCategory) {
                Response::json(['message' => 'Không tìm thấy danh mục'], 400);
            }
        }

        // Check images
        if (!$images || count($images) < 1) {
            Response::json(['message' => 'Sản phẩm cần ít nhất 1 hình ảnh'], 400);
        }

        // Check product details
        foreach ($product_details as $product_detail) {
            $checkName = Validator::isText($product_detail['name'], 'Tên sản phẩm', 3, 300);
            if ($checkName !== true) {
                Response::json(['message' => $checkName], 400);
            }

            $checkDescription = Validator::isText($product_detail['description'], 'Mô tả', 0, 5000, true);
            if ($checkDescription !== true) {
                Response::json(['message' => $checkDescription], 400);
            }
        }

        // Check variants
        if (count($product_variants) < 1) {
            Response::json(['message' => 'Không đủ thông tin giá sản phẩm'], 400);
        }

        foreach ($product_variants as $variant) {
            $checkPrice = Validator::isNumber($variant['price'], 'Giá sản phẩm', 1, null);
            if ($checkPrice !== true) {
                Response::json(['message' => $checkPrice], 400);
            }

            $checkQuantity = Validator::isNumber($variant['quantity'], 'Số lượng sản phẩm', 1, 10000);
            if ($checkQuantity !== true) {
                Response::json(['message' => $checkQuantity], 400);
            }

            if ($variant['promotion_price'] && $variant['promotion_price'] >= $variant['price']) {
                Response::json(['message' => "Giá khuyến mãi phải nhỏ hơn giá bán"], 400);
            }

            if (isset($variant['promotion_price']) && $variant['promotion_price'] <= 0) {
                Response::json(['message' => "Giá khuyến mãi phải lớn hơn 0"], 400);
            }
        }
    }

    // 
    private function logAndRespond($message, $throwable) {
        Log::throwable($message . ": " . $throwable->getMessage());
        Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
    }

    // Cập nhật 1 sản phẩm
    public function sellerUpdate($product_id) {
        try {
            $seller = Auth::seller();

            $product = ProductModel::getByProductId($product_id);
            if (!$product) {
                Response::json(['message' => 'Không tìm thấy sản phẩm'], 400);
            }

            if ($product['seller_id'] != $seller['seller_id']) {
                Response::json(['message' => 'Sản phẩm không phải của bạn'], 400);
            }
            // Cập nhật mô tả
            $description = Request::json("description", "");

            $checkDescription = Validator::isText($description, 'Mô tả', 0, 5000, true);
            if ($checkDescription !== true) {
                Response::json(['message' => $checkDescription], 400);
            }

            ProductModel::updateDescription($product_id, $description);
            
            // Cập nhật giá và tồn kho
            $variants = Request::json("variants", []);

            if (!empty($variants)) {
                foreach ($variants as $key => $variant) {
                    $productByVariantId = ProductModel::getByProductVariantId($variant['product_variant_id']);

                    if ($product_id != $productByVariantId['product_id']) {
                        Response::json(['message' => 'Thuộc tính không thuộc sản phẩm này'], 400);
                    }

                    $checkPrice = Validator::isNumber($variant['price'], 'Giá', 1, 5000000);
                    $checkPromotionPrice = Validator::isNumber($variant['promotion_price'], 'Giá khuyến mãi', 0, 5000000);
                    $checkQuantity = Validator::isNumber($variant['quantity'], 'Số lượng', 1, 10000);

                    if ($checkPrice  !== true) {
                        Response::json(['message' => $checkPrice], 400);
                    }

                    if ($checkPromotionPrice !== true) {
                        if ($variant['promotion_price'] !== null) {
                            Response::json(['message' => $checkPromotionPrice], 400);
                        }
                    }

                    if ($checkQuantity !== true) {
                        Response::json(['message' => $checkQuantity], 400);
                    }

                    if ($variant['promotion_price'] && $variant['promotion_price'] >= $variant['price']) {
                        Response::json(['message' => "Giá khuyến mãi phải nhỏ hơn giá bán"], 400);
                    }

                    ProductVariantModel::updateVariant($variant['product_variant_id'], $variant['price'], $variant['promotion_price'], $variant['quantity']);
                }
            }

            $product = ProductModel::find($product_id);

            Response::json($product, 200);
        } catch (\Throwable $th) {
            $this->logAndRespond("AddressController -> sellerUpdate", $th);
        }
    }
}
