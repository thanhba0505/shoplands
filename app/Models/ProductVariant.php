<?php

require_once 'app/Models/ConnectDatabase.php';

class ProductVariant
{
    public function getByProductId($product_id)
    {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                pv.id AS product_variant_id,
                pv.price AS product_variant_price,
                pv.promotion_price AS product_variant_promotion_price,
                pv.quantity AS product_variant_quantity,
                pv.sold_quantity AS product_variant_sold_quantity,
                pa.id AS product_attribute_id,
                pa.name AS product_attribute_name,
                pav.id AS product_attribute_value_id,
                pav.value AS product_attribute_value,
                pvv.id AS product_variant_value_id
            FROM
                product_variants pv
                LEFT JOIN product_variant_values pvv ON pvv.product_variant_id = pv.id
                JOIN product_attribute_values pav ON pav.id = pvv.product_attribute_value_id
                JOIN product_attributes pa ON pa.id = pav.product_attribute_id
            WHERE
                pv.product_id = :product_id
            ORDER BY
                pv.id;
        ";

        $result = $query->query($sql, ['product_id' => $product_id])->fetchAll();

        return $result;
    }
}
