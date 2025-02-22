<?php

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
        $data = [
            'title' => 'Xác nhận đặt hàng',
        ];

        // Render view với layout
        return View::make('Customer/order-confirm', $data);
    }
}
