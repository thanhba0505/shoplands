<?php

namespace App\Controllers;

use App\Helpers\Request;
use App\Helpers\Response;
use App\Models\CategoryModel;
use App\Models\ProductDetailModel;
use App\Models\ProductImageModel;
use App\Models\ProductModel;
use App\Models\ProductVariantModel;
use App\Models\ProductVariantValueModel;
use App\Models\ReviewModel;

class ProductController
{
    public function getAll()
    {
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
    }
}
