<?php

require_once 'app/Models/QueryCustom.php';

class Order
{
    public function getOrdersBySellerId($seller_id)
    {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT
                o.id AS order_id,
                o.revenue AS order_revenue,
                o.created_at AS order_created_at,
                u.id AS user_id,
                u.name AS user_name,
                pv.id AS product_variant_id,
                pi.image_path AS product_image,
                p.id AS product_id,
                p.name AS product_name,
                oi.quantity AS order_quantity,
                pav.value AS product_attribute_value,
                pa.name AS product_attribute,
                sf.shipping_method AS shipping_method,
                MAX(os.status) AS order_status
            FROM
                orders o
                JOIN users u ON u.id = o.user_id
                JOIN order_items oi ON oi.order_id = o.id
                JOIN product_variants pv ON pv.id = oi.product_variant_id
                JOIN products p ON p.id = pv.product_id
                LEFT JOIN product_variant_values pvv ON pvv.product_variant_id = pv.id
                LEFT JOIN product_attribute_values pav ON pav.id = pvv.product_attribute_value_id
                LEFT JOIN product_attributes pa ON pa.id = pav.product_attribute_id
                JOIN product_images pi ON pi.product_id = p.id
                JOIN shipping_fees sf ON sf.id = o.shipping_fee_id
                JOIN order_status os ON os.order_id = o.id
            WHERE
                o.seller_id = :seller_id
                AND pi.default = :default
            GROUP BY
                o.id,
                o.revenue,
                o.created_at,
                u.id,
                u.name,
                pv.id,
                pi.image_path,
                p.id,
                p.name,
                oi.quantity,
                pav.value,
                pa.name,
                sf.shipping_method
            LIMIT
                100
        ";

        $result = $query->query($sql, ['seller_id' => $seller_id, 'default' => 1])->fetchAll();

        return $result;
    }
}
