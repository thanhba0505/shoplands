<?php

namespace App\Controllers;

use App\Helpers\Auth;
use App\Helpers\Format;
use App\Helpers\Log;
use App\Helpers\QRCode;
use App\Helpers\Request;
use App\Helpers\Response;
use App\Models\AddressModel;
use App\Models\CartModel;
use App\Models\CouponModel;
use App\Models\OrderItemModel;
use App\Models\OrderModel;
use App\Models\OrderStatusModel;
use App\Models\ProductImageModel;
use App\Models\ProductModel;
use App\Models\ProductVariantValueModel;
use App\Models\SellerModel;
use App\Models\ShippingFeeModel;
use App\Models\UserModel;

class OrderController {
    // Lấy danh sách đơn hàng của người dùng
    public function getAll() {
        try {
            $user = Auth::user();
            $orders = OrderModel::getByUserId($user["user_id"]);
            Response::json($orders, 200);
        } catch (\Throwable $th) {
            Log::throwable("Lỗi lấy danh sách đơn hàng theo người dùng: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Tạo đơn hàng
    public function add() {
        try {
            $user = Auth::user();

            $userId = $user["user_id"];
            $toAddressId = Request::json("address_id");
            $shippingFeeId = Request::json("shipping_fee_id");
            $couponId = Request::json("coupon_id");
            $cartIds = Request::json("cart_ids");

            if (empty($toAddressId) || empty($shippingFeeId) || empty($cartIds)) {
                Response::json(['message' => 'Thông tin tạo đơn hàng không đủ'], 400);
            }
            // Kiểm tra seller
            $seller = SellerModel::findSellerByCartId($cartIds[0]);
            if (!$seller) {
                Response::json(['message' => 'Không tìm thấy thông tin người bán'], 400);
            }

            // Kiểm tra địa chỉ
            $fromAddress = AddressModel::findFromAddress($seller["seller_id"]);
            if (!$fromAddress) {
                Response::json(['message' => 'Không tìm thấy địa chỉ người bán'], 400);
            }

            $fromAddressId = $fromAddress["address_id"];

            $toAddress = AddressModel::findToAddress($toAddressId, $userId);
            if (!$toAddress) {
                Response::json(['message' => 'Không tìm thấy địa chỉ người mua'], 400);
            }

            // Kiểm tra phí vận chuyển
            $shippingPrice = 0;
            $shippingFee = ShippingFeeModel::find($shippingFeeId);
            if (!$shippingFee) {
                Response::json(['message' => 'Không tìm thấy thông tin vận chuyển'], 400);
            }
            $shippingPrice = floatval($shippingFee["price"]);

            // Kiểm tra sản phẩm
            $carts = CartModel::getQuantityAndPrice($userId, $seller["seller_id"]);
            if (!$carts) {
                Response::json(['message' => 'Không tìm thấy sản phẩm trong giỏ hàng'], 400);
            }

            $subtotalPrice = 0;
            foreach ($carts as $cart) {
                if (in_array($cart["cart_id"], $cartIds)) {
                    $subtotalPrice += ($cart["promotion_price"] ? $cart["promotion_price"] : $cart["price"]) * $cart["quantity"];
                }
            }

            // Kiểm tra mã giảm giá
            $coupon = null;
            if ($couponId) {
                $coupon = CouponModel::find($couponId, $seller["seller_id"]);
                if (!$coupon) {
                    Response::json(['message' => 'Không tìm thấy thông tin giảm giá của người bán này'], 400);
                }
            }

            $discount = 0;
            // Kiểm tra xem có mã giảm giá không và giỏ hàng có đủ điều kiện
            if ($coupon && $subtotalPrice >= $coupon['minimum_order_value']) {
                if ($coupon['discount_type'] == 'percentage') {
                    // Nếu giảm giá theo tỷ lệ phần trăm
                    $discount = ($subtotalPrice * $coupon['discount_value']) / 100;

                    // Kiểm tra xem giá trị giảm giá có vượt quá giới hạn tối đa không
                    if ($coupon['maximum_discount'] && $discount > $coupon['maximum_discount']) {
                        $discount = $coupon['maximum_discount'];
                    }
                } elseif ($coupon['discount_type'] == 'fixed') {
                    // Nếu giảm giá theo giá trị cố định
                    $discount = $coupon['discount_value'];

                    // Kiểm tra xem giá trị giảm giá có vượt quá giới hạn tối đa không
                    if ($coupon['maximum_discount'] && $discount > $coupon['maximum_discount']) {
                        $discount = $coupon['maximum_discount'];
                    }
                }
            }
            $discount = floatval($discount);

            // Tính giá cuối cùng
            $finalPrice = $subtotalPrice + $shippingPrice - $discount;

            // Tính doanh thu cho người bán
            $revenue = Format::number(($finalPrice - $shippingPrice) * (1 - $_ENV["REVENUE_PROPORTION"]), 0);

            // Tạo đơn hàng
            $orderId = OrderModel::add($seller["seller_id"], $userId, $fromAddressId, $toAddressId, $shippingFeeId, $subtotalPrice, $discount, $finalPrice, $revenue, $couponId);

            if (!$orderId) {
                throw new \Exception("Lỗi tạo đơn hàng");
            }

            // Tạo chi tiết đơn hàng
            foreach ($carts as $cart) {
                if (in_array($cart["cart_id"], $cartIds)) {
                    $orderItem = OrderItemModel::add($orderId, $cart["product_variant_id"], $cart["quantity"], $cart["promotion_price"] ? $cart["promotion_price"] : $cart["price"]);
                    if (!$orderItem) {
                        throw new \Exception("Lỗi tạo chi tiết đơn hàng");
                    }
                }
            }

            // Tạo trạng thái đơn hàng
            OrderStatusModel::add($orderId, 'unpaid');

            // Xóa giỏ hàng -------------------------------------
            // CartModel::delete($userId, $cartIds);

            // Cập nhật số lượng, số lượng tồn sản phẩm ------------------------------------

            // Xử lý tạo QR code thanh toán
            $paymentLink = "aaa";
            $paymentPath = QRCode::createPayment($paymentLink);

            if (!$paymentPath) {
                throw new \Exception("Lỗi tạo QR code thanh toán");
            }

            Response::json([
                "pathQr" => $paymentPath,
                "orderId" => $orderId
            ], 200);
        } catch (\Throwable $th) {
            Log::throwable("Lỗi tạo đơn hàng: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Kiểm tra thanh toán
    public function checkPayment() {
        try {
            $user = Auth::user();
            $orderId = Request::json('order_id');

            if (!$orderId) {
                Response::json(['message' => 'Thông tin không đầy đủ'], 400);
            }

            $order = OrderModel::find($orderId, $user["user_id"]);
            if (!$order) {
                Response::json(['message' => 'Không tìm thấy thông tin đơn hàng'], 400);
            }

            $status = OrderStatusModel::findLatest($orderId, 'unpaid');
            if (!$status) {
                Response::json(['message' => 'Không tìm thấy trạng thái'], 400);
            }

            if ($status['status'] != 'unpaid') {
                Response::json(['message' => 'Đơn hàng đã được thanh toán trước đó'], 400);
            }

            // Kiểm tra ở đây, giả bộ nó đã thanh toán
            $check = true;

            if ($check) {
                OrderModel::updatePaid($orderId, $user["user_id"], rand(1, 100));
                OrderStatusModel::add($orderId, 'packing');

                Response::json(['message' => 'Xác nhận đã thanh toán thành công'], 200);
            } else {
                Response::json(['message' => 'Bạn chưa thanh toán'], 400);
            }
        } catch (\Throwable $th) {
            Log::throwable("Lỗi kiểm tra thanh toán: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Lấy danh sách đơn hàng của người dùng theo người bán
    public function getAllBySeller() {
        try {
            $seller = Auth::seller();
            $status = Request::get('status', 'all');
            $limit = Request::get('limit', 12);
            $page = Request::get('page', 1);

            // Lấy tổng số đơn hàng
            $count = OrderModel::countBySellerId($seller["seller_id"], $status);

            // Lấy danh sách đơn hàng
            $orders = OrderModel::getBySellerIdAndStatus($seller["seller_id"], $status, $limit, $page);

            if (!empty($orders)) {
                foreach ($orders as $key => $order) {
                    // Lấy thông tin người mua hàng
                    $user = UserModel::findByUserId($order['user_id']);
                    $orders[$key]["user"]["user_id"] = $user["user_id"];
                    $orders[$key]["user"]["name"] = $user["name"];
                    $orders[$key]["user"]["avatar"] = $user["avatar"];

                    // Lấy thông tin địa chỉ người bán
                    $toAddress = AddressModel::findSellerAddress($order["from_address_id"], $order["seller_id"]);
                    $orders[$key]["from_address"]["address_id"] = $toAddress["address_id"];
                    $orders[$key]["from_address"]["province_name"] = $toAddress["province_name"];
                    $orders[$key]["from_address"]["address_line"] = $toAddress["address_line"];

                    // Lấy thông tin địa chỉ người mua
                    $toAddress = AddressModel::findToAddress($order["to_address_id"], $order["user_id"]);
                    $orders[$key]["to_address"]["address_id"] = $toAddress["address_id"];
                    $orders[$key]["to_address"]["province_name"] = $toAddress["province_name"];
                    $orders[$key]["to_address"]["address_line"] = $toAddress["address_line"];

                    // Lấy thông tin vận chuyển
                    $shippingFee = ShippingFeeModel::find($order["shipping_fee_id"]);
                    $orders[$key]["shipping_fee"]["shipping_fee_id"] = $shippingFee["shipping_fee_id"];
                    $orders[$key]["shipping_fee"]["method"] = $shippingFee["method"];
                    $orders[$key]["shipping_fee"]["price"] = $shippingFee["price"];

                    // Lấy thông tin giảm giá
                    $coupon = CouponModel::find($order["coupon_id"], $order["seller_id"]);
                    $orders[$key]["coupon"] = $coupon;

                    // Lấy danh sách trạng thái
                    $orderStatus = OrderStatusModel::getByOrderId($order["order_id"]);
                    $orders[$key]["order_status"] = $orderStatus;

                    // Lấy trạng thái cuối cùng
                    $status = OrderStatusModel::findLatest($order["order_id"]);
                    $orders[$key]["latest_status"] = $status;

                    // Lấy danh sách order item
                    $orderItems = OrderItemModel::getByOrderId($order["order_id"]);
                    $orders[$key]["order_items"] = $orderItems;
                    foreach ($orders[$key]["order_items"] as $key2 => $orderItem) {
                        // Lấy thuộc tính
                        $attributes = ProductVariantValueModel::getByProductVariantId($orderItem["product_variant_id"]);
                        $orders[$key]["order_items"][$key2]["attributes"] = $attributes;

                        // Lấy thông tin 
                        $product = ProductModel::getByProductVariantId($orderItem["product_variant_id"]);
                        $orders[$key]["order_items"][$key2]["product"] = $product;

                        // Lấy hình ảnh
                        $images = ProductImageModel::getDefault($product["product_id"]);
                        $orders[$key]["order_items"][$key2]["image"] = $images;
                    }
                }
            }

            $result = [
                "count" => $count,
                "orders" => $orders
            ];

            Response::json($result, 200);
        } catch (\Throwable $th) {
            Log::throwable("Lỗi lấy danh sách đơn hàng theo người bán: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Lấy 1 đơn hàng
    public function getByOrderId($order_id) {
        try {
            $seller = Auth::seller();

            // Lấy danh sách đơn hàng
            $order = OrderModel::findByOrderId($order_id, $seller["seller_id"]);

            // Lấy thông tin người mua hàng
            $user = UserModel::findByUserId($order['user_id']);
            $order["user"]["user_id"] = $user["user_id"];
            $order["user"]["name"] = $user["name"];
            $order["user"]["avatar"] = $user["avatar"];

            // Lấy thông tin địa chỉ người bán
            $toAddress = AddressModel::findSellerAddress($order["from_address_id"], $order["seller_id"]);
            $order["from_address"]["address_id"] = $toAddress["address_id"];
            $order["from_address"]["province_name"] = $toAddress["province_name"];
            $order["from_address"]["address_line"] = $toAddress["address_line"];

            // Lấy thông tin địa chỉ người mua
            $toAddress = AddressModel::findToAddress($order["to_address_id"], $order["user_id"]);
            $order["to_address"]["address_id"] = $toAddress["address_id"];
            $order["to_address"]["province_name"] = $toAddress["province_name"];
            $order["to_address"]["address_line"] = $toAddress["address_line"];

            // Lấy thông tin vận chuyển
            $shippingFee = ShippingFeeModel::find($order["shipping_fee_id"]);
            $order["shipping_fee"]["shipping_fee_id"] = $shippingFee["shipping_fee_id"];
            $order["shipping_fee"]["method"] = $shippingFee["method"];
            $order["shipping_fee"]["price"] = $shippingFee["price"];

            // Lấy thông tin giảm giá
            $coupon = CouponModel::find($order["coupon_id"], $order["seller_id"]);
            $order["coupon"] = $coupon;

            // Lấy danh sách trạng thái
            $orderStatus = OrderStatusModel::getByOrderId($order["order_id"]);
            $order["order_status"] = $orderStatus;

            // Lấy trạng thái cuối cùng
            $status = OrderStatusModel::findLatest($order["order_id"]);
            $order["latest_status"] = $status;

            // Lấy danh sách order item
            $orderItems = OrderItemModel::getByOrderId($order["order_id"]);
            $order["order_items"] = $orderItems;
            foreach ($order["order_items"] as $key2 => $orderItem) {
                // Lấy thuộc tính
                $attributes = ProductVariantValueModel::getByProductVariantId($orderItem["product_variant_id"]);
                $order["order_items"][$key2]["attributes"] = $attributes;

                // Lấy thông tin 
                $product = ProductModel::getByProductVariantId($orderItem["product_variant_id"]);
                $order["order_items"][$key2]["product"] = $product;

                // Lấy hình ảnh
                $images = ProductImageModel::getDefault($product["product_id"]);
                $order["order_items"][$key2]["image"] = $images;
            }


            Response::json($order, 200);
        } catch (\Throwable $th) {
            Log::throwable("Lỗi lấy một đơn hàng: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Seller thêm 1 status cho đơn hàng
    public function sellerAddStatus($order_id) {
        try {
            $seller = Auth::seller();

            $order = OrderModel::findByOrderId($order_id, $seller["seller_id"]);

            if (!$order) {
                Response::json(['message' => 'Không tìm thấy đơn hàng'], 400);
            }

            $orderStatus = OrderStatusModel::findLatest($order["order_id"]);
            if (!$orderStatus) {
                throw new \Exception("Không tìm thấy trạng thái");
            }
            if ($orderStatus['status'] == 'unpaid') {
                Response::json(['message' => 'Đơn hàng chưa thanh toán'], 400);
            } else if ($orderStatus['status'] == 'packing') {
                OrderStatusModel::add($order["order_id"], 'packed');
                $orderStatus = OrderStatusModel::findLatest($order["order_id"]);
                Response::json($orderStatus, 200);
            } else {
                Response::json(['message' => 'Đơn hàng đã đóng gói trước đó'], 400);
            }
        } catch (\Throwable $th) {
            Log::throwable("Lỗi thêm status của người bán: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }
}
