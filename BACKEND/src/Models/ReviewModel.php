<?php

namespace App\Models;

use App\Helpers\Carbon;
use App\Helpers\DataHelper;
use App\Helpers\Response;
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

        return [
            'review_id' => $conn->getConnection()->lastInsertId(),
            'created_at' => $createdAt
        ];
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
                r.id AS review_id,
                r.rating,
                r.comment,
                r.created_at,
                r.product_variant_id,
                r.user_id,
                r.order_id,
                ri.image_path
            FROM
                reviews r
                LEFT JOIN review_images ri ON r.id = ri.review_id
            WHERE
                r.order_id = :order_id
        ";
        $result = $conn->query($sql, ['order_id' => $orderId])->fetchAll();

        $config = [
            'keep_columns' => [
                'review_id',
                'rating',
                'comment',
                'created_at',
                'product_variant_id',
                'user_id',
                'order_id'
            ],
            'group_columns' => [
                'image_paths' => ['image_path']
            ]
        ];

        $result = DataHelper::groupData($result, $config);

        return $result;
    }

    // Lấy danh sách đánh giá theo product_id
    public static function getByProductId($product_id, $limit = 3, $page = 0) {
        $conn = new ConnectDatabase();

        $offset = $limit * $page;

        $sql = "
           SELECT
            r.id AS review_id,
            r.rating,
            r.comment,
            r.created_at,
            r.product_variant_id,
            r.user_id,
            r.order_id,
            ri.image_path,
            pa.name AS attribute_name,
            pav.value AS attribute_value,
            u.avatar,
            u.name
        FROM (
            SELECT *
            FROM reviews
            WHERE product_variant_id IN (
                SELECT id FROM product_variants WHERE product_id = :product_id
            )
            ORDER BY id DESC
            LIMIT :limit OFFSET :offset
        ) AS r
        LEFT JOIN review_images ri ON r.id = ri.review_id
        LEFT JOIN product_variants pv ON pv.id = r.product_variant_id
        LEFT JOIN product_variant_values pvv ON pvv.product_variant_id = pv.id
        LEFT JOIN product_attribute_values pav ON pav.id = pvv.product_attribute_value_id
        LEFT JOIN product_attributes pa ON pa.id = pav.product_attribute_id
        JOIN users u ON u.id = r.user_id
        ";

        $result = $conn->query($sql, [
            'product_id' => $product_id,
            'limit' => $limit,
            'offset' => $offset
        ])->fetchAll();

        $config = [
            'keep_columns' => [
                'review_id',
                'rating',
                'comment',
                'created_at',
                'product_variant_id',
                'user_id',
                'avatar',
                'name',
                'order_id',
            ],
            'group_columns' => [
                'image_paths' => ['image_path'],
                'attributes' => ['attribute_name', 'attribute_value']
            ]
        ];

        $result = DataHelper::groupData($result, $config);

        foreach ($result as $key => $item) {
            if ($item['attributes'][0]['attribute_name'] === null) {
                $result[$key]['attributes'] = [];
            }
        }

        return $result;
    }

    // Lấy danh sách đánh giá theo seller id
    public static function getBySellerId($seller_id, $limit = 3, $page = 0) {
        $conn = new ConnectDatabase();

        $offset = $limit * $page;

        $sql = "
           SELECT
            r.id AS review_id,
            r.rating,
            r.comment,
            r.created_at,
            r.product_variant_id,
            r.user_id,
            r.order_id,
            ri.image_path,
            pa.name AS attribute_name,
            pav.value AS attribute_value,
            u.avatar,
            u.name
        FROM (
            SELECT DISTINCT sr.*
            FROM reviews sr JOIN orders so ON so.id = sr.order_id
            WHERE so.seller_id = :seller_id 
            ORDER BY sr.id DESC
            LIMIT :limit OFFSET :offset
        ) AS r
        LEFT JOIN review_images ri ON r.id = ri.review_id
        LEFT JOIN product_variants pv ON pv.id = r.product_variant_id
        LEFT JOIN product_variant_values pvv ON pvv.product_variant_id = pv.id
        LEFT JOIN product_attribute_values pav ON pav.id = pvv.product_attribute_value_id
        LEFT JOIN product_attributes pa ON pa.id = pav.product_attribute_id
        JOIN users u ON u.id = r.user_id
        ";

        $result = $conn->query($sql, [
            'seller_id' => $seller_id,
            'limit' => $limit,
            'offset' => $offset
        ])->fetchAll();
        
        $config = [
            'keep_columns' => [
                'review_id',
                'rating',
                'comment',
                'created_at',
                'product_variant_id',
                'user_id',
                'avatar',
                'name',
                'order_id',
            ],
            'group_columns' => [
                'image_paths' => ['image_path'],
                'attributes' => ['attribute_name', 'attribute_value']
            ]
        ];

        $result = DataHelper::groupData($result, $config);

        foreach ($result as $key => $item) {
            if ($item['attributes'][0]['attribute_name'] === null) {
                $result[$key]['attributes'] = [];
            }
        }

        return $result;
    }
}
