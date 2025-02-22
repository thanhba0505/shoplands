<?php

require_once 'app/Models/Cart.php';
require_once 'app/Models/Product.php';
require_once 'app/Models/ProductVariant.php';

class CartController
{
    public function show()
    {
        $user = Auth::getUser() ?? null;
        $userId = $user['id'];

        $cartModel = new Cart();
        $sellers = $cartModel->getSellersByUserId($userId);

        $productVariantModel = new ProductVariant();

        // Nhóm dữ liệu $carts theo seller_id và product_variant_id
        $groupedCarts = [];

        foreach ($sellers as $seller) {
            $sellerId = $seller['s_id'];

            $groupedCarts[$sellerId] = [
                's_id' => $sellerId,
                's_name' => $seller['s_name'],
                'products' => $cartModel->getProductVariandBySellerId($sellerId, $userId),
            ];

            foreach ($groupedCarts[$sellerId]['products'] as $key => $product) {
                $productVariants =  $productVariantModel->getVariantValueByProductVariantId($product['pv_id']);

                $groupedCarts[$sellerId]['products'][$key]['attributes'] = $productVariants;
            }
        }

        // Lấy sản phẩm gợi ý
        $productModel = new Product();
        $products = $productModel->getProducts();


        $data = [
            'title' => 'Giỏ hàng',
            'products' => $products,
            'groupedCarts' => $groupedCarts
        ];

        return View::make('Customer/cart', $data);
    }

    // Api xóa giỏ hàng
    public function apiDelete()
    {
        $user = Auth::getUser() ?? null;
        $cart_id = Request::post('cart_id');

        $cart = new Cart();
        $result = $cart->deleteCart($user['id'], $cart_id);

        if (!$result || $result == 0 || $cart_id == null) {
            return Api::encode(null, 'Xóa giỏ hàng không thành công', 'error');
        }

        return Api::encode($cart_id, 'Xóa giỏ hàng thành công', 'success');
    }

    // Api thêm vào giỏ hàng
    public function apiAdd()
    {

        $user = Auth::getUser() ?? null;
        $product_variant_id = Request::post('product_variant_id');
        $quantity = Request::post('quantity');

        if ($product_variant_id == null || $quantity == null) {
            return Api::encode(null, 'Thêm vào giỏ hàng không thành công', 'error');
        }

        $cart = new Cart();
        $check = $cart->checkCartByUserIdAndProductVariantId($user['id'], $product_variant_id);

        if ($check) {
            $quantity = $cart->getQuantityCartByUserIdAndProductVariantId($user['id'], $product_variant_id) + $quantity;
            $result = $cart->updateCart($user['id'], $product_variant_id, $quantity);
        } else {
            $result = $cart->addCart($user['id'], $product_variant_id, $quantity);
        }

        if (!$result) {
            return Api::encode(null, 'Thêm vào giỏ hàng không thành công', 'error');
        }

        return Api::encode(null, 'Thêm vào giỏ hàng thành công', 'success');
    }
}
