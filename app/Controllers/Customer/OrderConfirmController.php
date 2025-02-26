<?php

require_once 'app/Models/Address.php';
require_once 'app/Models/Cart.php';
require_once 'app/Models/ProductVariant.php';
require_once 'app/Models/Coupon.php';
require_once 'app/Models/ShippingFee.php';


class OrderConfirmController
{
    // Hiển thị xác nhận đơn hàng
    public function show()
    {
        $cartIds = Session::get('cartIds', []);

        $cartModel = new Cart();
        $shippingFeeModel = new ShippingFee();
        $addressModel = new Address();

        // Kiểm tra cart id
        if (empty($cartIds)) {
            Redirect::cart()->notification('Không thể làm mới trang đặt hàng', 'error')->redirect();
        }

        // Lấy địa chỉ
        $user = Auth::getUser();
        $userId = $user['id'];
        $userAddress = $addressModel->getAddressByUserId($userId);


        // Lấy danh sách sản phẩm
        $productVariantModel = new ProductVariant();
        $products = [];
        $subtotalPrice = 0;

        for ($i = 0; $i < count($cartIds); $i++) {
            $products[] = $cartModel->getProductVariandByCartId($cartIds[$i], $userId);
            $attributes = $productVariantModel->getVariantValueByProductVariantId($products[$i]['pv_id']);
            $products[$i]['attributes'] = $attributes;

            $subtotalPrice += floatval($products[$i]['pv_promotion_price'] ? $products[$i]['pv_promotion_price'] : $products[$i]['pv_price']) * floatval($products[$i]['c_quantity']);
        }
        $sellerId = $cartModel->getSellerIdByCartId($cartIds[0]);

        // Lấy phương thức vận chuyển
        $shippingFees = [];
        if ($userAddress) {
            $sellerAddress = $addressModel->getAddressBySellerId($sellerId);

            $shippingFees = $shippingFeeModel->getFeesBySameProvince($userAddress['p_id'] == $sellerAddress['p_id']);
        }

        // Lấy coupon
        $couponModel = new Coupon();
        $coupons = $couponModel->getCouponBySellerId($sellerId);

        $data = [
            'title' => 'Xác nhận đặt hàng',
            'address' => $userAddress,
            'products' => $products,
            'subtotalPrice' => $subtotalPrice,
            'shippingFees' => $shippingFees,
            'coupons' => $coupons
        ];

        // Render view với layout
        return View::make('Customer/order-confirm', $data);
    }

    public function handle()
    {
        $cartModel = new Cart();

        $cartIds = Request::post('c_ids');

        if (empty($cartIds)) {
            Redirect::cart()->notification('Chưa chọn sản phẩm nào', 'error')->redirect();
        }

        $sellerId = $cartModel->getSellerIdByCartId($cartIds[0]);

        foreach ($cartIds as $cartId) {
            $s_id = $cartModel->getSellerIdByCartId($cartId);

            if ($s_id != $sellerId) {
                Redirect::cart()->notification('Lỗi sản phẩm không cùng cửa hàng', 'error')->redirect();
            }
        }

        Session::set('cartIds', $cartIds);
        Redirect::order('confirm')->redirect();
    }
}
