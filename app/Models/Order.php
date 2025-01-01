<?php

require_once 'app/Models/QueryCustom.php';

class Order
{
    protected $table = 'orders';

    public function getOrdersBySellerId($sellerId)
    {
        $query = new QueryCustom();

        $result = $query
            ->select(['orders.id', 'subtotal_price', 'payment_method'])
            ->from('orders')
            ->join('order_items', 'orders.id = order_items.order_id')
            ->where('seller_id = :sellerId', ['sellerId' => $sellerId])
            ->limit(10)
            ->all();

        return $result;
    }
}
