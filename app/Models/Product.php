<?php

require_once 'app/Models/ConnectDatabase.php';

class Product
{
    // Lấy danh sách sản phẩm
    public function getProducts($limit = 12, $sellerId = null)
    {
        $query = new ConnectDatabase();

        $sqlWhere = '';
        $params = ['default' => 1];

        if ($sellerId !== null) {
            $sqlWhere = "AND p.seller_id = :sellerId";
            $params['sellerId'] = $sellerId;
        }

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
            WHERE
                pi.default = :default " . $sqlWhere . "
            GROUP BY
                p.id,
                p.name,
                pi.image_path
            ORDER BY
                p.id
            LIMIT
                $limit
        ";

        $result = $query->query($sql, $params)->fetchAll();

        return $result;
    }
    public function getProductsShop($sellerId = null, $limit = 12)
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
            WHERE
                pi.default = :default 
                AND p.seller_id = :sellerId
            GROUP BY
                p.id,
                p.name,
                pi.image_path
            ORDER BY
                p.id
            LIMIT
                $limit
        ";

        $result = $query->query($sql, ['default' => 1, 'sellerId' => $sellerId])->fetchAll();

        return $result;
    }

    // Lấy số sản phẩm đã bán
    public function getSoldQuantityByProductId($product_id)
    {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                sum(pv.sold_quantity) AS sold_quantity
            FROM
                product_variants pv
            WHERE
                pv.product_id = :product_id
        ";

        $result = $query->query($sql, ['product_id' => $product_id])->fetch();

        return $result['sold_quantity'] ?? 0;
    }

    // Lấy số sản phẩm tồn kho
    public function getQuantityByProductId($product_id)
    {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                sum(pv.quantity) AS quantity
            FROM
                product_variants pv
            WHERE
                pv.product_id = :product_id
        ";

        $result = $query->query($sql, ['product_id' => $product_id])->fetch();

        return $result['quantity'] ?? 0;
    }

    // Lấy đanh sách thông tin sản phẩm sử dụng product_id 
    public function getByProductId($product_id)
    {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                p.id AS product_id,
                p.name AS product_name,
                p.description AS product_description,
                p.status AS product_status,
                p.seller_id AS seller_id
            FROM
                products p
            WHERE
                p.id = :product_id
        ";

        $result = $query->query($sql, ['product_id' => $product_id])->fetch();

        return $result;
    }

    // SELLER
    // Lấy danh sách sản phẩm theo người bán
    public function getProductsBySellerId($seller_id, $status = null, $limit = 12)
    {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                p.id AS product_id,
                p.name AS product_name,
                pi.image_path AS product_image,
                c.name AS category,
                p.status AS product_status,
                MIN(pv.price) AS min_product_price,
                MAX(pv.price) AS max_product_price,
                SUM(pv.quantity) AS quantity,
                SUM(pv.sold_quantity) AS sold_quantity
            FROM
                products p
                JOIN product_variants pv ON pv.product_id = p.id
                JOIN product_images pi ON pi.product_id = p.id
                JOIN sellers s ON s.id = p.seller_id
                LEFT JOIN categories c ON c.id = p.category_id
            WHERE
                s.id = :seller_id
                AND pi.default = :default
                " . ($status ? "AND p.status = :status" : "") . " 
            GROUP BY
                p.id,
                p.name,
                pi.image_path,
                c.name,
                p.status
            LIMIT
                $limit
        ";

        // Gắn tham số truy vấn
        $params = [
            'seller_id' => $seller_id,
            'default' => 1
        ];
        if ($status) {
            $params['status'] = $status;
        }

        $result = $query->query($sql, $params)->fetchAll();

        return $result;
    }
}
