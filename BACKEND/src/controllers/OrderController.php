<?php

namespace App\Controllers;

use App\Helpers\Auth;
use App\Helpers\Format;
use App\Helpers\Log;
use App\Helpers\QRCode;
use App\Helpers\Redirect;
use App\Helpers\Request;
use App\Helpers\Response;
use App\Helpers\VNpay;
use App\Models\AccountModel;
use App\Models\AddressModel;
use App\Models\CartModel;
use App\Models\CouponModel;
use App\Models\OrderItemModel;
use App\Models\OrderModel;
use App\Models\OrderPaymentModel;
use App\Models\OrderStatusModel;
use App\Models\ProductImageModel;
use App\Models\ProductModel;
use App\Models\ProductVariantModel;
use App\Models\ProductVariantValueModel;
use App\Models\SellerModel;
use App\Models\ShippingFeeModel;
use App\Models\UserModel;

class OrderController {
    // Lấy danh sách đơn hàng của người dùng
    public function userGet() {
        try {
            $user = Auth::user();
            $status = Request::get('status', 'all');
            $limit = Request::get('limit', 12);
            $page = Request::get('page', 1);

            $count = OrderModel::countByUserId($user["user_id"], $status);

            $orders = OrderModel::getByUserId($user["user_id"], $status, $limit, $page);

            if (!empty($orders)) {
                // Duyệt qua từng đơn hàng và thêm thông tin vào
                foreach ($orders as $key => $order) {
                    $orders[$key] = array_merge(
                        $order,
                        $this->getOrderDetails($order)  // Lấy thông tin chi tiết cho từng đơn hàng
                    );
                }
            }

            $result = [
                "count" => $count,
                "orders" => $orders
            ];

            Response::json($result, 200);
        } catch (\Throwable $th) {
            Log::throwable("OrderController -> userGet: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Lấy 1 đơn hàng 
    public function userFind($order_id) {
        try {
            $user = Auth::user();

            // Lấy danh sách đơn hàng
            $order = OrderModel::findByOrderIdAndUserId($order_id, $user["user_id"]);

            if (!$order) {
                Response::json(['message' => 'Không tìm thấy đơn hàng'], 400);
            }

            $order = array_merge($order, $this->getOrderDetails($order));

            Response::json($order, 200);
        } catch (\Throwable $th) {
            Log::throwable("OrderController -> userFind: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Tạo đơn hàng
    public function userAdd() {
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

                    if ($cart["quantity"] > $product_variant["quantity"]) {
                        Response::json(['message' => 'Số lượng sản phẩm không đủ'], 400);
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

            // Kiểm tra phí vận chuyển
            $shippingPrice = 0;
            $shippingFee = ShippingFeeModel::find($shippingFeeId);
            if (!$shippingFee) {
                Response::json(['message' => 'Không tìm thấy thông tin vận chuyển'], 400);
            }
            $shippingPrice = floatval($shippingFee["price"]);

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
                    OrderItemModel::add($orderId, $cart["product_variant_id"], $cart["quantity"], $cart["promotion_price"] ? $cart["promotion_price"] : $cart["price"]);
                    $product_variant = ProductVariantModel::find($cart["product_variant_id"]);
                    // Cập nhật số lượng
                    ProductVariantModel::updateQuantity(
                        $product_variant["product_variant_id"],
                        $product_variant["quantity"] - $cart["quantity"],
                        $product_variant["sold_quantity"] + $cart["quantity"]
                    );

                    // Xóa giỏ hàng
                    // CartModel::delete($userId, $cart["cart_id"]);
                }
            }

            // Tạo trạng thái đơn hàng
            OrderStatusModel::add($orderId, 'unpaid');

            // Thanh toán
            $result = VNpay::createPaymentUrl($finalPrice);

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

            // Kiểm tra
            $result = VNpay::handleReturn();

            if ($result['code'] == '00') {
                OrderModel::updatePaid($order["order_id"], true);
            }

            OrderPaymentModel::insertOrUpdate($vnp_TxnRef, $result['code'], $result['message'], json_encode($result['json']));

            // Redirect::to("/user/orders/" . $order["order_id"]);
            Response::json($result, 200);
        } catch (\Throwable $th) {
            Log::throwable("OrderController -> userCheckPayment: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Lấy danh sách đơn hàng của người dùng theo người bán
    public function sellerGet() {
        try {
            $seller = Auth::seller();
            $status = Request::get('status', 'all');
            $limit = Request::get('limit', 12);
            $page = Request::get('page', 1);

            // Lấy tổng số đơn hàng
            $count = OrderModel::countBySellerId($seller["seller_id"], $status);

            // Lấy danh sách đơn hàng
            $orders = OrderModel::getBySellerId($seller["seller_id"], $status, $limit, $page);

            if (!empty($orders)) {
                // Duyệt qua từng đơn hàng và thêm thông tin vào
                foreach ($orders as $key => $order) {
                    $orders[$key] = array_merge(
                        $order,
                        $this->getOrderDetails($order)  // Lấy thông tin chi tiết cho từng đơn hàng
                    );
                }
            }

            $result = [
                "count" => $count,
                "orders" => $orders
            ];

            Response::json($result, 200);
        } catch (\Throwable $th) {
            Log::throwable("OrderController -> sellerGet: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Phương thức giúp lấy các thông tin chi tiết cho một đơn hàng
    private function getOrderDetails($order) {
        // Lấy thông tin người mua hàng
        $orderDetails = [
            "user" => $this->getUserDetails($order['user_id']),
            "seller" => $this->getSellerDetails($order['seller_id']),
            "from_address" => $this->getAddressDetails($order["from_address_id"], $order["seller_id"], 'seller'),
            "to_address" => $this->getAddressDetails($order["to_address_id"], $order["user_id"], 'user'),
            "shipping_fee" => $this->getShippingFeeDetails($order["shipping_fee_id"]),
            "coupon" => CouponModel::find($order["coupon_id"], $order["seller_id"]),
            "order_status" => OrderStatusModel::getByOrderId($order["order_id"]),
            "latest_status" => OrderStatusModel::findLatest($order["order_id"]),
            "order_items" => $this->getOrderItems($order["order_id"])
        ];

        return $orderDetails;
    }

    // Lấy thông tin người mua
    private function getUserDetails($user_id) {
        $user = UserModel::findByUserId($user_id);
        return [
            "user_id" => $user["user_id"],
            "name" => $user["name"],
            "avatar" => $user["avatar"]
        ];
    }

    // Lấy thông tin người bán
    private function getSellerDetails($seller_id) {
        $seller = SellerModel::findBySellerId($seller_id);
        return [
            "seller_id" => $seller["seller_id"],
            "store_name" => $seller["store_name"],
            "logo" => $seller["logo"]
        ];
    }

    // Lấy thông tin địa chỉ
    private function getAddressDetails($address_id, $user_id, $type = 'user') {
        if ($type == 'seller') {
            $address = AddressModel::findSellerAddress($address_id, $user_id);
        } else {
            $address = AddressModel::findToAddress($address_id, $user_id);
        }

        return [
            "address_id" => $address["address_id"],
            "province_name" => $address["province_name"],
            "address_line" => $address["address_line"]
        ];
    }

    // Lấy thông tin vận chuyển
    private function getShippingFeeDetails($shipping_fee_id) {
        $shippingFee = ShippingFeeModel::find($shipping_fee_id);
        return [
            "shipping_fee_id" => $shippingFee["shipping_fee_id"],
            "method" => $shippingFee["method"],
            "price" => $shippingFee["price"]
        ];
    }

    // Lấy thông tin order items
    private function getOrderItems($order_id) {
        $orderItems = OrderItemModel::getByOrderId($order_id);
        foreach ($orderItems as $key => $orderItem) {
            $orderItems[$key]["attributes"] = ProductVariantValueModel::getByProductVariantId($orderItem["product_variant_id"]);
            $product = ProductModel::getByProductVariantId($orderItem["product_variant_id"]);
            $orderItems[$key]["product"] = $product;
            $images = ProductImageModel::getDefault($product["product_id"]);
            $orderItems[$key]["image"] = $images;
        }
        return $orderItems;
    }

    // Lấy 1 đơn hàng
    public function sellerFind($order_id) {
        try {
            $seller = Auth::seller();

            // Lấy danh sách đơn hàng
            $order = OrderModel::findByOrderIdAndSellerId($order_id, $seller["seller_id"]);

            if (!$order) {
                Response::json(['message' => 'Không tìm thấy đơn hàng'], 400);
            }

            $order = array_merge($order, $this->getOrderDetails($order));

            Response::json($order, 200);
        } catch (\Throwable $th) {
            Log::throwable("OrderController -> sellerFind: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Seller thêm 1 status cho đơn hàng
    public function sellerAddStatus($order_id) {
        try {
            $seller = Auth::seller();

            $order = OrderModel::findByOrderIdAndSellerId($order_id, $seller["seller_id"]);

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
            Log::throwable("OrderController -> sellerAddStatus: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // User thêm 1 status cho đơn hàng
    public function userAddStatus($order_id) {
        try {
            $user = Auth::user();
            $status = Request::json('status');
            $check = in_array($status, [
                'completed',
            ]);

            if (!$status) {
                Response::json(['message' => 'Không tìm thấy trạng thái'], 400);
            }

            if (!$check) {
                Response::json(['message' => 'Trạng thái không thể truy cập'], 400);
            }

            $orderStatus = OrderStatusModel::findLatest($order_id);
            if (!$orderStatus) {
                throw new \Exception("Không tìm thấy trạng thái");
            }

            if ($status === 'completed' && $orderStatus['status'] === 'delivered') {
                OrderStatusModel::add($order_id, 'completed');
                $orderStatus = OrderStatusModel::findLatest($order_id);

                // Xử lý cộng coin cho người bán và shipper
                $order = OrderModel::find($order_id, $user["user_id"]);
                $seller = SellerModel::findBySellerId($order["seller_id"]);

                AccountModel::updateCoin($seller["account_id"], $seller["coin"] + $order["revenue"]);

                $shipper = AccountModel::getShipper();
                $shipping_fee = ShippingFeeModel::find($order["shipping_fee_id"]);
                AccountModel::updateCoin($shipper["account_id"], $shipper["coin"] + $shipping_fee["price"]);

                Response::json($orderStatus, 200);
            } else {
                Response::json(['message' => 'Không thể cập nhật nhật trạng thái này cho đơn hàng'], 400);
            }
        } catch (\Throwable $th) {
            Log::throwable("OrderController -> shipperAddStatus: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Shipper lấy danh sách đơn hàng đang giao
    public function shipperGet() {
        try {
            $status = Request::get('status');
            $limit = Request::get('limit', 12);
            $page = Request::get('page', 1);

            $check = in_array($status, [
                'packed',
                'shipping'
            ]);

            if (!$check) {
                Response::json(['message' => 'Trạng thái không hợp lệ'], 400);
            }

            // Lấy tổng số đơn hàng
            $count = OrderModel::count($status);

            // Lấy danh sách đơn hàng
            $orders = OrderModel::shipperGet($status, $limit, $page);

            if (!empty($orders)) {
                // Duyệt qua từng đơn hàng và thêm thông tin vào
                foreach ($orders as $key => $order) {
                    $orderDetails = $this->getOrderDetailsByShipper($order);
                    $orders[$key] = array_merge(
                        $order,
                        $orderDetails  // Lấy thông tin chi tiết cho từng đơn hàng
                    );
                }
            }

            $result = [
                "count" => $count,
                "orders" => $orders
            ];

            Response::json($result, 200);
        } catch (\Throwable $th) {
            Log::throwable("OrderController -> shipperGet: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Shipper thêm 1 status cho đơn hàng
    public function shipperAddStatus($order_id) {
        try {
            $status = Request::json('status');
            $check = in_array($status, [
                'shipping',
                'delivered'
            ]);

            if (!$status) {
                Response::json(['message' => 'Không tìm thấy trạng thái'], 400);
            }

            if (!$check) {
                Response::json(['message' => 'Trạng thái không thể truy cập'], 400);
            }

            $orderStatus = OrderStatusModel::findLatest($order_id);
            if (!$orderStatus) {
                throw new \Exception("Không tìm thấy trạng thái");
            }

            if ($status === 'shipping' && $orderStatus['status'] === 'packed') {
                OrderStatusModel::add($order_id, 'shipping');
                $orderStatus = OrderStatusModel::findLatest($order_id);
                Response::json($orderStatus, 200);
            } else if ($status === 'delivered' && $orderStatus['status'] === 'shipping') {
                OrderStatusModel::add($order_id, 'delivered');
                $orderStatus = OrderStatusModel::findLatest($order_id);
                Response::json($orderStatus, 200);
            } else {
                Response::json(['message' => 'Không thể cập nhật nhật trạng thái này cho đơn hàng'], 400);
            }
        } catch (\Throwable $th) {
            Log::throwable("OrderController -> shipperAddStatus: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Phương thức giúp lấy các thông tin chi tiết cho một đơn hàng cho shipper
    private function getOrderDetailsByShipper($order) {
        // Lấy thông tin người mua hàng
        $orderDetails = [
            "user" => $this->getUserDetails($order['user_id']),
            "seller" => $this->getSellerDetails($order['seller_id']),
            "from_address" => $this->getAddressDetails($order["from_address_id"], $order["seller_id"], 'seller'),
            "to_address" => $this->getAddressDetails($order["to_address_id"], $order["user_id"], 'user'),
            "shipping_fee" => $this->getShippingFeeDetails($order["shipping_fee_id"]),
            "latest_status" => OrderStatusModel::findLatest($order["order_id"]),
            "order_items" => $this->getOrderItems($order["order_id"])
        ];

        return $orderDetails;
    }
}
