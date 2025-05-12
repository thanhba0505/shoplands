<?php

namespace App\Models;

use App\Helpers\Carbon;
use App\Models\ConnectDatabase;

class ReviewModel {
    // Lấy trung bình đánh giá theo product_id
    public static function getAverageRatingByProductId($product_id) {
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
    public static function getCountReviewsByProductId($product_id) {
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

    // Thêm bình luận
    public static function add($userId, $orderId, $productVariantId, $rating, $comment) {
        $conn = new ConnectDatabase();

        $createdAt = Carbon::now();

        $sql = "
            INSERT INTO
                reviews (user_id, order_id, product_variant_id, rating, comment, created_at)
            VALUES
                (:userId, :orderId, :productVariantId, :rating, :comment, :createdAt)
        ";

        $conn->query($sql, [
            'userId' => $userId,
            'orderId' => $orderId,
            'productVariantId' => $productVariantId,
            'rating' => $rating,
            'comment' => $comment,
            'createdAt' => $createdAt
        ]);

        return $conn->getConnection()->lastInsertId();
    }

    // Thêm 1 danh sách ảnh
    public static function addListImages($review_id, $image_paths) {
        $conn = new ConnectDatabase();

        $sql = "
            INSERT INTO
                review_images (review_id, image_path)
            VALUES
        ";

        $params = [];

        foreach ($image_paths as $key => $image_path) {
            $sql .= "(:review_id" . $key . ", :image_path" . $key . ")";

            if ($key < count($image_paths) - 1) {
                $sql .= ",";
            }

            $params['review_id' . $key] = $review_id;
            $params['image_path' . $key] = $image_path;
        }

        $result = $conn->query($sql, $params);

        return $result;
    }

    // Lấy danh sách đánh giá theo order_id
    public static function getByOrderId($orderId) {
        $conn = new ConnectDatabase();

        $sql = "
            SELECT
                r.*,
                GROUP_CONCAT(ri.image_path) AS image_paths
            FROM
                reviews r
                LEFT JOIN review_images ri ON r.id = ri.review_id
            WHERE
                r.order_id = :order_id
            GROUP BY
                r.id
        ";

        $result = $conn->query($sql, ['order_id' => $orderId])->fetchAll();

        return $result;
    }
}
