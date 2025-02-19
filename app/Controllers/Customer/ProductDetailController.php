<?php

require_once 'app/Models/Product.php';
require_once 'app/Models/ProductVariant.php';
require_once 'app/Models/ProductImage.php';
require_once 'app/Models/ProductDetail.php';
require_once 'app/Models/Category.php';
require_once 'app/Models/Review.php';
require_once 'app/Models/ReviewImage.php';
require_once 'app/Models/Seller.php';

class ProductDetailController
{
    public function show()
    {
        $id = Request::get('id');

        // Lấy thông tin chi tiêt sản phẩm
        $productModel = new Product();
        $product = $productModel->getByProductId($id);
        $product['quantity'] = $productModel->getQuantityByProductId($id);
        $product['sold_quantity'] = $productModel->getSoldQuantityByProductId($id);

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

        // Lấy danh sách sản phẩm của shop
        $shopProducts = $productModel->getProducts(6, sellerId: $product['seller_id']);

        // Lấy danh sách sản phẩm gợi ý
        $relatedProducts = $productModel->getProducts(30);

        // Lấy hình ảnh sản phẩm
        $imageModel = new ProductImage();
        $images = $imageModel->getImagesByProductId($id);

        // Lấy chi tiết sản phẩm
        $productDetailModel = new ProductDetail();
        $productDetail = $productDetailModel->getDetailByProductId($id);

        // Lấy danh mục của sản phẩm
        $categoryModel = new Category();
        $category = $categoryModel->getCategoryByProductId($id);

        // Lấy danh sách đánh giá
        $reviewModel = new Review();
        $reviews['content'] = $reviewModel->getReviewsByProductId($id);


        if (!empty($reviews['content'])) {
            $reviewImageModel = new ReviewImage();
            foreach ($reviews['content'] as $key => $value) {
                $reviews['content'][$key]['images'] = $reviewImageModel->getImagesByReviewId($value['review_id']);
                $reviews['content'][$key]['variants'] = $productVariantModel->getVariantValueByProductVariantId($value['product_variant_id']);
            }
        }

        $reviews['averageRating'] = $reviewModel->getAverageRatingByProductId($id);
        $reviews['total'] = $reviewModel->getTotalReviewsByProductId($id);
        $reviews['totalWithComments'] = $reviewModel->getReviewCountWithCommentByProductId($id);
        $reviews['totalWithImages'] = $reviewModel->getReviewCountWithImagesByProductId($id);

        $ratingCounts = $reviewModel->getRatingCountsByProductId($id);

        $ratings = [];

        for ($i = 5; $i >= 1; $i--) {
            $ratings[$i] = 0;
        }

        foreach ($ratingCounts as $row) {
            $ratings[$row['rating']] = $row['count'];
        }

        $reviews['ratingCounts'] = $ratings;

        // Lấy thông tin shop
        $sellerModel = new Seller();
        $seller = $sellerModel->findBySellerId($product['seller_id']);

        $reviewInfo = $sellerModel->getReviewInfoBySellerId($product['seller_id']);
        $seller['countReviews'] = $reviewInfo['count'];
        $seller['averageRating'] = $reviewInfo['rating'];

        $seller['countProducts'] = $sellerModel->getProductCountBySellerId($product['seller_id']);

        Console::log($reviews);
        $data = [
            'title' => 'Product Detail Page',
            'id' => $id,
            'product' => $product,
            'shopProducts' => $shopProducts,
            'relatedProducts' => $relatedProducts,
            'productVariant' => $productVariant,
            'attributes' => $attributes,
            'similarProducts' => $similarProducts,
            'images' => $images,
            'productDetail' => $productDetail,
            'category' => $category,
            'reviews' => $reviews,
            'seller' => $seller
        ];

        return View::make('Customer/product-detail', $data);
    }
}
