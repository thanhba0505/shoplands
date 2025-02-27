<?php

require_once 'app/Models/ConnectDatabase.php';

class Product
{
    // Lấy danh sách thông tin sản phẩm
    public function getAll($limit = 12, $options = [])
    {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                p.id AS id,
                p.name AS name,
                p.description AS description,
                p.status AS status,
                p.seller_id AS seller_id
            FROM
                products p
            WHERE
                p.status = :status
            LIMIT 
                $limit
        ";

        $result = $query->query($sql, ['status' => 'active'])->fetchAll();

        return $result;
    }

    // Lấy danh sách thông tin sản phẩm theo các lựa chọn
    public function getAllByOptions($options = [], $limit = 12)
    {
        $defaultOptions = [
            'filter' => [],
            'arrange' => []
        ];

        $options = array_merge($defaultOptions, $options);
        $filter = $options['filter'];
        $arrange = $options['arrange'];

        $query = new ConnectDatabase();

        // ----------------------------LỌC
        // Giá trị mặc định
        $filterDefault = [
            'min_price' => null,
            'max_price' => null,
            'categories' => [],
            'ratings' => [],
            'search' => null
        ];
        $filter = array_merge($filterDefault, $filter);
        Console::log($filter);

        // Lấy giá trị từ bộ lọc
        $search = $filter['search'];
        $minPrice = $filter['min_price'];
        $maxPrice = $filter['max_price'];
        $categories = $filter['categories'];
        $ratings = $filter['ratings'];

        // Khởi tạo mảng params
        $params = ['status' => 'active'];

        // Xây dựng điều kiện tìm kiếm
        $searchCondition = Util::buildSearchCondition($search, $params);

        // Điều kiện WHERE
        $conditions = ["p.status = :status"];

        if (!empty($categories)) {
            $placeholders = [];
            foreach ($categories as $index => $category) {
                $key = ":category$index";
                $placeholders[] = $key;
                $params[$key] = $category;
            }
            $conditions[] = "c.id IN (" . implode(',', $placeholders) . ")";
        }

        if (!empty($searchCondition)) {
            $conditions[] = $searchCondition;
        }

        // Gộp tất cả điều kiện WHERE lại
        $sqlWhere = implode(" AND ", $conditions);

        // Điều kiện HAVING cho minPrice và maxPrice
        $havingConditions = [];

        if (!empty($minPrice)) {
            $havingConditions[] = "MIN(pv.price) >= :minPrice";
            $havingConditions[] = "MIN(COALESCE(pv.promotion_price, pv.price)) >= :minPrice";
            $params['minPrice'] = $minPrice;
        }

        if (!empty($maxPrice)) {
            $havingConditions[] = "MAX(pv.price) <= :maxPrice";
            $havingConditions[] = "MAX(COALESCE(pv.promotion_price, pv.price)) <= :maxPrice";
            $params['maxPrice'] = $maxPrice;
        }

        // Xử lý điều kiện rating
        if (!empty($ratings)) {
            $placeholders = [];
            foreach ($ratings as $index => $rating) {
                $key = ":rating$index";
                $placeholders[] = $key;
                $params[$key] = $rating;
            }
            $havingConditions[] = "FLOOR(ROUND(AVG(r.rating), 1)) IN (" . implode(',', $placeholders) . ")";
        }

        $sqlHaving = !empty($havingConditions) ? "HAVING " . implode(" AND ", $havingConditions) : "";


        // ---------------------------SẮP XẾP
        // Giá trị mặc định
        $arrangeDefault = [
            'top-seller' => null,
            'top-rated' => null,
            'price' => null
        ];
        $arrange = array_merge($arrangeDefault, $arrange);

        // Xây dựng điều kiện ORDER BY
        $orderByConditions = [];

        if (!empty($arrange['price'])) {
            $priceOrder = strtolower($arrange['price']) === 'desc' ? 'DESC' : 'ASC';
            $orderByConditions[] = "MIN(pv.price) $priceOrder";
        }

        if (!empty($arrange['top-rated'])) {
            $orderByConditions[] = "AVG(r.rating) DESC";
        }

        if (!empty($arrange['top-seller'])) {
            $orderByConditions[] = "SUM(pv.sold_quantity) DESC";
        }

        // Nếu có điều kiện sắp xếp, thêm vào SQL
        $sqlOrderBy = !empty($orderByConditions) ? "ORDER BY " . implode(", ", $orderByConditions) : "";


        // SQL Query
        $sql = "
            SELECT DISTINCT
                p.id AS id,
                p.name AS name,
                p.description AS description,
                p.status AS status,
                p.seller_id AS seller_id
            FROM
                products p
                JOIN product_variants pv ON pv.product_id = p.id
                LEFT JOIN categories c ON c.id = p.category_id
                LEFT JOIN reviews r ON r.product_variant_id = pv.id
            WHERE
                $sqlWhere
            GROUP BY
                p.id
            $sqlHaving
            $sqlOrderBy
            LIMIT 
                $limit
        ";

        return $query->query($sql, $params)->fetchAll();
    }




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
