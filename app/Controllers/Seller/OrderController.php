<?php

require_once 'app/Models/Seller.php';
require_once 'app/Models/Order.php';

class OrderController
{
    public function show($page = 'all')
    {
        if (!in_array($page, ['all', 'pending', 'packing', 'packed', 'shipping', 'dilivered', 'completed', 'returned', 'cancelled'])) {
            View::make('App/404');
            return;
        }

        $data = [
            'title' => 'Quản lý đơn hàng',
            'title_header' => 'Kênh người bán',
            'group' => 'order',
            'page' => $page
        ];

        $seller = new Seller();
        $currentSeller = $seller->getCurrentSeller();

        $order = new Order();
        $orders = $order->getOrdersBySellerId($currentSeller['id']);

        Console::log($orders);

        // if ($page == 'all') {

        //     $to_do_list = [
        //         'pending' => '3',
        //         'packing' => '2',
        //         'packed' => '5',
        //         'shipping' => '2',
        //         'dilivered' => '7',
        //         'completed' => '2',
        //         'returned' => '7',
        //         'cancelled' => '4',
        //     ];

        //     $data = array_merge($data, $to_do_list);

        //     View::make('Seller/Order/index', $data, 'layout/layout-header-simple-fullwidth');
        //     return;
        // }

        View::make('Seller/Order/index', $data, 'layout/layout-header-simple-fullwidth');
    }
}
