<?php

class OrderController
{
    public function show($page = 'all')
    {
        $data = [
            'title' => 'Seller Page',
            'title_header' => 'Kênh người bán',
            'page' => $page
        ];

        if ($page == 'all') {

            $to_do_list = [
                'pending' => '3',
                'packing' => '2',
                'packed' => '5',
                'shipping' => '2',
                'dilivered' => '7',
                'completed' => '2',
                'returned' => '7',
                'cancelled' => '4',
            ];

            $data = array_merge($data, $to_do_list);

            View::make('Seller/Order/all', $data, 'layout/layout-header-simple-fullwidth');
            return;
        }

        View::make('Seller/Order/all', $data, 'layout/layout-header-simple-fullwidth');
    }
}
