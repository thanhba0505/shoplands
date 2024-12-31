<?php

require_once 'app/Models/QueryDatabase.php';

class Order extends QueryDatabase
{
    protected $table = 'orders';

    // Hàm lấy tất cả chi tiết hóa đơn theo theo id người bán
    public function getOrdersBySellerId($sellerId)
    {
        return $this->select('id')
            ->joinWithConditions(
                'order_items',
                'order_items.order_id = orders.id',
                'quantity',
                'INNER',
                // 'products.status = "active"',
                // 'products.name',
                // 'products.price DESC',
                // '10'
            )
            ->where('seller_id = ?', $sellerId)
            ->limit(10)
            ->all();
    }

    // Hàm lấy tất cả chi tiết hóa đơn 
    // public function getAllBySellerId($sellerId)
    // {
    //     $sql = "SELECT * FROM {$this->table} WHERE seller_id = :seller_id";
    //     return $this->query($sql, ['seller_id";' => $sellerId])->fetch();
    // }
}
