<?php

class SellerRegisterController
{
    public function show()
    {
        $data = [
            'title' => 'Seller Register Page',
            'title_header' => 'Đăng ký bán hàng cùng Shopee',
        ];

        return View::make('Seller/seller-register', $data);
    }
}
