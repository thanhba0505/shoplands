<?php

require_once 'app/Models/Address.php';
require_once 'app/Models/Cart.php';
require_once 'app/Models/ProductVariant.php';
require_once 'app/Models/Coupon.php';
require_once 'app/Models/ShippingFee.php';

include 'library/phpqrcode/qrlib.php';


class OrderCheckoutController
{
    // Hiển thị xác nhận đơn hàng
    public function show()
    {
        $checkout = Session::get('checkout');

        $QRCode = Util::generateQRCodeBase64('abc');

        if (!$checkout) {
            Redirect::order('cart')->notification('Không tìm thấy thông tin thanh toán', 'error')->redirect();
        }

        $data = [
            'title' => 'Thanh toán đơn hàng',
            'QRCode' => $QRCode,
        ];

        Console::log($data);

        // Render view với layout
        return View::make('Customer/order-checkout', $data);
    }

    // Hàm xử lý chuyển hướng thanh toán
    public function handle()
    {
        $cartIds = Request::post('c_ids');
        $couponId = Request::post('cp_id');
        $shippingFeeId = Request::post('sf_id');
        $paymentMethod = Request::post('payment_method');

        $data = [
            'cartIds' => $cartIds,
            'couponId' => $couponId,
            'shippingFeeId' => $shippingFeeId,
            'paymentMethod' => $paymentMethod
        ];

        Session::set('checkout', $data);

        if ($paymentMethod == 'QR') {
            Redirect::order('checkout')->redirect();
        } else {
            $result = $this->saveOrder();
            if ($result['success']) {
                Redirect::order('history/pending')->redirect();
            } else {
                Redirect::back()->notification($result['message'], 'error')->redirect();
            }
        }
    }

    // Hàm lưu đơn hàng
    private function saveOrder()
    {
        $result = [
            'success' => false,
            'message' => 'Có lỗi xảy ra, vui lòng thử lại sau'
        ];

        // $cartModel = new Cart();
        // $shippingFeeModel = new ShippingFee();
        // $addressModel = new Address();


        return $result;
    }


    // Api kiểm tra đã thanh toán chưa
    public function checkPayment()
    {
        // kiẻmt ra
    }
}
