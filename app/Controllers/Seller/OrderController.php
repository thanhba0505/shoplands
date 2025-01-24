<?php

require_once 'app/Models/Seller.php';
require_once 'app/Models/Order.php';

class OrderController
{
    public function show()
    {
        $user = Auth::getUser();
        $sellerModel = new Seller();
        $seller = $sellerModel->findByUserId($user['id']);


        $orderModel = new Order();
        $result = $orderModel->getListOrderQuantity($seller['id']);

        $data = [
            'title' => 'Quản lý đơn hàng',
            'listOrderStatus' => Other::listOrderStatus(),
            'listOrderQuantity' => $result
        ];

        return View::make('Seller/Order/index', $data, sidebar: 'seller');
    }

    public function showDetail()
    {

        $data = [
            'title' => 'Chi tiết đơn hàng'
        ];

        return View::make('Seller/Order/detail', $data, sidebar: 'seller');;
    }

    public function apiHandleTab()
    {
        $listOrderStatus = Other::listOrderStatus();

        $page = Request::post('page');

        if (!array_key_exists($page, $listOrderStatus)) {
            return Api::encode('Trang khônng tốn tại', 404);
        }

        $user = Auth::getUser();
        $sellerModel = new Seller();
        $seller = $sellerModel->findByUserId($user['id']);

        $order = new Order();
        $sqlResults = $order->getOrdersBySellerId($seller['id'], $page == 'order-all' ? null : $page);

        $orders = [];

        // Xây dựng mảng `$orders`
        foreach ($sqlResults as $row) {
            $orderId = $row['order_id'];
            $productVariantId = $row['product_variant_id']; // Sử dụng để nhóm sản phẩm

            // Nếu chưa tồn tại đơn hàng, khởi tạo
            if (!isset($orders[$orderId])) {
                $orders[$orderId] = [
                    'order_id' => $row['order_id'],
                    'user_name' => $row['user_name'],
                    'revenue' => $row['order_revenue'],
                    'shipping_method' => $row['shipping_method'],
                    'order_created_at' => $row['order_created_at'],
                    'order_date' => $row['order_date'],
                    'latest_status_date' => $row['latest_status_date'],
                    'order_status' => $row['latest_status'],
                    'products' => [],
                ];
            }

            // Kiểm tra nếu sản phẩm đã tồn tại trong danh sách products
            if (!isset($orders[$orderId]['products'][$productVariantId])) {
                $orders[$orderId]['products'][$productVariantId] = [
                    'product_image' => $row['product_image'],
                    'product_name' => $row['product_name'],
                    'order_quantity' => $row['order_quantity'],
                    'attributes' => [], // Nhóm các thuộc tính ở đây
                ];
            }

            // Thêm thuộc tính vào mảng attributes
            $orders[$orderId]['products'][$productVariantId]['attributes'][] = [
                'attribute_name' => $row['product_attribute'],
                'attribute_value' => $row['product_attribute_value'],
            ];
        }

        $data = ['orders' => $orders, 'listOrderStatus' => $listOrderStatus];

        return Api::view('Seller/Order/tab-order', $data);
    }
}
