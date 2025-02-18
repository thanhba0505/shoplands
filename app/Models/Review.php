<?php

require_once 'app/Models/ConnectDatabase.php';

class Review
{
    // Lấy danh sách bình luận theo product_id
    public function getReviewsByProductId($product_id)
    {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                r.id AS review_id,
                u.name AS username,
                u.avatar AS avatar,
                r.rating AS rating,
                r.comment AS comment,
                r.date_time AS date_time,
                pv.id AS product_variant_id
            FROM
                reviews r
                JOIN product_variants pv ON pv.id = r.product_variant_id
                JOIN users u ON u.id = r.user_id
            WHERE
                pv.product_id = :product_id
            ORDER BY
                r.date_time DESC
        ";

        $result = $query->query($sql, ['product_id' => $product_id])->fetchAll();

        return $result;
    }

    // Lấy trung bình đánh giá theo product_id
    public function getAverageRatingByProductId($product_id)
    {
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

        return $result['average_rating'] ?? 0;
    }

    // Lấy danh sách mức đánh giá theo product_id
    public function getRatingCountsByProductId($product_id)
    {
        $query = new ConnectDatabase();

        $sql = "
        SELECT
            r.rating,
            COUNT(*) AS count
        FROM
            reviews r
            JOIN product_variants pv ON pv.id = r.product_variant_id
        WHERE
            pv.product_id = :product_id
        GROUP BY
            r.rating
        ORDER BY
            r.rating DESC
    ";

        $result = $query->query($sql, ['product_id' => $product_id])->fetchAll();

        return $result;
    }

    // Lấy số bình luận theo product_id
    public function getTotalReviewsByProductId($product_id)
    {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                COUNT(*) AS total_reviews
            FROM
                reviews r
                JOIN product_variants pv ON pv.id = r.product_variant_id
            WHERE
                pv.product_id = :product_id
        ";

        $result = $query->query($sql, ['product_id' => $product_id])->fetch();

        return $result['total_reviews'] ?? 0;
    }

    // Lấy số đánh giá có bình luận theo product_id
    public function getReviewCountWithCommentByProductId($product_id)
    {
        $query = new ConnectDatabase();

        $sql = "
            SELECT 
                COUNT(*) AS count
            FROM 
                reviews r
                JOIN product_variants pv ON pv.id = r.product_variant_id
            WHERE 
                pv.product_id = :product_id
                AND r.comment IS NOT NULL AND r.comment != ''
        ";

        $result = $query->query($sql, ['product_id' => $product_id])->fetch();

        return $result['count'] ?? 0;
    }

    // Lấy số đánh giá có hình ảnh
    public function getReviewCountWithImagesByProductId($product_id)
    {
        $query = new ConnectDatabase();

        $sql = "
            SELECT 
                COUNT(DISTINCT r.id) AS count
            FROM 
                reviews r
                JOIN product_variants pv ON pv.id = r.product_variant_id
                LEFT JOIN review_images ri ON ri.review_id = r.id
            WHERE 
                pv.product_id = :product_id
                AND ri.image_path IS NOT NULL AND ri.image_path != ''
        ";

        $result = $query->query($sql, ['product_id' => $product_id])->fetch();

        return $result['count'] ?? 0;
    }
}
