<?php

require_once 'app/Models/QueryDatabase.php';

class Order extends QueryDatabase
{
    protected $table = 'orders';

    public function getOrdersBySellerId($sellerId)
    {
        // Subquery lấy thông tin từ order_items
        $subquery = $this->from('order_items')
            ->select(['id', 'quantity', 'price', 'order_id'])  // Chọn các cột từ order_items
            ->buildQuery();

        // Truy vấn chính kết hợp với subquery
        return $this->from('orders')
            ->select(['id', 'subtotal_price', 'payment_method'])  // Chọn các cột từ orders
            ->joinWithSubquery($subquery, 'sub_order_items', 'orders.id = sub_order_items.order_id')
            ->where('seller_id = ?', $sellerId)
            ->limit(10)
            ->all();
    }
}
