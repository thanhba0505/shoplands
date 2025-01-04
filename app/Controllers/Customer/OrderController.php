<?php

class OrderController
{
    public function show()
    {
        $data = [
            'title' => 'Lịch sử đơn hàng',
        ];

        // Render view với layout
        View::make('Customer/orders', $data, 'layout/layout-primary');
    }
}
