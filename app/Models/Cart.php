<?php

require_once 'app/Models/ConnectDatabase.php';
require_once 'app/Models/QueryCustom.php';

class Cart
{

    public function getAllByUserId($userId)
    {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT
                c.id AS cart_id,
                c.quantity AS cart_quantity,
                p.id AS product_id,
                p.name AS product_name,
                pv.id AS variant_id,
                pv.price AS product_price,
                pv.promotion_price AS product_promotion_price,
                s.id AS seller_id,
                s.name AS seller_name,
                pa.name AS product_attribute,
                pav.value AS product_attribute_value,
                pi.image_path AS product_image
            FROM
                carts c
                JOIN product_variants pv ON pv.id = c.product_variant_id
                JOIN products p ON p.id = pv.product_id
                LEFT JOIN product_variant_values pvv ON pvv.product_variant_id = pv.id
                LEFT JOIN product_attribute_values pav ON pav.id = pvv.product_attribute_value_id
                LEFT JOIN product_attributes pa ON pa.id = pav.product_attribute_id
                JOIN sellers s ON s.id = p.seller_id
                JOIN product_images pi ON pi.product_id = p.id
            WHERE
                c.user_id = :userId
                AND pi.default = :default
        ";

        $result = $query->query($sql, ['userId' => $userId, "default" => '1'])->fetchAll();

        return $result;
    }

    public function addCart($userId, $productVariantId, $quantity)
    {
        $query = new QueryCustom();

        $result = $query
            ->insert('carts', ['user_id' => $userId, 'product_variant_id' => $productVariantId, 'quantity' => $quantity]);

        return $result;
    }
}
