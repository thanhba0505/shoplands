<?php
require_once 'app/Models/Product.php';
require_once 'app/Models/Seller.php';
require_once 'app/Models/Category.php';

class ShopController
{
    public function show()
    {
        $id = Request::get('id');

        if (!$id) {
            Redirect::error()->notification('Không tìm thấy cửa hàng', 'error')->redirect();
        }

        // Lấy thông tin cửa hàng
        $sellerModel = new Seller();
        $seller = $sellerModel->findBySellerId($id);

        $reviewInfo = $sellerModel->getReviewInfoBySellerId($id);
        $seller['countReviews'] = $reviewInfo['count'];
        $seller['averageRating'] = $reviewInfo['rating'];

        $seller['countProducts'] = $sellerModel->getProductCountBySellerId($id);

        // Lấy danh sách sản phẩm bán chạy
        $productModel = new Product();
        $bestSellingProducts = $productModel->getProducts(6);

        // Gọi model đến sản phẩm
        $product = new Product();
        $product_result = $product->getProducts();

        // Lọc sản phẩm
        $filter = [
            'min_price' => Request::get('min_price'),
            'max_price' => Request::get('max_price'),
            'categories' => Request::get('categories', []),
            'ratings' => Request::get('ratings', [])
        ];
        

        $arrange = [
            'latest' => Request::get('latest'),
            'popular' => Request::get('popular'),
            'price' => in_array(Request::get('price'), ['asc', 'desc']) ? Request::get('price') : '',
        ];

        // Gọi model đến danh mục
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();

        $data = [
            'title' => 'Shop Page',
            'seller' => $seller,
            'bestSellingProducts' => $bestSellingProducts,
            'products' => $product_result,
            'categories' => $categories,
            'arrange' => $arrange,
            'filter' => $filter
        ];

        return View::make('Customer/shop', $data);
    }
}
