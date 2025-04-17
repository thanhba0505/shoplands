<?php

namespace App\Models;

use App\Models\ConnectDatabase;

class ReviewModel
{
    // Lấy trung bình đánh giá theo product_id
    public static function getAverageRatingByProductId($product_id)
    {
        $query = new ConnectDatabase();

        $sql = "
             SELECT
                 ROUND(AVG(r.rating), 1) AS average_rating
             FROM
                 reviews r
                 JOIN product_variants pv ON pv.id = r.product_variant_id
             WHERE
                 pv.product_id = :product_id
         ";

        $result = $query->query($sql, ['product_id' => $product_id])->fetch();

        return $result['average_rating'] ?? 0;
    }

    // Lấy số bình luận theo product_id
    public static function getCountReviewsByProductId($product_id)
    {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                COUNT(*) AS count_reviews
            FROM
                reviews r
                JOIN product_variants pv ON pv.id = r.product_variant_id
            WHERE
                pv.product_id = :product_id
        ";

        $result = $query->query($sql, ['product_id' => $product_id])->fetch();

        return $result['count_reviews'] ?? 0;
    }
}
