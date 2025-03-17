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
use App\Models\SellerModel;
use App\Models\ShippingFeeModel;

class OrderController {
    // Tạo đơn hàng
    public function add() {
        try {
            $user = Auth::user();

            $userId = $user["user_id"];
            $sellerId = Request::json("seller_id");
            $fromAddressId = Request::json("from_address_id");
            $toAddressId = Request::json("to_address_id");
            $shippingFeeId = Request::json("shipping_fee_id");
            $couponId = Request::json("coupon_id");
            $cartIds = Request::json("cart_ids");

            if (empty($sellerId) || empty($fromAddressId) || empty($toAddressId) || empty($shippingFeeId) || empty($cartIds)) {
                Response::json(['message' => 'Thông tin không đủ'], 400);
            }

            // Kiểm tra seller
            $seller = SellerModel::findBySellerId($sellerId);
            if (!$seller) {
                Response::json(['message' => 'Không tìm thấy thông tin người bán'], 400);
            }

            // Kiểm tra địa chỉ
            $fromAddress = AddressModel::findFromAddress($fromAddressId, $sellerId);
            if (!$fromAddress) {
                Response::json(['message' => 'Không tìm thấy địa chỉ người bán'], 400);
            }

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
            $carts = CartModel::getQuantityAndPrice($userId, $sellerId);
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
                $coupon = CouponModel::find($couponId, $sellerId);
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
            $orderId = OrderModel::add($sellerId, $userId, $fromAddressId, $toAddressId, $shippingFeeId, $subtotalPrice, $discount, $finalPrice, $revenue, $couponId);

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

            Response::json($paymentPath, 200);
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

            // Kiểm tra ở đây, giả bộ nó đã thanh toán
            $check = true;

            if ($check) {
                OrderModel::updatePaid($orderId, $user["user_id"], 100);
                OrderStatusModel::add($orderId, 'pending');

                Response::json(['message' => 'Xác nhận đã thanh toán'], 200);
            } else {
                Response::json(['message' => 'Bạn chưa thanh toán'], 200);
            }
        } catch (\Throwable $th) {
            Log::throwable("Lỗi kiểm tra thanh toán: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }
}
