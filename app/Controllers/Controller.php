<?php

require_once 'app/Models/Product.php';
require_once 'app/Models/ProductVariant.php';
require_once 'app/Models/Review.php';
require_once 'app/Models/ProductImage.php';

class Controller
{
    public function getProducts($limit = 12, $filter = [], $arrange = [])
    {
        $productModel = new Product();
        $productVariantModel = new ProductVariant();
        $reviewModel = new Review();

        $products = $productModel->getAllByOptions($limit, $filter, $arrange);

        // Nhóm dữ liệu

        foreach ($products as $key1 => $product) {
            $variants = $productVariantModel->getVariantProductId($product['id']);

            $listPromotionPrice = array_column($variants, 'promotion_price');
            $listPrice = array_column($variants, 'price');

            // Lọc bỏ các giá trị null và chuyển đổi sang kiểu float
            $filteredArray1 = array_filter($listPrice, function ($value) {
                return $value !== null;
            });
            $filteredArray1 = array_map('floatval', $filteredArray1);

            $filteredArray2 = array_filter($listPromotionPrice, function ($value) {
                return $value !== null;
            });
            $filteredArray2 = array_map('floatval', $filteredArray2);

            // Gộp hai mảng lại
            $combinedArray = array_merge($filteredArray1, $filteredArray2);

            // Tìm giá trị nhỏ nhất
            $minPrice = min($combinedArray);

            foreach ($variants as $variant) {
                if (floatval($variant['price']) == $minPrice) {
                    $products[$key1]['min_price'] = $variant['price'];
                    $products[$key1]['promotion_price_for_min'] = $variant['promotion_price'];
                    $products[$key1]['sold_quantity'] = $variant['sold_quantity'];
                    break;
                }
                if (floatval($variant['promotion_price']) == $minPrice) {
                    $products[$key1]['min_price'] = $variant['price'];
                    $products[$key1]['promotion_price_for_min'] = $variant['promotion_price'];
                    $products[$key1]['sold_quantity'] = $variant['sold_quantity'];
                    break;
                }
            }

            // Tính tổng đã bán
            $totalSoldQuantity = array_sum(array_column($variants, 'sold_quantity'));
            $products[$key1]['total_sold_quantity'] = $totalSoldQuantity;

            // Lấy trung bình đánh giá
            $averageRating = $reviewModel->getAverageRatingByProductId($product['id']);
            $products[$key1]['average_rating'] = $averageRating;

            // Lấy hình anh
            $productImageModel = new ProductImage();
            $products[$key1]['image'] = $productImageModel->getDefaultImage($product['id']);
        }



        Console::log($products);

        return $products;
    }
}
