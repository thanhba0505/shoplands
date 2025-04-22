<?php

namespace App\Models;

use App\Helpers\Response;
use App\Models\ConnectDatabase;

class ProductModel {
    public static function getListProducts($limit = 12, $page = 0) {
        $conn = new ConnectDatabase();

        $offset = $page * $limit;

        $sql = "
            SELECT
                p.id AS product_id,
                p.name,
                p.status,
                p.seller_id,

                pv.price,
                pv.promotion_price,
                pv.quantity,
                pv.sold_quantity,

                pi.image_path,

                ROUND(AVG(r.rating), 1) AS average_rating,
                COUNT(r.id) AS count_reviews
            FROM
                products p
                JOIN product_variants pv ON pv.product_id = p.id
                LEFT JOIN product_images pi ON pi.product_id = p.id
                LEFT JOIN reviews r ON r.product_variant_id = pv.id
                JOIN (
                    SELECT 
                        id
                    FROM 
                        products
                    WHERE 
                        status = 'active'
                    LIMIT 
                        $limit 
                    OFFSET 
                        $offset
                ) AS limited_products ON limited_products.id = p.id

            WHERE
                p.status = :status
                AND pi.default = 1

            GROUP BY
                p.id,
                p.name,
                p.status,
                p.seller_id,

                pv.price,
                pv.promotion_price,
                pv.quantity,
                pv.sold_quantity,

                pi.image_path
        ";

        $sql = "
            SELECT
                p.id AS product_id,
                p.name,
                p.status,
                p.seller_id,

                pi.image_path,

                MAX(pv.price) AS max_price,
                MIN(pv.price) AS min_price,

                MAX(pv.promotion_price) AS max_promotion_price,
                MIN(pv.promotion_price) AS min_promotion_price,

                (
                    SELECT
                        pv2.price
                    FROM
                        product_variants pv2
                    WHERE
                        pv2.product_id = p.id
                        AND pv2.promotion_price = MIN(pv.promotion_price)
                ) AS price_from_min_price,
                
                SUM(pv.quantity) AS quantity,
                SUM(pv.sold_quantity) AS sold_quantity,

                ROUND(AVG(r.rating), 1) AS average_rating,
                COUNT(r.id) AS count_reviews
            FROM
                products p
                JOIN product_variants pv ON pv.product_id = p.id
                LEFT JOIN product_images pi ON pi.product_id = p.id
                LEFT JOIN reviews r ON r.product_variant_id = pv.id

            WHERE
                p.status = :status
                AND pi.default = 1

            GROUP BY
                p.id,
                p.name,
                p.status,
                p.seller_id,

                pi.image_path
            LIMIT
                $limit
            OFFSET
                $offset
        ";

        $result = $conn->query($sql, [
            'status' => 'active'
        ])->fetchAll();

        return $result ?? [];
    }


    // Lấy danh sách sản phẩm
    public static function getAll($limit = 12, $page = 1) {
        $query = new ConnectDatabase();

        $offset = ($page - 1) * $limit;

        $sql = "
            SELECT
                p.id AS product_id,
                p.name,
                p.description,
                p.status,
                p.seller_id
            FROM
                products p
            WHERE
                p.status = :status
            LIMIT 
                $limit
            OFFSET 
                $offset
        ";

        $result = $query->query($sql, ['status' => 'active'])->fetchAll();

        return $result ?? [];
    }

