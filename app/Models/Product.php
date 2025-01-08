<?php

require_once 'app/Models/ConnectDatabase.php';

class Product
{
    public function getProducts($limit = 12)
    {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                p.id,
                p.name,
                min(pv.price) AS price,
                min(pv.promotion_price) AS promotion_price,
                sum(pv.sold_quantity) AS sold_quantity,
                avg(r.rating) AS rating,
                pi.image_path
            FROM
                products p
                JOIN product_variants pv ON pv.product_id = p.id
                JOIN product_images pi ON pi.product_id = p.id
                LEFT JOIN reviews r ON r.product_variant_id = pv.id
            GROUP BY
                p.id,
                p.name,
                pi.image_path
            ORDER BY
                p.id
            LIMIT
                $limit
        ";

        $result = $query->query($sql)->fetchAll();

        return $result;
    }
}
