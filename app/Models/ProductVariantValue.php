<?php

require_once 'app/Models/ConnectDatabase.php';

class ProductVariantValue
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
                pv.sold_quantity AS product_variant_sold_quantity
            FROM
                product_variants pv
            WHERE
                pv.product_id = :product_id
        ";

        $result = $query->query($sql, ['product_id' => $product_id])->fetch();

        return $result;
    }
}
