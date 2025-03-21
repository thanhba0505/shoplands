<?php

namespace App\Controllers;

use App\Helpers\Auth;
use App\Helpers\Log;
use App\Helpers\Request;
use App\Helpers\Response;
use App\Models\CategoryModel;
use App\Models\ProductDetailModel;
use App\Models\ProductImageModel;
use App\Models\ProductModel;
use App\Models\ProductVariantModel;
use App\Models\ProductVariantValueModel;
use App\Models\ReviewModel;

class ProductController {
    public function getAll() {
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
    public function getByProductId($id) {
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
    }

    // Seller lấy danh sách sản phẩm
    public function sellerGetAll() {
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
            Log::throwable("Lỗi lấy danh sách sản phẩm: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }
}
