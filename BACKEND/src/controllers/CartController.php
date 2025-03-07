<?php

namespace App\Controllers;

use App\Helpers\Auth;
use App\Helpers\Request;
use App\Helpers\Response;
use App\Models\CartModel;
use App\Models\ProductImageModel;
use App\Models\ProductModel;
use App\Models\ProductVariantModel;
use App\Models\ProductVariantValueModel;

class CartController
{
    public function getAll()
    {
        $user = Auth::user();

        $carts["user_id"] = $user["user_id"];

        $carts["group"] = CartModel::getSellersByUserId($user["user_id"]);

        foreach ($carts["group"] as $key => $cart) {
            $cartDetails = CartModel::getCartsByUserIdAndSellerId($user["user_id"], $cart["seller_id"]);

            foreach ($cartDetails as $key2 => $cartDetail) {
                $product = ProductModel::getByCartId($cartDetail["cart_id"]);
                $cartDetails[$key2]["product"] = $product;

                $productVariant = ProductVariantModel::getByCartId($cartDetail["cart_id"]);
                $cartDetails[$key2]["product_variant"] = $productVariant;
                $cartDetails[$key2]['image'] = ProductImageModel::getDefault($product["product_id"]);
                $cartDetails[$key2]['variant_value'] = ProductVariantValueModel::getByProductVariantId($productVariant['product_variant_id']);
            }

            $carts["group"][$key]['cart_details'] = $cartDetails;
        }



        Response::json($carts);
    }


    public function addCart()
    {
        $user = Auth::user();

        $productVariantId = Request::json("product_variant_id");
        $quantity = Request::json("quantity");

        if (!$productVariantId || !$quantity) {
            Response::json([
                "message" => "Không tìm thấy thông tin"
            ], 400);
        }

        $result = CartModel::addCart($user["user_id"], $productVariantId, $quantity);

        if ($result) {
            Response::json([
                "message" => "Thêm vào giỏ hàng thành công"
            ], 201);
        } else {
            Response::json([
                "message" => "Thêm vào giỏ hàng thất bại thành công"
            ], 400);
        }
    }

    public function updateCart()
    {
        Response::json([]);
    }

    public function deleteCart()
    {
        Response::json([]);
    }
}
