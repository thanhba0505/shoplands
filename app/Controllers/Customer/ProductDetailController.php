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

        if (!$id) {
            Redirect::error()->notification('Không tìm thấy sản phẩm', 'error')->redirect();
        }

        $productModel = new Product();
        $product = $productModel->getByProductId($id);

        $productVariantModel = new ProductVariant();
        $product['product_description'] = '';
        $product['quantity'] = $productModel->getQuantityByProductId($id);
        $product['sold_quantity'] = $productModel->getSoldQuantityByProductId($id);

        $product['variants'] = $productVariantModel->getVariantProductId($id);

        $groupedAttributes = [];

        foreach ($product['variants'] as $key => $variant) {
            $attributes = $productVariantModel->getVariantValueByProductVariantId($variant['id']);

            $transformed_attributes = [];

            foreach ($attributes as $attribute) {
                $transformed_attributes[$attribute["pa_id"]] = $attribute["pav_id"];
            }

            $product['variants'][$key]['attributes'] = $transformed_attributes;

            foreach ($attributes as $attribute) {
                $pa_id = $attribute['pa_id'];
                $pav_id = $attribute['pav_id'];
                $value = $attribute['value'];
                $name = $attribute['name'];

                // Nếu chưa tồn tại nhóm thuộc tính này, khởi tạo nó
                if (!isset($groupedAttributes[$pa_id])) {
                    $groupedAttributes[$pa_id] = [
                        'name' => $name,
                        'values' => []
                    ];
                }

                // Thêm giá trị vào nhóm thuộc tính
                if (!isset($groupedAttributes[$pa_id]['values'][$pav_id])) {
                    $groupedAttributes[$pa_id]['values'][$pav_id] = $value;
                }
            }
        }

        $product['groupedAttributes'] = $groupedAttributes;


        // Lấy danh sách sản phẩm tương tự
        $similarProducts = $productModel->getProducts(6);

        // Lấy danh sách sản phẩm của shop
        $shopProducts = $productModel->getProductsShop($product['seller_id'], 6);

        // Lấy danh sách sản phẩm gợi ý
        $relatedProducts = $productModel->getProducts(30);

        // Lấy hình ảnh sản phẩm
        $imageModel = new ProductImage();
        $product['images'] = $imageModel->getImagesByProductId($id);

        // Lấy chi tiết sản phẩm
        $productDetailModel = new ProductDetail();
        $product['details'] = $productDetailModel->getDetailByProductId($id);

        // Lấy danh mục của sản phẩm
        $categoryModel = new Category();
        $product['category'] = $categoryModel->getCategoryByProductId($id);

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

        $product['reviews'] = $reviews;

        // Lấy thông tin shop
        $sellerModel = new Seller();
        $seller = $sellerModel->findBySellerId($product['seller_id']);

        $reviewInfo = $sellerModel->getReviewInfoBySellerId($product['seller_id']);
        $seller['countReviews'] = $reviewInfo['count'];
        $seller['averageRating'] = $reviewInfo['rating'];

        $seller['countProducts'] = $sellerModel->getProductCountBySellerId($product['seller_id']);

        $product['seller'] = $seller;

        $data = [
            'title' => 'Product Detail Page',
            'id' => $id,
            'product' => $product,
            'similarProducts' => $similarProducts,
            'shopProducts' => $shopProducts,
            'relatedProducts' => $relatedProducts
        ];

        return View::make('Customer/product-detail', $data);
    }
}