    // Lấy danh sách sản phẩm
    public static function getByOption($category_ids = [], $search = null, $min_price = 0, $max_price = 5000000, $limit = 12, $page = 1) {
        $query = new ConnectDatabase();

        $min_price = empty($min_price) ? 0 : $min_price;
        $max_price = empty($max_price) ? 5000000 : $max_price;

        $offset = ($page - 1) * $limit;

        // Start building the count query
        $countSql = "
            SELECT COUNT(DISTINCT p.id) AS total_count
            FROM
                products p
            WHERE
                p.status = :status
        ";

        // Add conditions for category if provided
        if (!empty($category_ids)) {
            $countSql .= " AND p.category_id IN (" . implode(',', $category_ids) . ")";
        }

        // Add search condition if provided
        if (!empty($search)) {
            $countSql .= " AND p.name LIKE :search";
        }

        // Query to check if all product_variants' minimum price of the product is within the min_price and max_price range
        $countSql .= "
            AND p.id IN (
                SELECT pv.product_id
                FROM product_variants pv
                GROUP BY pv.product_id
                HAVING MIN(LEAST(IFNULL(pv.price, 5000000), IFNULL(pv.promotion_price, 5000000))) BETWEEN :min_price AND :max_price
            )
        ";

        // Execute the count query
        $countParams = [
            'status' => 'active',
            'min_price' => $min_price,
            'max_price' => $max_price
        ];

        if (!empty($search)) {
            $countParams['search'] = "%" . $search . "%";
        }

        $countResult = $query->query($countSql, $countParams)->fetch();
        $totalCount = $countResult['total_count'];

        // Start building the main query to get the actual results
        $sql = "
            SELECT DISTINCT
                p.id AS product_id,
                p.name,
                p.description,
                p.status,
                p.seller_id,
                p.category_id
            FROM
                products p
            WHERE
                p.status = :status
        ";

        // Add conditions for category if provided
        if (!empty($category_ids)) {
            $sql .= " AND p.category_id IN (" . implode(',', $category_ids) . ")";
        }

        // Add search condition if provided
        if (!empty($search)) {
            $sql .= " AND p.name LIKE :search";
        }

        // Query to check if all product_variants' minimum price of the product is within the min_price and max_price range
        $sql .= "
            AND p.id IN (
                SELECT pv.product_id
                FROM product_variants pv
                GROUP BY pv.product_id
                HAVING MIN(LEAST(IFNULL(pv.price, 5000000), IFNULL(pv.promotion_price, 5000000))) BETWEEN :min_price AND :max_price
            )
        ";

        // Adding limit and offset
        $sql .= "
            LIMIT 
                :limit
            OFFSET 
                :offset
        ";

        // Prepare parameters for the main query
        $params = [
            'status' => 'active',
            'min_price' => $min_price,
            'max_price' => $max_price,
            'limit' => $limit,
            'offset' => $offset
        ];

        if (!empty($search)) {
            $params['search'] = "%" . $search . "%";
        }

        // Execute the main query to get results
        $result = $query->query($sql, $params)->fetchAll();

        // Return both the count and the result
        return [
            'count' => $totalCount,
            'products' => $result ?? []
        ];
    }

    // Lấy danh sách sản phẩm theo seller
    public static function getBySellerId($seller_id, $status = 'all', $limit = 12, $page = 1) {
        $query = new ConnectDatabase();

        $offset = ($page - 1) * $limit;

        // Xác định phần điều kiện status
        $statusCondition = $status !== 'all' ? "AND p.status = :status" : "";

        // Tạo mảng params chứa các tham số sẽ truyền vào query
        $params = [
            'seller_id' => $seller_id,
            'limit' => $limit,
            'offset' => $offset
        ];

        // Nếu status không phải 'all', thêm tham số status vào mảng params
        if ($status !== 'all') {
            $params['status'] = $status;
        }

        $sql = "
            SELECT
                p.id AS product_id,
                p.name,
                p.description,
                p.status,
                p.seller_id
            FROM
                products p
            WHERE
                p.seller_id = :seller_id
                $statusCondition
            LIMIT 
                :limit OFFSET :offset
        ";

        // Thực hiện truy vấn với các tham số
        $result = $query->query($sql, $params)->fetchAll();

        return $result ?? [];
    }

