<?php

namespace App\Controllers;

use App\Helpers\Auth;
use App\Helpers\FileSave;
use App\Helpers\Log;
use App\Helpers\Request;
use App\Helpers\Response;
use App\Helpers\Validator;
use App\Models\CategoryModel;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeModel;
use App\Models\ProductAttributeValueModel;
use App\Models\ProductDetailModel;
use App\Models\ProductImageModel;
use App\Models\ProductModel;
use App\Models\ProductVariantModel;
use App\Models\ProductVariantValue;
use App\Models\ProductVariantValueModel;
use App\Models\ReviewModel;

class ProductController {
    public function get() {
        try {
            $limit = Request::get('limit', 12);
            $products = ProductModel::getAll($limit);

            foreach ($products as $key => $product) {
                $products[$key]['variants'] = ProductVariantModel::getByProductId($product['product_id']);
                $products[$key]['average_rating'] = ReviewModel::getAverageRatingByProductId($product['product_id']);
                $products[$key]['count_reviews'] = ReviewModel::getCountReviewsByProductId($product['product_id']);

                $minPrice = null;
                $maxPrice = null;
                $priceFromMinPrice = null;
                $quantity = 0;
                $sold_quantity = 0;

                foreach ($products[$key]['variants'] as $key2 => $variant) {
                    $quantity += $variant['quantity'];
                    $sold_quantity += $variant['sold_quantity'];

                    $values = ProductVariantValueModel::getByProductVariantId($variant['product_variant_id']);
                    $products[$key]['variants'][$key2]['value'] =  $values;

                    foreach ($values as $value) {
                        $products[$key]['attributes'][$value['name']][] = $value['value'];
                        $products[$key]['attributes'][$value['name']] = array_unique($products[$key]['attributes'][$value['name']]);
                    }

                    // Tính minmax
                    if ($variant['promotion_price'] === null) {
                        $currentMin = $variant['price']; // Nếu promotion_price là null, chỉ sử dụng price
                        $currentMinPromotion = null; // Không có promotion_price
                    } else {
                        $currentMin = min($variant['price'], $variant['promotion_price']);
                        $currentMinPromotion = ($currentMin === $variant['promotion_price']) ? $variant['price'] : null;
                    }

                    if ($minPrice === null || $currentMin < $minPrice) {
                        $minPrice = $currentMin;
                        $priceFromMinPrice = $currentMinPromotion; // Lưu giá trị của promotion_price nếu minPrice từ promotion_price
                    }

                    // Kiểm tra giá trị max giữa price và promotion_price
                    if ($variant['promotion_price'] === null) {
                        $currentMax = $variant['price'];
                    } else {
                        $currentMax = max($variant['price'], $variant['promotion_price']);
                    }

                    // Cập nhật maxPrice nếu chưa được thiết lập hoặc tìm thấy giá cao hơn
                    if ($maxPrice === null || $currentMax > $maxPrice) {
                        $maxPrice = $currentMax;
                    }
                }
                // Chỉnh sửa attributes
                $products[$key]['attributes'] = $products[$key]['attributes'] ?? [];

                $products[$key]['min_price'] = $minPrice;
                $products[$key]['max_price'] = $maxPrice;
                $products[$key]['price_from_min_price'] = $priceFromMinPrice;
                $products[$key]['quantity'] = $quantity;
                $products[$key]['sold_quantity'] = $sold_quantity;

                $products[$key]['images'] = ProductImageModel::getByProductId($product['product_id']);
                $products[$key]['category'] = CategoryModel::getByProductId($product['product_id']);
                $products[$key]['details'] = ProductDetailModel::getByProductId($product['product_id']);
            }

            Response::json($products);
        } catch (\Throwable $th) {
            Log::throwable("Lỗi lấy danh sách sản phẩm: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Lấy 1 sản phẩm theo product_id
    public function find($id) {
        try {
            // Lấy product_id từ request
            $productId = $id;

            // Lấy sản phẩm theo product_id
            $product = ProductModel::getByProductId($productId);

            if (!$product) {
                // Nếu không tìm thấy sản phẩm, trả về lỗi
                Response::json(['message' => 'Không tìm thấy sản phẩm'], 404);
                return;
            }

            // Lấy các thông tin liên quan đến sản phẩm
            $product['variants'] = ProductVariantModel::getByProductId($product['product_id']);
            $product['average_rating'] = ReviewModel::getAverageRatingByProductId($product['product_id']);
            $product['count_reviews'] = ReviewModel::getCountReviewsByProductId($product['product_id']);

            $minPrice = null;
            $maxPrice = null;
            $priceFromMinPrice = null;
            $quantity = 0;
            $sold_quantity = 0;

            foreach ($product['variants'] as $key2 => $variant) {
                $quantity += $variant['quantity'];
                $sold_quantity += $variant['sold_quantity'];

                $values = ProductVariantValueModel::getByProductVariantId($variant['product_variant_id']);
                $product['variants'][$key2]['values'] =  $values;

                foreach ($values as $value) {
                    $product['attributes'][$value['name']][] = $value['value'];
                    $product['attributes'][$value['name']] = array_unique($product['attributes'][$value['name']]);
                }

                // Tính minmax
                if ($variant['promotion_price'] === null) {
                    $currentMin = $variant['price']; // Nếu promotion_price là null, chỉ sử dụng price
                    $currentMinPromotion = null; // Không có promotion_price
                } else {
                    $currentMin = min($variant['price'], $variant['promotion_price']);
                    $currentMinPromotion = ($currentMin === $variant['promotion_price']) ? $variant['price'] : null;
                }

                if ($minPrice === null || $currentMin < $minPrice) {
                    $minPrice = $currentMin;
                    $priceFromMinPrice = $currentMinPromotion; // Lưu giá trị của promotion_price nếu minPrice từ promotion_price
                }

                // Kiểm tra giá trị max giữa price và promotion_price
                if ($variant['promotion_price'] === null) {
                    $currentMax = $variant['price'];
                } else {
                    $currentMax = max($variant['price'], $variant['promotion_price']);
                }

                // Cập nhật maxPrice nếu chưa được thiết lập hoặc tìm thấy giá cao hơn
                if ($maxPrice === null || $currentMax > $maxPrice) {
                    $maxPrice = $currentMax;
                }
            }
            // Chỉnh sửa attributes
            $product['attributes'] = $product['attributes'] ?? [];

            // Gán các giá trị cho sản phẩm
            $product['min_price'] = $minPrice;
            $product['max_price'] = $maxPrice;
            $product['price_from_min_price'] = $priceFromMinPrice;
            $product['quantity'] = $quantity;
            $product['sold_quantity'] = $sold_quantity;

            // Lấy thêm hình ảnh, danh mục và chi tiết sản phẩm
            $product['images'] = ProductImageModel::getByProductId($product['product_id']);
            $product['category'] = CategoryModel::getByProductId($product['product_id']);
            $product['details'] = ProductDetailModel::getByProductId($product['product_id']);


            // Trả về kết quả dưới dạng JSON
            Response::json($product);
        } catch (\Throwable $th) {
            Log::throwable("AddressController -> userGet: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Seller lấy danh sách sản phẩm
    public function sellerGet() {
        try {
            $seller = Auth::seller();
            $limit = Request::get('limit', 12);
            $page = Request::get('page', 1);
            $status = Request::get('status', 'all');

            $count = ProductModel::countBySellerId($seller['seller_id'], $status);
            $products = ProductModel::getBySellerId($seller['seller_id'], $status, $limit, $page);

            foreach ($products as $key => $product) {
                $products[$key]['variants'] = ProductVariantModel::getByProductId($product['product_id']);
                $products[$key]['average_rating'] = ReviewModel::getAverageRatingByProductId($product['product_id']);
                $products[$key]['count_reviews'] = ReviewModel::getCountReviewsByProductId($product['product_id']);

                $minPrice = null;
                $maxPrice = null;
                $priceFromMinPrice = null;
                $quantity = 0;
                $sold_quantity = 0;

                foreach ($products[$key]['variants'] as $key2 => $variant) {
                    $quantity += $variant['quantity'];
                    $sold_quantity += $variant['sold_quantity'];

                    $values = ProductVariantValueModel::getByProductVariantId($variant['product_variant_id']);
                    $products[$key]['variants'][$key2]['value'] =  $values;

                    foreach ($values as $value) {
                        $products[$key]['attributes'][$value['name']][] = $value['value'];
                        $products[$key]['attributes'][$value['name']] = array_unique($products[$key]['attributes'][$value['name']]);
                    }

                    // Tính minmax
                    if ($variant['promotion_price'] === null) {
                        $currentMin = $variant['price']; // Nếu promotion_price là null, chỉ sử dụng price
                        $currentMinPromotion = null; // Không có promotion_price
                    } else {
                        $currentMin = min($variant['price'], $variant['promotion_price']);
                        $currentMinPromotion = ($currentMin === $variant['promotion_price']) ? $variant['price'] : null;
                    }

                    if ($minPrice === null || $currentMin < $minPrice) {
                        $minPrice = $currentMin;
                        $priceFromMinPrice = $currentMinPromotion; // Lưu giá trị của promotion_price nếu minPrice từ promotion_price
                    }

                    // Kiểm tra giá trị max giữa price và promotion_price
                    if ($variant['promotion_price'] === null) {
                        $currentMax = $variant['price'];
                    } else {
                        $currentMax = max($variant['price'], $variant['promotion_price']);
                    }

                    // Cập nhật maxPrice nếu chưa được thiết lập hoặc tìm thấy giá cao hơn
                    if ($maxPrice === null || $currentMax > $maxPrice) {
                        $maxPrice = $currentMax;
                    }
                }
                // Chỉnh sửa attributes
                $products[$key]['attributes'] = $products[$key]['attributes'] ?? [];

                $products[$key]['min_price'] = $minPrice;
                $products[$key]['max_price'] = $maxPrice;
                $products[$key]['price_from_min_price'] = $priceFromMinPrice;
                $products[$key]['quantity'] = $quantity;
                $products[$key]['sold_quantity'] = $sold_quantity;

                $products[$key]['images'] = ProductImageModel::getByProductId($product['product_id']);
                $products[$key]['category'] = CategoryModel::getByProductId($product['product_id']);
                $products[$key]['details'] = ProductDetailModel::getByProductId($product['product_id']);
            }

            Response::json(['count' => $count, 'products' => $products]);
        } catch (\Throwable $th) {
            Log::throwable("AddressController -> sellerGet: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Seller thêm sản phẩm
    public function sellerAdd() {
        try {
            $seller = Auth::seller();

            $seller_id = $seller['seller_id'];
            $name = Request::post('name');
            $description = Request::post('description');
            $category_id = Request::post('category_id') === '' ? null : Request::post('category_id');
            $product_details = is_array(Request::post('product_details', [], true)) ? Request::post('product_details', [], true) : [];
            $product_variants = is_array(Request::post('product_variants', [], true)) ? Request::post('product_variants', [], true) : [];
            $images = Request::files('images');

            // Response::json([
            //     'name' => $name,
            //     'description' => $description,
            //     'category_id' => $category_id,
            //     'product_details' => $product_details,
            //     'product_variants' => $product_variants,
            //     'images' => $images
            // ], 200);



            // Kiểm tra đầu vào
            $this->checkAddProduct($name, $description, $category_id, $images, $product_details, $product_variants);

            // Thêm thông tin product
            $product_id = ProductModel::add($name, $description, $seller_id, $category_id);

            // Thêm ảnh sản phẩm
            $default = 1;
            $countImageUpload = 0;
            foreach ($images as $image) {
                $fileSave = FileSave::productImage($image);
                if ($fileSave['success'] === true) {
                    ProductImageModel::add($product_id, $fileSave['file_name'], $default);
                    $default = 0;
                    $countImageUpload++;
                }
            }
            if ($countImageUpload === 0) {
                Response::json(['message' => 'Có lỗi xảy ra, số ảnh được tải lên ít hơn 1'], 400);
            }

            // Thêm thống tin chi tiết
            foreach ($product_details as $product_detail) {
                ProductDetailModel::add(
                    $product_id,
                    $product_detail['name'],
                    $product_detail['description']
                );
            }

            // Thêm thuộc tính
            if (count($product_variants) > 1) {
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

                $product_attributes = array_values($product_attributes);

                $combinationsCount = 1;
                foreach ($product_attributes as $attribute) {
                    $combinationsCount *= count($attribute['values']);
                }

                if ($combinationsCount !== count($product_variants)) {
                    Response::json([
                        'message' => 'Số lượng tổ hợp thuộc tính không khớp với số lượng biến thể sản phẩm.'
                    ]);
                }

                $attribute_value = [];
                foreach ($product_attributes as $attribute) {
                    $product_attribute_id =  ProductAttributeModel::add(
                        $attribute['name']
                    );


                    foreach ($attribute['values'] as $key => $value) {
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

                foreach ($product_variants as $variant) {
                    $product_variant_id = ProductVariantModel::add(
                        $product_id,
                        $variant['quantity'],
                        $variant['price'],
                        $variant['promotion_price'] ?? null
                    );

                    foreach ($variant['attributes'] as $attribute) {
                        foreach ($attribute_value as $key => $value) {
                            if ($value['name'] === $attribute['name'] && $value['value'] === $attribute['value']) {
                                ProductVariantValueModel::add(
                                    $product_variant_id,
                                    $value['product_attribute_value_id']
                                );
                            }
                        }
                    }
                }

                Response::json(['message' => 'Thêm sản phẩm thành công'], 201);
            } else {
                // Nếu k có thuộc tính
                foreach ($product_variants as $variant) {
                    ProductVariantModel::add(
                        $product_id,
                        $variant['quantity'],
                        $variant['price'],
                        $variant['promotion_price'] ?? null
                    );
                }
                Response::json(['message' => 'Thêm sản phẩm thành công'], 201);
            }
        } catch (\Throwable $th) {
            Log::throwable("AddressController -> sellerAdd: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Kiểm tra thêm sản phẩm
    private function checkAddProduct($name, $description, $category_id, $images, $product_details, $product_variants) {
        $checkName = Validator::isText($name, 'Tên sản phẩm', 3, 100);
        if ($checkName !== true) {
            Response::json(['message' => $checkName], 400);
        }

        $checkDescription = Validator::isText($description, 'Mota', 0, 5000, true);
        if ($checkDescription !== true) {
            Response::json(['message' => $checkDescription], 400);
        }

        if (!empty($category_id)) {
            $checkCategory = CategoryModel::find($category_id);
            if (!$checkCategory) {
                Response::json(['message' => 'Không tìm thấy danh mục'], 400);
            }
        }

        if (!$images || count($images) < 1) {
            Response::json(['message' => 'Sản phẩm cần ít nhất 1 hình ảnh'], 400);
        }

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
                if ($variant['promotion_price'] <= 0) {
                    Response::json(['message' => "Giá khuyến mãi phải lớn hơn 0"], 400);
                }
            }
        }
    }
}
