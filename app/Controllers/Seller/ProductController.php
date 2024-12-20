<?php

class ProductController
{
    public function show($page = 'all')
    {
        if (!in_array($page, ['all', 'in-stock', 'out-of-stock', 'locked', 'hidden', 'deleted'])) {
            http_response_code(404);
            View::make('App/404');
            return;
        }

        $data = [
            'title' => 'Seller Page',
            'title_header' => 'Kênh người bán',
            'group' => 'product',
            'page' => $page
        ];

        View::make('Seller/Product/index', $data, 'layout/layout-header-simple-fullwidth');
    }
}
