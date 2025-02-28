<?php

require_once 'app/Models/Address.php';


class OrderHistoryController
{
    public function show($id)
    {
        $data = [
            'title' => 'Lịch sử đơn hàng',
        ];

        // Render view với layout
        return View::make('Customer/order-history', $data);
    }
}
