<?php

require_once 'app/Models/Address.php';


class OrderController
{
    public function showHistory()
    {
        $data = [
            'title' => 'Lịch sử đơn hàng',
        ];

        // Render view với layout
        return View::make('Customer/order-history', $data);
    }

    // Hiển thị xác nhận đơn hàng
    public function showConfirm()
    {
        $cartId = Request::get('c_ids');

        if (empty($cartId)) {
            Redirect::cart()->notification('Chưa chọn sản phẩm nào', 'error')->redirect();
        }

        $user = Auth::getUser();

        $addressModel = new Address();
        $addresses = $addressModel->getAddressByUserId($user['id']);
        

        $data = [
            'title' => 'Xác nhận đặt hàng',
            'addresses' => $addresses
        ];

        // Render view với layout
        return View::make('Customer/order-confirm', $data);
    }
}
