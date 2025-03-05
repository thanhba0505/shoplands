<?php

namespace App\Controllers;

use App\Helpers\Auth;
use App\Helpers\Request;
use App\Helpers\Response;
use App\Models\CartModel;

class CartController
{
    public function getAll()
    {
        $user = Auth::user();

        $carts["user_id"] = $user["user_id"];

        $sellers = CartModel::getSellersByUserId($user["user_id"]);

        $carts["sellers"] = $sellers;

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

        Response::json($result);
    }
}
