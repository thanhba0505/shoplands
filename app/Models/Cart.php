<?php

require_once 'app/Models/ConnectDatabase.php';

class Cart
{

    public function getAllByUserId($userId)
    {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT
                c.id as cart_id,
                c.quantity as cart_quantity,
                p.name as product_name,
                p.id as product_id,
                pv.price as product_price,
                pv.promotion_price as product_promotion_price,
                pv.quantity as product_quantity,
                pav.value as product_attribute_value,
                pa.name as product_attribute,
                s.id as seller_id,
                s.name as seller_name
            FROM
                carts c
                JOIN product_variants pv ON pv.id = c.product_variant_id
                JOIN products p ON p.id = pv.product_id
                LEFT JOIN product_attribute_values pav ON pav.id = pv.product_attribute_value_id
                LEFT JOIN product_attributes pa ON pa.id = pav.product_attribute_id
                LEFT JOIN sellers s ON s.id = p.seller_id
            WHERE
                c.user_id = :userId
        ";

        $result = $query->query($sql, ['userId' => $userId])->fetchAll();

        return $result;
    }
}
