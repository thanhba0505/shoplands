<?php

require_once 'app/Models/ConnectDatabase.php';

class Review
{
    public function getReviewsByProductId($product_id)
    {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                u.name AS username,
                u.avatar AS avatar,
                r.rating AS rating,
                r.comment AS comment,
                r.created_at AS created_at
            FROM
                reviews r
                JOIN product_variants pv ON pv.id = r.product_variant_id
                JOIN users u ON u.id = r.user_id
            WHERE
                pv.product_id = :product_id
        ";

        $result = $query->query($sql, ['product_id' => $product_id])->fetchAll();

        return $result;
    }

    public function getAverageRatingByProductId($product_id) {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                AVG(r.rating) AS average_rating
            FROM
                reviews r
                JOIN product_variants pv ON pv.id = r.product_variant_id
            WHERE
                pv.product_id = :product_id
        ";

        $result = $query->query($sql, ['product_id' => $product_id])->fetch();

        return $result['average_rating'];
    }
}
