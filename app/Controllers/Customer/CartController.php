<?php

require_once 'app/Models/Cart.php';
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

        // foreach ($cart_result as $cart) {
        //     $sellerId = $cart['seller_id'];
        //     $variantId = $cart['variant_id'];

        //     // Tạo nhóm theo seller_id và product_variant_id
        //     if (!isset($groupedCarts[$sellerId])) {
        //         $groupedCarts[$sellerId] = [
        //             'seller_id' => $cart['seller_id'],
        //             'seller_name' => $cart['seller_name'],
        //             'products' => [],
        //         ];
        //     }

        //     // Nếu product_variant_id đã tồn tại, chỉ cần thêm phân loại
        //     if (isset($groupedCarts[$sellerId]['products'][$variantId])) {
        //         $groupedCarts[$sellerId]['products'][$variantId]['attributes'][] = [
        //             'attribute_name' => $cart['product_attribute'],
        //             'attribute_value' => $cart['product_attribute_value'],
        //         ];
        //     } else {
        //         // Nếu product_variant_id chưa tồn tại, thêm sản phẩm mới
        //         $groupedCarts[$sellerId]['products'][$variantId] = [
        //             'product_id' => $cart['product_id'],
        //             'product_name' => $cart['product_name'],
        //             'product_image' => $cart['product_image'],
        //             'cart_quantity' => $cart['cart_quantity'],
        //             'cart_id' => $cart['cart_id'],
        //             'product_price' => $cart['product_price'],
        //             'product_promotion_price' => $cart['product_promotion_price'],
        //             'attributes' => [
        //                 [
        //                     'attribute_name' => $cart['product_attribute'],
        //                     'attribute_value' => $cart['product_attribute_value'],
        //                 ]
        //             ],
        //         ];
        //     }
        // }


        $data = [
            'title' => 'Giỏ hàng',
            'groupedCarts' => $groupedCarts
        ];

        Console::log($data);
        // return 'end';

        return View::make('Customer/cart', $data);
    }

    public function apiAdd()
    {

        $user = Auth::getUser() ?? null;
        $product_variant_id = Request::post('product_variant_id');
        $quantity = Request::post('quantity');

        $cart = new Cart();
        $check = $cart->checkCartByUserIdAndProductVariantId($user['id'], $product_variant_id);

        if ($check) {
            $quantity = $cart->getQuantityCartByUserIdAndProductVariantId($user['id'], $product_variant_id) + $quantity;
            $result = $cart->updateCart($user['id'], $product_variant_id, $quantity);
        } else {
            $result = $cart->addCart($user['id'], $product_variant_id, $quantity);
        }

        if (!$result) {
            return Api::encode(null, 'Thêm vào giỏ hàng khônng thành công', 'error');
        }

        return Api::encode(null, 'Thêm vào giỏ hàng thành công', 'success');
    }
}