    // Đếm sản phẩm theo seller
    public static function countBySellerId($seller_id, $status = 'all') {
        $query = new ConnectDatabase();

        // Tạo điều kiện cho status
        $statusCondition = $status !== 'all' ? "AND p.status = :status" : "";

        // Tạo mảng params chứa các tham số truyền vào query
        $params = [
            'seller_id' => $seller_id
        ];

        // Nếu status không phải là 'all', thêm tham số status vào mảng params
        if ($status !== 'all') {
            $params['status'] = $status;
        }

        $sql = "
            SELECT
                COUNT(*) AS total
            FROM
                products p
            WHERE
                p.seller_id = :seller_id
                $statusCondition
        ";

        // Thực hiện truy vấn với các tham số
        $result = $query->query($sql, $params)->fetch();

        return $result['total'] ?? 0;
    }

    // Đếm toàn bộ sản phẩm
    public static function count($status = 'all') {
        $query = new ConnectDatabase();

        // Tạo điều kiện cho status
        $statusCondition = $status !== 'all' ? "AND p.status = :status" : "";

        // Tạo mảng params chúa các tham số truyện vào query
        $params = [];

        // Nếu status không phải là 'all', thêm tham số status vào mảng params
        if ($status !== 'all') {
            $params['status'] = $status;
        }

        $sql = "
            SELECT
                COUNT(*) AS total
            FROM
                products p
            WHERE
                1=1
                $statusCondition
        ";

        // Thực hiện truy vấn với các tham số
        $result = $query->query($sql, $params)->fetch();

        return $result['total'] ?? 0;
    }

    // Lấy thông tin sản phẩm theo product_id
    public static function getByProductId($product_id) {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                p.id AS product_id,
                p.name,
                p.description,
                p.status,
                p.seller_id
            FROM
                products p
            WHERE
                p.status = :status
                AND p.id = :product_id
        ";

        $result = $query->query($sql, ['status' => 'active', 'product_id' => $product_id])->fetch();

        return $result ?? null;
    }

    // Lấy thông tin sản phẩm theo cart_id
    public static function getByCartId($cart_id) {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                p.id AS product_id,
                p.name
            FROM
                products p
                JOIN product_variants pv ON pv.product_id = p.id
                JOIN carts c ON c.product_variant_id = pv.id
            WHERE
                p.status = :status
                AND c.id = :cart_id
        ";

        $result = $query->query($sql, ['status' => 'active', 'cart_id' => $cart_id])->fetch();

        return $result ?? null;
    }

    // Lấy thông tin sản phẩm theo product_variant_id
    public static function getByProductVariantId($product_variant_id) {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                p.id AS product_id,
                p.name,
                p.description,
                p.status,
                p.seller_id
            FROM
                products p
                JOIN product_variants pv ON pv.product_id = p.id
            WHERE
                p.status = :status
                AND pv.id = :product_variant_id
        ";

        $result = $query->query($sql, ['status' => 'active', 'product_variant_id' => $product_variant_id])->fetch();

        return $result ?? null;
    }

    // Thêm 1 sản phẩm và trả về id
    public static function add($name, $description, $seller_id, $category_id = null, $status = 'active') {
        $conn = new ConnectDatabase();

        $sql = "
            INSERT INTO 
                products (name, description, status, seller_id, category_id)
            VALUES
                (:name, :description, :status, :seller_id, :category_id)
        ";

        $conn->query($sql, [
            'name' => $name,
            'description' => $description,
            'status' => $status,
            'seller_id' => $seller_id,
            'category_id' => $category_id
        ]);

        return $conn->getConnection()->lastInsertId();
    }

    // Cập nhật description
    public static function updateDescription($product_id, $description) {
        $conn = new ConnectDatabase();

        $sql = "
            UPDATE
                products
            SET
                description = :description
            WHERE    
                id = :product_id
        ";

        $result = $conn->query($sql, [
            'description' => $description,
            'product_id' => $product_id
        ]);

        return $result->rowCount() > 0 ? true : false;
    }
}
