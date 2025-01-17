<?php

require_once 'app/Ajax/TabAjax.php';

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

    public function testAjax()
    {
    //    new TabAjax();
        // echo "testAjax";

        header('Content-Type: application/json');

        $tab = 'tab1';

        $tabs = [
            'tab1' => '<p>This is the content of Tab 1.</p>',
            'tab2' => '<p>This is the content of Tab 2.</p>',
            'tab3' => '<p>This is the content of Tab 3.</p>'
        ];

        echo json_encode('ấdfasdf');

        // echo json_encode($data);
    }
}
