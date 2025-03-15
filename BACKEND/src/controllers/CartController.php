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

class CartController {
    // Lấy danh sách sản phẩm trong giỏ hàng
    public function getAll() {
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

    // Thêm vào giỏ hàng
    public function addCart() {
        $user = Auth::user();

        $productVariantId = Request::json("product_variant_id");
        $quantity = Request::json("quantity");

        if (!$productVariantId || !$quantity) {
            Response::json([
                "message" => "Không tìm thấy thông tin"
            ], 400);
        }

        $checkCart = CartModel::checkCart($user["user_id"], $productVariantId);
        $checkQuantity = ProductVariantModel::getByProductVariantId($productVariantId);

        $status = null;

        if ($checkCart) {
            $quantity += $checkCart["quantity"];

            if ($checkQuantity["quantity"] < $quantity) {
                Response::json([
                    "message" => "Số lượng tồn kho không đủ",
                    "quantity" => $checkQuantity["quantity"]
                ], 400);
            }
            $result = CartModel::updateCart($user["user_id"], $productVariantId, $quantity);
            $status = 200;
        } else {

            if ($checkQuantity["quantity"] < $quantity) {
                Response::json([
                    "message" => "Số lượng tồn kho không đủ",
                    "quantity" => $checkQuantity["quantity"]
                ], 400);
            }
            $result = CartModel::addCart($user["user_id"], $productVariantId, $quantity);
            $status = 201;
        }

        if ($result) {
            Response::json([
                "message" => "Thêm vào giỏ hàng thành công",
                "quantity" => $checkQuantity["quantity"]
            ], $status);
        } else {
            Response::json([
                "message" => "Thêm vào giỏ hàng thất bại",
                "quantity" => $checkQuantity["quantity"]
            ], 400);
        }
    }

    // Cập nhật giỏ hàng
    public function updateCart() {
        $user = Auth::user();

        $productVariantId = Request::json("product_variant_id");
        $quantity = Request::json("quantity");

        if (!$productVariantId || !$quantity) {
            Response::json([
                "message" => "Không tìm thấy thông tin"
            ], 400);
        }

        $checkQuantity = ProductVariantModel::getByProductVariantId($productVariantId);

        if ($checkQuantity["quantity"] < $quantity) {
            Response::json([
                "message" => "Số lượng tồn kho không đủ",
                "quantity" => $checkQuantity["quantity"]
            ], 400);
        }

        $result = CartModel::updateCart($user["user_id"], $productVariantId, $quantity);

        if ($result) {
            Response::json([
                "message" => "Cập nhật giỏ hàng thành công",
                "quantity" => $checkQuantity["quantity"]
            ], 200);
        } else {
            Response::json([
                "message" => "Cập nhật giỏ hàng thất bại",
                "quantity" => $checkQuantity["quantity"]
            ], 400);
        }
    }

    // Xóa khỏi giỏ hàng
    public function deleteCart() {
        $user = Auth::user();

        $cartId = Request::json("cart_id");

        if (!$cartId) {
            Response::json([
                "message" => "Không tìm thấy thông tin"
            ], 400);
        }

        $result = CartModel::deleteCart($user["user_id"], $cartId);

        if ($result) {
            Response::json([
                "message" => "Xóa khỏi giỏ hàng thành công"
            ], 200);
        } else {
            Response::json([
                "message" => "Xóa khỏi giỏ hàng thất bại"
            ], 400);
        }
    }

    // Lấy sản phẩm theo cart id
}
