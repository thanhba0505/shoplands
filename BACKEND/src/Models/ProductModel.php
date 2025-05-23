<?php

namespace App\Models;

use App\Helpers\DataHelper;
use App\Helpers\Hash;
use App\Helpers\Response;
use App\Models\ConnectDatabase;

class ProductModel {
    // Lấy danh sách sản phẩm có lọc
    public static function getListProducts(
        $status = 'active',
        $limit = 5,
        $page = 0,
        $category_ids = [],
        $search = null,
        $min_price = null,
        $max_price = null,
        $order_by_price = null, // 'asc' hoặc 'desc'
        $order_by_rating = null, // 'asc' hoặc 'desc'
        $seller_id = null
    ) {
        if ($status === 'all') {
            $status = null;
        }

        $max_price_product = MAX_PRICE_PRODUCT;

        $conn = new ConnectDatabase();
        $offset = $page * $limit;

        $whereClauses = ["IFNULL(pi.default, 1) = 1"];
        $params = [];

        // Status
        if (!empty($status)) {
            $whereClauses[] = "p.status = :status";
            $params['status'] = $status;
        }

        // Search
        if (!empty($search)) {
            $whereClauses[] = "p.name LIKE :search";
            $params['search'] = "%" . $search . "%";
        }

        // Category
        if (!empty($category_ids)) {
            $placeholders = implode(',', array_map(function ($key) {
                return ":category_id_$key";
            }, array_keys($category_ids)));
            $whereClauses[] = "p.category_id IN ($placeholders)";
            foreach ($category_ids as $key => $category_id) {
                $params["category_id_$key"] = $category_id;
            }
        }

        // Seller
        if (!empty($seller_id)) {
            $whereClauses[] = "p.seller_id = :seller_id";
            $params['seller_id'] = $seller_id;
        }

        $whereClauses[] = "a.status = :a_status";
        $params['a_status'] = 'active';


        $whereSQL = implode(' AND ', $whereClauses);

        // Truy vấn đếm tổng số bản ghi
        $countSql = "
            SELECT COUNT(*) AS total_count FROM (
                SELECT p.id
                FROM products p
                JOIN product_variants pv ON pv.product_id = p.id
                LEFT JOIN product_images pi ON pi.product_id = p.id
                LEFT JOIN reviews r ON r.product_variant_id = pv.id
                LEFT JOIN categories c ON c.id = p.category_id
                JOIN sellers s ON s.id = p.seller_id
                JOIN accounts a ON a.id = s.account_id
                WHERE $whereSQL
                GROUP BY p.id
        ";

        // Apply HAVING conditions for min/max prices
        if (!is_null($min_price) && !is_null($max_price)) {
            $countSql .= " HAVING 
                MAX(IFNULL(pv.price, 0)) <= :max_price1
                AND MIN(IFNULL(pv.price, $max_price_product)) >= :min_price1
                AND MAX(IFNULL(pv.promotion_price, 0)) <= :max_price2
                AND MIN(IFNULL(pv.promotion_price, $max_price_product)) >= :min_price2";
            $params['min_price1'] = $min_price;
            $params['max_price1'] = $max_price;
            $params['min_price2'] = $min_price;
            $params['max_price2'] = $max_price;
        } elseif (!is_null($min_price)) {
            $countSql .= " HAVING MIN(IFNULL(pv.price, $max_price_product)) >= :min_price1 
                            AND MIN(IFNULL(pv.promotion_price, $max_price_product)) >= :min_price2";
            $params['min_price1'] = $min_price;
            $params['min_price2'] = $min_price;
        } elseif (!is_null($max_price)) {
            $countSql .= " HAVING MAX(IFNULL(pv.price, 0)) <= :max_price1 
                            AND MAX(IFNULL(pv.promotion_price, 0)) <= :max_price2";
            $params['max_price1'] = $max_price;
            $params['max_price2'] = $max_price;
        }

        $countSql .= ") AS temp_count";

        // Thực thi truy vấn đếm tổng số bản ghi
        $countResult = $conn->query($countSql, $params)->fetch();
        $totalCount = $countResult['total_count'];

        // Truy vấn chính để lấy dữ liệu với phân trang
        $conn = new ConnectDatabase();

        $sql = "
            SELECT
                p.id AS product_id,
                p.name,
                p.status,
                p.seller_id,

                pi.image_path,

                c.name AS category_name,

                LEAST(MIN(pv.price), IFNULL(MIN(pv.promotion_price), $max_price_product)) AS min_price,
                GREATEST(MAX(pv.price), IFNULL(MAX(pv.promotion_price), 0)) AS max_price,
        
                (
                    SELECT 
                        pv2.price
                    FROM 
                        product_variants pv2
                    WHERE   
                        pv2.product_id = p.id
                        AND pv2.promotion_price = MIN(pv.promotion_price)
                    ORDER BY 
                        pv2.price ASC
                    LIMIT 
                        1
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
                LEFT JOIN categories c ON c.id = p.category_id
                JOIN sellers s ON s.id = p.seller_id
                JOIN accounts a ON a.id = s.account_id
            WHERE 
                $whereSQL
            GROUP BY
                p.id, p.name, p.status, p.seller_id, pi.image_path
        ";

        // Apply HAVING conditions for min/max prices
        if (!is_null($min_price) && !is_null($max_price)) {
            $sql .= " HAVING 
                MAX(IFNULL(pv.price, 0)) <= :max_price1
                AND MIN(IFNULL(pv.price, $max_price_product)) >= :min_price1
                AND MAX(IFNULL(pv.promotion_price, 0)) <= :max_price2
                AND MIN(IFNULL(pv.promotion_price, $max_price_product)) >= :min_price2";
        } elseif (!is_null($min_price)) {
            $sql .= " HAVING MIN(IFNULL(pv.price, $max_price_product)) >= :min_price1 AND MIN(IFNULL(pv.promotion_price, $max_price_product)) >= :min_price2";
        } elseif (!is_null($max_price)) {
            $sql .= " HAVING MAX(IFNULL(pv.price, 0)) <= :max_price1 AND MAX(IFNULL(pv.promotion_price, 0)) <= :max_price2";
        }

        // Thêm sắp xếp
        $orderClauses = [];
        // Sắp xếp theo đánh giá
        if (!is_null($order_by_rating) && in_array(strtolower($order_by_rating), ['asc', 'desc'])) {
            $orderClauses[] = "average_rating " . strtoupper($order_by_rating);
        }

        // Sắp xếp theo giá (ưu tiên giá khuyến mãi nếu có)
        if (!is_null($order_by_price) && in_array(strtolower($order_by_price), ['asc', 'desc'])) {
            $orderClauses[] = "min_price " . strtoupper($order_by_price);
        }


        // Nếu có điều kiện sắp xếp thì thêm vào câu SQL
        if (!empty($orderClauses)) {
            $sql .= " ORDER BY " . implode(', ', $orderClauses);
        }

        // Thêm phân trang
        $sql .= " LIMIT :limit OFFSET :offset";

        // Add limit and offset params
        $params['limit'] = $limit;
        $params['offset'] = $offset;

        // Thực thi truy vấn chính
        $result = $conn->query($sql, $params)->fetchAll();

        return [
            'count' => $totalCount,
            'products' => $result ?? []
        ];
    }

    // Lấy thông tin 1 sản phẩm
    public static function find($product_id) {
        $max_price_product = MAX_PRICE_PRODUCT;
        $conn = new ConnectDatabase();

        $sql = "
            SELECT
                p.id AS product_id,
                p.name,
                p.status,
                p.seller_id,
                p.qrcode,
                p.description,
                LEAST(MIN(pv.price), IFNULL(MIN(pv.promotion_price), $max_price_product)) AS min_price,
                GREATEST(MAX(pv.price), IFNULL(MAX(pv.promotion_price), 0)) AS max_price,
        
                (
                    SELECT 
                        pv2.price
                    FROM 
                        product_variants pv2
                    WHERE   
                        pv2.product_id = p.id
                        AND pv2.promotion_price = MIN(pv.promotion_price)
                    ORDER BY 
                        pv2.price ASC
                    LIMIT 
                        1
                ) AS price_from_min_price,
        
                SUM(pv.quantity) AS quantity,
                SUM(pv.sold_quantity) AS sold_quantity,
                ROUND(AVG(r.rating), 1) AS average_rating,
                COUNT(r.id) AS count_reviews,

                c.name AS category_name,

                pi.image_path,
                pi.default,

                pd.name AS detail_name,
                pd.description AS detail_description
            FROM 
                products p
                JOIN product_variants pv ON pv.product_id = p.id
                LEFT JOIN product_images pi ON pi.product_id = p.id 
                LEFT JOIN reviews r ON r.product_variant_id = pv.id
                LEFT JOIN categories c ON c.id = p.category_id
                LEFT JOIN product_details pd ON pd.product_id = p.id
            WHERE 
                p.id = :product_id
            GROUP BY
                p.id, p.name, p.status, p.seller_id, p.description, c.name,
                pi.image_path, pi.default,
                pd.name, pd.description
        ";

        $params = ['product_id' => $product_id];
        $result = $conn->query($sql, $params)->fetchAll();

        $dataConfig = [
            'keep_columns' => [
                'product_id',
                'name',
                'description',
                'qrcode',
                'status',
                'seller_id',
                'min_price',
                'max_price',
                'price_from_min_price',
                'quantity',
                'sold_quantity',
                'average_rating',
                'count_reviews',
                'category_name',
            ],
            'group_columns' => [
                'images' => ['image_path', 'default'],
                'details' => ['detail_name', 'detail_description'],
            ]
        ];

        $result = DataHelper::groupData($result, $dataConfig);

        // Lấy thông tin thuộc tính
        $sql = "
            SELECT
                pv.id AS product_variant_id,
                pv.price,
                pv.promotion_price,
                pv.quantity,
                pv.sold_quantity,

                pa.name,
                pav.value
            FROM
                product_variants pv
                LEFT JOIN product_variant_values pvt ON pvt.product_variant_id = pv.id
                LEFT JOIN product_attribute_values pav ON pav.id = pvt.product_attribute_value_id
                LEFT JOIN product_attributes pa ON pa.id = pav.product_attribute_id
            WHERE
                pv.product_id = :product_id
        ";

        $variants = $conn->query($sql, ['product_id' => $product_id])->fetchAll();

        $config = [
            'keep_columns' => [
                'product_variant_id',
                'price',
                'promotion_price',
                'quantity',
                'sold_quantity',
            ],
            'group_columns' => [
                'values' => ['name', 'value']
            ]
        ];

        $variants = DataHelper::groupData($variants, $config);


        if (count($variants) > 1) {
            $attributes = [];
            foreach ($variants as $variant) {
                foreach ($variant['values'] as $attribute) {
                    $name = $attribute['name'];
                    $value = $attribute['value'];

                    // Kiểm tra nếu tên thuộc tính đã có trong mảng attributes
                    if (!isset($attributes[$name])) {
                        $attributes[$name] = [];
                    }

                    // Thêm giá trị thuộc tính vào mảng nếu chưa có
                    if (!in_array($value, $attributes[$name])) {
                        $attributes[$name][] = $value;
                    }
                }
            }
            $result[0]['attributes'] = $attributes ?? [];
        } else {
            unset($variants[0]['values']);
        }

        $result[0]['variants'] = $variants ?? [];

        return $result[0] ?? null;
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

    // Tìm kiếm sản phẩm đơn giản
    public static function search($id) {
        $conn = new ConnectDatabase();

        $sql = "
            SELECT
                p.id AS product_id,
                p.name,
                p.description,
                p.status,
                p.qrcode,
                p.seller_id
            FROM
                products p
            WHERE
                p.id = :id
        ";

        return $conn->query($sql, ['id' => $id])->fetch() ?? null;
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

    // Lấy thông tin sản phẩm theo product_id và người bán
    public static function getByProductId2($product_id) {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                p.id AS product_id,
                p.name,
                p.description,
                p.status,
                p.seller_id,
                a.phone,
                s.store_name
            FROM
                products p
                JOIN sellers s ON s.id = p.seller_id
                JOIN accounts a ON a.id = s.account_id
            WHERE
                p.id = :product_id
        ";

        $result = $query->query($sql, ['product_id' => $product_id])->fetch();

        if ($result && isset($result['phone'])) {
            $result['phone'] = Hash::decodeAes($result['phone']);
        }

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
            'description' => $description ?? null,
            'product_id' => $product_id
        ]);

        return $result->rowCount() > 0 ? true : false;
    }

    // Khóa sản phảm
    public static function locked($product_id) {
        $conn = new ConnectDatabase();

        $sql = "
            UPDATE
                products
            SET
                status = :status
            WHERE    
                id = :product_id
        ";

        $result = $conn->query($sql, [
            'status' => 'locked',
            'product_id' => $product_id
        ]);

        return $result->rowCount() > 0 ? true : false;
    }

    // Mo khóa sản phảm
    public static function unlocked($product_id) {
        $conn = new ConnectDatabase();

        $sql = "
            UPDATE
                products
            SET
                status = :status
            WHERE    
                id = :product_id
                AND status = 'locked'
        ";

        $result = $conn->query($sql, [
            'status' => 'active',
            'product_id' => $product_id
        ]);

        return $result->rowCount() > 0 ? true : false;
    }

    // Cập nhật QR code
    public static function updateQrCode($product_id, $qrcode) {
        $conn = new ConnectDatabase();

        $sql = "
            UPDATE
                products
            SET
                qrcode = :qrcode
            WHERE    
                id = :product_id
        ";

        $result = $conn->query($sql, [
            'qrcode' => $qrcode ?? null,
            'product_id' => $product_id
        ]);

        return $result->rowCount() > 0 ? true : false;
    }
}
