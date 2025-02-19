<?php

require_once 'app/Models/QueryCustom.php';
require_once 'app/Models/ConnectDatabase.php';
require_once 'app/Models/User.php';

class Seller
{
    // Tìm kiếm seller theo user_id
    public function findByUserId($userId)
    {
        $query  = new QueryCustom();
        $result = $query
            ->select()
            ->from('sellers')
            ->where('user_id = :id', ['id' => $userId])
            ->first();

        return $result;
    }

    // Tìm kiếm seller theo seller_id
    public function findBySellerId($seller_id)
    {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                s.id AS id,
                s.name AS name,
                s.description AS description,
                s.background AS background,
                s.logo AS logo
            FROM
                sellers s
            WHERE
                s.id = :seller_id
        ";

        $result = $query->query($sql, ['seller_id' => $seller_id])->fetch();

        return $result;
    }

    // Lấy thông tin đánh giá của seller
    public function getReviewInfoBySellerId($seller_id)
    {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                distinct COUNT(*) AS count,
                AVG(r.rating) AS rating
            FROM
                sellers s
                JOIN products p ON p.seller_id = s.id
                JOIN product_variants pv ON pv.product_id = p.id
                JOIN reviews r ON r.product_variant_id = pv.id
            WHERE
                s.id = :seller_id
        ";

        $result = $query->query($sql, ['seller_id' => $seller_id])->fetch();

        return $result;
    }

    // Lấy tổng số sản phẩm của seller
    public function getProductCountBySellerId($seller_id)
    {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                distinct COUNT(*) AS count
            FROM
                sellers s
                JOIN products p ON p.seller_id = s.id
            WHERE
                s.id = :seller_id
        ";

        $result = $query->query($sql, ['seller_id' => $seller_id])->fetch();

        return $result['count'] ?? 0;
    }
}
