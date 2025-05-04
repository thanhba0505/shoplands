<?php

namespace App\Controllers;

use App\Helpers\Auth;
use App\Helpers\Carbon;
use App\Helpers\Format;
use App\Helpers\GHN;
use App\Helpers\Log;
use App\Helpers\Other;
use App\Helpers\Redirect;
use App\Helpers\Request;
use App\Helpers\Response;
use App\Helpers\VNPAY;
use App\Models\AccountModel;
use App\Models\AddressModel;
use App\Models\CartModel;
use App\Models\CouponModel;
use App\Models\OrderItemModel;
use App\Models\OrderModel;
use App\Models\OrderPaymentModel;
use App\Models\ProductVariantModel;
use App\Models\SellerModel;
use App\Models\UserModel;

class OrderController {
    // Lấy danh sách đơn hàng của người dùng theo người bán
    public function sellerGet() {
        try {
            $seller = Auth::seller();
            $status = Request::get('status') && Request::get('status') != "all" ? Request::get('status') : [];
            $limit = Request::get('limit', 12);
            $page = Request::get('page', 0);

            $status = Other::groupStatus($status);

            $result = OrderModel::getBySellerId($seller["seller_id"], $status, $limit, $page);

            Response::json($result, 200);
        } catch (\Throwable $th) {
            Log::throwable("OrderController -> sellerGet: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Lấy 1 đơn hàng theo người bán
    public function sellerFind($order_id) {
        try {
            // $seller = Auth::seller();

            // // Lấy danh sách đơn hàng
            // $order = OrderModel::findByOrderIdAndUserId($order_id, $seller["seller_id"]);

            // if (!$order) {
            //     Response::json(['message' => 'Không tìm thấy đơn hàng'], 400);
            // }

            // $order = array_merge($order, $this->getOrderDetails($order));

            // Response::json($order, 200);
        } catch (\Throwable $th) {
            Log::throwable("OrderController -> sellerFind: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    //  Lấy danh sách đơn hàng của người dùng
    public function userGet() {
        try {
            $user = Auth::user();
            $status = Request::get('status') && Request::get('status') != "all" ? Request::get('status') : [];
            $limit = Request::get('limit', 12);
            $page = Request::get('page', 0);

            $status = Other::groupStatus($status);

            $result = OrderModel::getByUserId($user["user_id"], $status, $limit, $page);

            Response::json($result, 200);
        } catch (\Throwable $th) {
            Log::throwable("OrderController -> userGet: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Lấy 1 đơn hàng theo người dùng
    public function userFind($order_id) {
        try {
            $user = Auth::user();

            // Lấy danh sách đơn hàng
            $order = OrderModel::findByUserIdAndOrderId($user["user_id"], $order_id);

            if (!$order) {
                Response::json(['message' => 'Không tìm thấy đơn hàng'], 400);
            }

            Response::json($order, 200);
        } catch (\Throwable $th) {
            Log::throwable("OrderController -> userFind: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Xóa đơn hàng chưa thanh toán
    public function userDelete($order_id) {
        try {
            $user = Auth::user();

            $order = OrderModel::findByOrderIdAndUserId($order_id, $user["user_id"]);

            if (!$order) {
                Response::json(['message' => 'Không tìm thấy đơn hàng'], 400);
            }

            if ($order["current_status"] != "unpaid") {
                Response::json(['message' => 'Chỉ có thể xóa đơn hàng chưa thanh toán'], 400);
            }

            OrderModel::delete($order_id);

            $order_items = OrderItemModel::getByOrderId($order_id);

            foreach ($order_items as $order_item) {
                OrderItemModel::delete($order_item["order_item_id"]);
                ProductVariantModel::updateQuantityWhenDeleteOrder(
                    $order_item["product_variant_id"],
                    $order_item["quantity"]
                );
            }

            Response::json(['message' => 'Xóa đơn hàng thành công'], 200);
        } catch (\Throwable $th) {
            Log::throwable("OrderController -> userUpdate: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Xác nhận hoàn thành đơn hàng
    public function userComplete($order_id) {
        try {
            $user = Auth::user();

            // Lấy thông tin đơn hàng
            $order = OrderModel::findByOrderIdAndUserId($order_id, $user["user_id"]);

            if (!$order) {
                Response::json(['message' => 'Không tìm thấy đơn hàng'], 400);
            }

            if ($order["current_status"] == "completed") {
                Response::json(['message' => 'Đơn hàng đã hoàn thành'], 400);
            }

            if ($order["current_status"] != "delivered") {
                Response::json(['message' => 'Đơn hàng chưa được giao cho khách hàng'], 400);
            }

            // Cập nhật trang thai
            OrderModel::updateStatus($order_id, "completed");

            // Cộng tiền cho seller
            AccountModel::sellerIncreaseCoin($order["seller_id"], $order["revenue"]);

            Response::json(['message' => 'Đã hoàn tất đơn hàng'], 200);
        } catch (\Throwable $th) {
            Log::throwable("OrderController -> userComplete: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Tạo đơn hàng
    public function userAdd() {
        try {
            $user = Auth::user();

            $userId = $user["user_id"];
            $toAddressId = Request::json("address_id");
            $couponId = Request::json("coupon_id");
            $cartIds = Request::json("cart_ids");

            if (empty($toAddressId) || empty($cartIds)) {
                Response::json(['message' => 'Thông tin tạo đơn hàng không đủ'], 400);
            }

            // Kiểm tra sản phẩm
            $carts = CartModel::getQuantityAndPrice($userId);
            if (!$carts) {
                Response::json(['message' => 'Không tìm thấy sản phẩm trong giỏ hàng'], 400);
            }

            $subtotalPrice = 0;
            foreach ($carts as $cart) {
                if (in_array($cart["cart_id"], $cartIds)) {
                    $product_variant = ProductVariantModel::find($cart["product_variant_id"]);

                    if (!$product_variant) {
                        Response::json(['message' => 'Không tìm thấy sản phẩm trong giỏ hàng'], 400);
                    }

                    if ($product_variant['status'] != "active") {
                        Response::json(['message' => "Sản phẩm '" . $product_variant["name"] . "' không hoạt động"], 400);
                    }

                    if ($cart["quantity"] > $product_variant["quantity"]) {
                        Response::json(['message' => "Số lượng sản phẩm '" . $product_variant["name"] . "' không đủ"], 400);
                    }

                    $subtotalPrice += ($cart["promotion_price"] ? $cart["promotion_price"] : $cart["price"]) * $cart["quantity"];
                }
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

            // Giả sử tạo đơn hàng
            $fromAddress["name"] = $seller["store_name"] . " - " . $seller["owner_name"];
            $fromAddress["phone"] = $seller["phone"];

            $toAddress["name"] = $user["name"];
            $toAddress["phone"] = $user["phone"];

            $ghnPreview = GHN::previewOrder($fromAddress, $toAddress);

            if (!$ghnPreview || $ghnPreview["code"] != "200") {
                Response::json(['message' => $ghnPreview["message"]], 400);
            }

            // Tính phí vận chuyển
            $fee = GHN::calculateFee($fromAddress, $toAddress);
            if (!$fee || $fee["code"] != "200") {
                Response::json(['message' => 'Không tìm thấy thông tin vận chuyển'], 400);
            }

            $shippingPrice = $fee["data"]["total"];

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
            $revenue = Format::number(
                ($subtotalPrice - $discount) * (1 - $_ENV["REVENUE_PROPORTION"]) + $shippingPrice,
                0
            );

            // Tạo đơn hàng
            $orderId = OrderModel::add($seller["seller_id"], $userId, $fromAddressId, $toAddressId, $shippingPrice, $subtotalPrice, $discount, $finalPrice, $revenue, $couponId);

            if (!$orderId) {
                throw new \Exception("Lỗi tạo đơn hàng");
            }

            // Tạo chi tiết đơn hàng
            foreach ($carts as $cart) {
                if (in_array($cart["cart_id"], $cartIds)) {
                    OrderItemModel::add($orderId, $cart["product_variant_id"], $cart["quantity"], $cart["promotion_price"] ? $cart["promotion_price"] : $cart["price"]);
                    $product_variant = ProductVariantModel::find($cart["product_variant_id"]);
                    // Cập nhật số lượng
                    ProductVariantModel::updateQuantity(
                        $product_variant["product_variant_id"],
                        $product_variant["quantity"] - $cart["quantity"],
                        $product_variant["sold_quantity"] + $cart["quantity"]
                    );

                    // Xóa giỏ hàng
                    CartModel::delete($userId, $cart["cart_id"]);
                }
            }

            // Thanh toán
            $result = VNPAY::createPaymentUrl($finalPrice);

            // Lưu vnp_TxnRef và vnp_url
            OrderModel::updateVnpTxnRef($orderId, $result["vnp_txnref"], $result["vnp_url"]);

            Response::json([
                "url" => $result["vnp_url"],
                "orderId" => $orderId
            ], 200);
        } catch (\Throwable $th) {
            Log::throwable("OrderController -> userAdd: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Làm mới link thanh toán
    public function userGetPaymentLink() {
        try {
            $order_id = Request::json('order_id');

            $order = OrderModel::find($order_id);

            if (!$order) {
                Response::json(['message' => 'Không tìm thấy thông tin đơn hàng'], 400);
            }

            if ($order["paid"]) {
                Response::json(['message' => 'Đơn hàng đã thanh toán'], 400);
            }

            $date = Carbon::now();
            $minute = Carbon::diffInMinutes($order["vnp_created_at"], $date);

            if ($minute >= 14) {
                $result = VNPAY::createPaymentUrl($order['final_price']);
                OrderPaymentModel::delete($order['vnp_txnref']);
                OrderModel::updateVnpTxnRef($order['order_id'], $result["vnp_txnref"], $result["vnp_url"]);
                $url = $result["vnp_url"];
            } else {
                $url = $order["vnp_url"];
            }

            Response::json(['url' => $url], 200);
        } catch (\Throwable $th) {
            Log::throwable("OrderController -> userGFetPaymentLink: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Kiểm tra thanh toán
    public function userCheckPayment() {
        try {
            $vnp_TxnRef = Request::get('vnp_TxnRef');

            if (!$vnp_TxnRef) {
                Response::json(['message' => 'Không tìm thấy thông tin thanh toán'], 400);
            }

            $order = OrderModel::findByVnpTxnRef($vnp_TxnRef);

            if (!$order) {
                Response::json(['message' => 'Không tìm thấy thông tin đơn hàng'], 400);
            }

            $url = $_ENV["FRONTEND_URL"] . "/user/orders/detail/" . $order["order_id"];
            $success = "1";
            $message = "";

            if ($order["paid"]) {
                $success = "0";
                $message = "Đơn hàng đã thanh toán";
                Redirect::to($url . "?success=" . $success . "&message=" . $message);
                // Response::json([
                // 'success' => $success,
                // 'message' => $message,
                // 'url' => $url . "?success=" . $success . "&message=" . $message,
                // 'get' => $_GET
                // ], 400);
            }

            // Kiểm tra
            $result = VNPAY::handleReturn();

            if ($result['code'] == '00') {
                OrderModel::updatePaid($order["order_id"], true);
            } else {
                $success = "0";
                $message = "Thanh toán không thành công";
                Redirect::to($url . "?success=" . $success . "&message=" . $message);
                // Response::json([
                // 'success' => $success,
                // 'message' => $message,
                // 'url' => $url . "?success=" . $success . "&message=" . $message,
                // 'get' => $_GET
                // ], 400);
            }

            OrderPaymentModel::insertOrUpdate($vnp_TxnRef, $result['code'], $result['message'], json_encode($result['json']));
            
            $fromAddress = AddressModel::findFromAddress($order["from_address_id"]);
            $toAddress = AddressModel::findToAddress($order["to_address_id"], $order["user_id"]);

            $user = UserModel::findByUserId($order["user_id"]);
            $seller = SellerModel::findBySellerId($order["seller_id"]);

            $fromAddress["name"] = $seller["store_name"] . " - " . $seller["owner_name"];
            $fromAddress["phone"] = $seller["phone"];

            $toAddress["name"] = $user["name"];
            $toAddress["phone"] = $user["phone"];
            
            $ghnOrder = GHN::createOrder(
                $fromAddress,
                $toAddress
            );

            if ($ghnOrder['code'] == '200') {
                OrderModel::updateGhnOrderCode($order["order_id"], $ghnOrder['data']['order_code']);
                OrderModel::updateStatus($order["order_id"], "ready_to_pick");
            }

            $success = $ghnOrder['code'] == '200' ? "1" : "0";
            $message = $ghnOrder['code'] == '200' ? "Thanh toán đơn hàng thành công" : $ghnOrder['message'];

            Redirect::to($url . "?success=" . $success . "&message=" . $message);
            // Response::json([
            // 'success' => $success,
            // 'message' => $message,
            // 'url' => $url . "?success=" . $success . "&message=" . $message,
            // 'get' => $_GET
            // ], 400);
        } catch (\Throwable $th) {
            Log::throwable("OrderController -> userCheckPayment: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Lấy phí vận chuyển
    public function userGetShippingFee($address_id, $seller_id) {
        try {
            $user = Auth::user();
            $seller = SellerModel::findBySellerId($seller_id);

            if (!$seller) {
                Response::json(['message' => 'Không tìm thấy người bán'], 400);
            }

            $fromAddress = AddressModel::findFromAddress($seller["seller_id"]);
            if (!$fromAddress) {
                Response::json(['message' => 'Không tìm thấy địa chỉ người bán'], 400);
            }

            $toAddress = AddressModel::findToAddress($address_id, $user["user_id"]);
            if (!$toAddress) {
                Response::json(['message' => 'Không tìm thấy địa chỉ người mua'], 400);
            }
            // Giả sử tạo đơn hàng
            $fromAddress["name"] = $seller["store_name"] . " - " . $seller["owner_name"];
            $fromAddress["phone"] = $seller["phone"];

            $toAddress["name"] = $user["name"];
            $toAddress["phone"] = $user["phone"];

            $ghnPreview = GHN::previewOrder($fromAddress, $toAddress);

            if (!$ghnPreview || $ghnPreview["code"] != "200") {
                Response::json(['message' => $ghnPreview["message"]], 400);
            }

            // Tính phí vận chuyển
            $fee = GHN::calculateFee($fromAddress, $toAddress);
            if (!$fee || $fee["code"] != "200") {
                Response::json(['message' => 'Không tìm thấy thông tin vận chuyển'], 400);
            }

            // Tính thời gian dự kiến
            $leadtime = GHN::calculateLeadtime($fromAddress, $toAddress);
            if (!$leadtime || $leadtime["code"] != "200") {
                Response::json(['message' => 'Không tìm thấy thời gian dự kiến'], 400);
            }

            Response::json([
                'fee' => $fee["data"]['total'],
                'leadtime' => $leadtime["data"]['leadtime_order']
            ], 200);
        } catch (\Throwable $th) {
            Log::throwable("OrderController -> userGetShippingFee: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Cập nhật trạng thái cho tất cả đơn hàng từ ghn
    public function updateStatusOrders() {
        try {
            $ghnOrders = OrderModel::getDeliveredOrders();

            foreach ($ghnOrders as $ghnOrder) {
                $result = GHN::getOrder($ghnOrder['ghn_order_code']);

                if ($ghnOrder['current_status'] !== $result["data"]["status"]) {
                    OrderModel::updateStatus($ghnOrder['order_id'], $result["data"]["status"]);
                    Log::updateStatus(
                        "Đơn hàng #" . $ghnOrder['order_id'] . ": " .
                            $ghnOrder['current_status'] . " -> " . $result["data"]["status"]
                    );
                }
            }

            Response::json(['message' => 'Cập nhật trạng thái đơn hàng thành công'], 200);
        } catch (\Throwable $th) {
            Log::throwable("OrderController -> updateStatusOrder: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Cập nhật trạng thái cho 1 đơn hàng (dùng cho webhook của ghn)
    public function updateStatus() {
        try {
            $status = Request::json('Status') ?? Request::post('Status');
            $order_code = Request::json('OrderCode') ?? Request::post('OrderCode');

            if (!$status || !$order_code) {
                Response::json(['message' => 'Không đủ thông tin'], 400);
            }

            $order = OrderModel::findByGhnOrderCode($order_code);

            if (!$order) {
                Response::json(['message' => 'Không tìm thấy đơn hàng'], 200);
            }

            OrderModel::updateStatus($order["order_id"], $status);

            Log::updateStatus(
                "Đơn hàng #" . $order['order_id'] . ": " .
                    $order['current_status'] . " -> " . $status
            );

            Response::json(['message' => 'Cập nhật trạng thái thành công'], 200);
        } catch (\Throwable $th) {
            Log::throwable("WebhookController -> updateStatus: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }
}
