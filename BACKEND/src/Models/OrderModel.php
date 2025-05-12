<?php

namespace App\Models;

use App\Helpers\Carbon;
use App\Helpers\DataHelper;
use App\Helpers\Format;
use App\Helpers\Response;
use App\Models\ConnectDatabase;

class OrderModel {
    // Lấy danh sach đơn hang theo seller id
    public static function getBySellerId($seller_id, $status = [], $limit = 12, $page = 0) {
        $query = new ConnectDatabase();

        $offset = ($page) * $limit;

        $status = array_filter($status, function ($value) {
            return $value !== "unpaid";
        });

        // Base SQL for counting total records
        $countSql = "
            SELECT
                COUNT(DISTINCT o.id) as total_count
            FROM
                orders o
                JOIN addresses af ON o.from_address_id = af.id
                JOIN addresses at ON o.to_address_id = at.id
                JOIN users u ON o.user_id = u.id
                JOIN sellers s ON o.seller_id = s.id
                JOIN order_items oi ON o.id = oi.order_id
                JOIN product_variants pv ON oi.product_variant_id = pv.id
                JOIN products p ON pv.product_id = p.id
                LEFT JOIN product_images pi ON pi.product_id = p.id
            WHERE
                o.seller_id = :seller_id
                AND o.deleted_at IS NULL
                AND pi.default = 1
        ";

        // Xây dựng câu lệnh SQL cơ bản
        $sql = "
            SELECT
                o.id AS order_id,
                o.subtotal_price,
                o.shipping_fee,
                o.discount,
                o.final_price,
                o.revenue,
                o.paid,
                o.vnp_txnref,
                o.vnp_url,
                o.vnp_created_at,
                o.created_at,
                o.ghn_order_code,
                o.current_status,
                o.current_status_name,
                o.seller_id,
                o.user_id,

                u.name,
                u.avatar,

                s.store_name AS store_name,  
                s.logo AS logo,

                af.province_name AS from_province_name,
                af.address_line AS from_address_line,

                at.province_name AS to_province_name,
                at.address_line AS to_address_line,

                oi.id AS order_item_id,
                oi.product_variant_id,
                oi.quantity,
                oi.price,

                pi.image_path AS image,

                p.id AS product_id,
                p.name AS product_name
            FROM
                orders o
                JOIN addresses af ON o.from_address_id = af.id
                JOIN addresses at ON o.to_address_id = at.id
                JOIN users u ON o.user_id = u.id
                JOIN sellers s ON o.seller_id = s.id
                JOIN order_items oi ON o.id = oi.order_id
                JOIN product_variants pv ON oi.product_variant_id = pv.id
                JOIN products p ON pv.product_id = p.id
                LEFT JOIN product_images pi ON pi.product_id = p.id

            WHERE
                o.seller_id = :seller_id
                AND o.deleted_at IS NULL
                AND pi.default = 1
        ";

        // Build params for the query
        $params = [
            'seller_id' => $seller_id
        ];

        // Nếu có mảng trạng thái, thêm điều kiện AND với IN vào câu lệnh SQL
        if (!empty($status)) {
            $statusPlaceholders = implode(',', array_map(function ($key) {
                return ":status" . $key;  // Tạo tham số có tên cho mảng trạng thái
            }, array_keys($status)));

            $sql .= " AND o.current_status IN ($statusPlaceholders)";
            $countSql .= " AND o.current_status IN ($statusPlaceholders)";

            // Add status parameters
            foreach ($status as $key => $value) {
                $params["status" . $key] = $value;
            }
        } else {
            $sql .= " AND o.current_status != 'unpaid'";
            $countSql .= " AND o.current_status != 'unpaid'";
        }

        // Get total count before pagination
        $totalCount = $query->query($countSql, $params)->fetch();
        $count = $totalCount['total_count'] ?? 0;

        // Add pagination parameters
        $params['limit'] = $limit;
        $params['offset'] = $offset;

        // Thêm các điều kiện sắp xếp và phân trang
        $sql .= "
            ORDER BY
                o.created_at DESC
            LIMIT
                :limit OFFSET :offset
        ";

        // Thực thi câu lệnh SQL và lấy kết quả
        $result = $query->query($sql, $params)->fetchAll();

        if (!empty($result)) {
            $config = [
                'keep_columns' => [
                    'order_id',
                    'subtotal_price',
                    'shipping_fee',
                    'discount',
                    'final_price',
                    'revenue',
                    'paid',
                    'vnp_txnref',
                    'vnp_url',
                    'vnp_created_at',
                    'created_at',
                    'ghn_order_code',
                    'current_status',
                    'current_status_name',
                    'seller_id',
                    'user_id'
                ],
                'group_columns' => [
                    'user' => [
                        'name',
                        'avatar'
                    ],
                    'seller' => [
                        'store_name',
                        'logo'
                    ],
                    'from_address' => [
                        'from_province_name',
                        'from_address_line'
                    ],
                    'to_address' => [
                        'to_province_name',
                        'to_address_line'
                    ],
                    'order_items' => [
                        'order_item_id',
                        'order_id',
                        'product_variant_id',
                        'quantity',
                        'price',
                        'attributes',
                        'product_name',
                        'product_id',
                        'image'
                    ]
                ]
            ];

            $result = DataHelper::groupData($result, $config);

            $orderIds = [];

            foreach ($result as $key => $value) {
                $result[$key]['user'] = $value['user'][0];
                $result[$key]['seller'] = $value['seller'][0];
                $result[$key]['from_address'] = $value['from_address'][0];
                $result[$key]['to_address'] = $value['to_address'][0];
                $orderIds[] = $value['order_id'];
            }

            if (!empty($orderIds)) {
                $orderIdsString = "('" . implode("', '", $orderIds) . "')";

                // Lấy thuộc tính
                $sql = "
                    SELECT DISTINCT
                        pv.id AS product_variant_id,
                        pa.name,
                        pav.value
                    FROM
                        product_variants pv
                        LEFT JOIN product_variant_values pvv ON pvv.product_variant_id = pv.id
                        JOIN product_attribute_values pav ON pav.id = pvv.product_attribute_value_id
                        JOIN product_attributes pa ON pa.id = pav.product_attribute_id
                        JOIN order_items oi ON oi.product_variant_id = pv.id
                        JOIN orders o ON o.id = oi.order_id
                    WHERE
                        o.id IN $orderIdsString
                ";

                $result_variants = $query->query($sql, [])->fetchAll();

                foreach ($result as $key => $value) {
                    foreach ($value['order_items'] as $key2 => $order_item) {
                        $attributes = [];
                        foreach ($result_variants as $result_variant) {
                            if ($result_variant['product_variant_id'] === $order_item['product_variant_id']) {
                                $attributes[] = [
                                    'name' => $result_variant['name'],
                                    'value' => $result_variant['value']
                                ];
                            }
                        }

                        $result[$key]['order_items'][$key2]['attributes'] = $attributes;
                    }
                }
            }
        }

        // Return data with total count
        return [
            'count' => $count,
            'orders' => $result,
        ];
    }

    // Láy danh sách đơn hàng theo userid
    public static function getByUserId($user_id, $status = [], $limit = 12, $page = 0) {
        $query = new ConnectDatabase();

        $offset = ($page) * $limit;

        // Base SQL for counting total records
        $countSql = "
            SELECT
                COUNT(DISTINCT o.id) as total_count
            FROM
                orders o
                JOIN addresses af ON o.from_address_id = af.id
                JOIN addresses at ON o.to_address_id = at.id
                JOIN users u ON o.user_id = u.id
                JOIN sellers s ON o.seller_id = s.id
                JOIN order_items oi ON o.id = oi.order_id
                JOIN product_variants pv ON oi.product_variant_id = pv.id
                JOIN products p ON pv.product_id = p.id
                LEFT JOIN product_images pi ON pi.product_id = p.id
            WHERE
                o.user_id = :user_id
                AND o.deleted_at IS NULL
                AND pi.default = 1
        ";

        // Xây dựng câu lệnh SQL cơ bản
        $sql = "
            SELECT
                o.id AS order_id,
                o.subtotal_price,
                o.shipping_fee,
                o.discount,
                o.final_price,
                o.revenue,
                o.paid,
                o.vnp_txnref,
                o.vnp_url,
                o.vnp_created_at,
                o.created_at,
                o.ghn_order_code,
                o.current_status,
                o.current_status_name,
                o.seller_id,
                o.user_id,

                u.name,
                u.avatar,

                s.store_name AS store_name,  
                s.logo AS logo,

                af.province_name AS from_province_name,
                af.address_line AS from_address_line,

                at.province_name AS to_province_name,
                at.address_line AS to_address_line,

                oi.id AS order_item_id,
                oi.product_variant_id,
                oi.quantity,
                oi.price,

                pi.image_path AS image,

                p.id AS product_id,
                p.name AS product_name
            FROM
                orders o
                JOIN addresses af ON o.from_address_id = af.id
                JOIN addresses at ON o.to_address_id = at.id
                JOIN users u ON o.user_id = u.id
                JOIN sellers s ON o.seller_id = s.id
                JOIN order_items oi ON o.id = oi.order_id
                JOIN product_variants pv ON oi.product_variant_id = pv.id
                JOIN products p ON pv.product_id = p.id
                LEFT JOIN product_images pi ON pi.product_id = p.id

            WHERE
                o.user_id = :user_id
                AND o.deleted_at IS NULL
                AND pi.default = 1
        ";

        // Build params for the query
        $params = [
            'user_id' => $user_id
        ];

        // Nếu có mảng trạng thái, thêm điều kiện AND với IN vào câu lệnh SQL
        if (!empty($status)) {
            $statusPlaceholders = implode(',', array_map(function ($key) {
                return ":status" . $key;  // Tạo tham số có tên cho mảng trạng thái
            }, array_keys($status)));

            $sql .= " AND o.current_status IN ($statusPlaceholders)";
            $countSql .= " AND o.current_status IN ($statusPlaceholders)";

            // Add status parameters
            foreach ($status as $key => $value) {
                $params["status" . $key] = $value;
            }
        }

        // Get total count before pagination
        $totalCount = $query->query($countSql, $params)->fetch();
        $count = $totalCount['total_count'] ?? 0;

        // Add pagination parameters
        $params['limit'] = $limit;
        $params['offset'] = $offset;

        // Thêm các điều kiện sắp xếp và phân trang
        $sql .= "
            ORDER BY
                o.created_at DESC
            LIMIT
                :limit OFFSET :offset
        ";

        // Thực thi câu lệnh SQL và lấy kết quả
        $result = $query->query($sql, $params)->fetchAll();

        if (!empty($result)) {
            $config = [
                'keep_columns' => [
                    'order_id',
                    'subtotal_price',
                    'shipping_fee',
                    'discount',
                    'final_price',
                    'revenue',
                    'paid',
                    'vnp_txnref',
                    'vnp_url',
                    'vnp_created_at',
                    'created_at',
                    'ghn_order_code',
                    'current_status',
                    'current_status_name',
                    'seller_id',
                    'user_id'
                ],
                'group_columns' => [
                    'user' => [
                        'name',
                        'avatar'
                    ],
                    'seller' => [
                        'store_name',
                        'logo'
                    ],
                    'from_address' => [
                        'from_province_name',
                        'from_address_line'
                    ],
                    'to_address' => [
                        'to_province_name',
                        'to_address_line'
                    ],
                    'order_items' => [
                        'order_item_id',
                        'order_id',
                        'product_variant_id',
                        'quantity',
                        'price',
                        'attributes',
                        'product_name',
                        'product_id',
                        'image'
                    ]
                ]
            ];

            $result = DataHelper::groupData($result, $config);

            $orderIds = [];

            foreach ($result as $key => $value) {
                $result[$key]['user'] = $value['user'][0];
                $result[$key]['seller'] = $value['seller'][0];
                $result[$key]['from_address'] = $value['from_address'][0];
                $result[$key]['to_address'] = $value['to_address'][0];
                $orderIds[] = $value['order_id'];
            }

            if (!empty($orderIds)) {
                $orderIdsString = "('" . implode("', '", $orderIds) . "')";

                // Lấy thuộc tính
                $sql = "
                    SELECT DISTINCT
                        pv.id AS product_variant_id,
                        pa.name,
                        pav.value
                    FROM
                        product_variants pv
                        LEFT JOIN product_variant_values pvv ON pvv.product_variant_id = pv.id
                        JOIN product_attribute_values pav ON pav.id = pvv.product_attribute_value_id
                        JOIN product_attributes pa ON pa.id = pav.product_attribute_id
                        JOIN order_items oi ON oi.product_variant_id = pv.id
                        JOIN orders o ON o.id = oi.order_id
                    WHERE
                        o.id IN $orderIdsString
                ";

                $result_variants = $query->query($sql, [])->fetchAll();

                foreach ($result as $key => $value) {
                    foreach ($value['order_items'] as $key2 => $order_item) {
                        $attributes = [];
                        foreach ($result_variants as $result_variant) {
                            if ($result_variant['product_variant_id'] === $order_item['product_variant_id']) {
                                $attributes[] = [
                                    'name' => $result_variant['name'],
                                    'value' => $result_variant['value']
                                ];
                            }
                        }

                        $result[$key]['order_items'][$key2]['attributes'] = $attributes;
                    }
                }
            }
        }

        // Return data with total count
        return [
            'count' => $count,
            'orders' => $result,
        ];
    }

    // Tìm đơn hàng theo order_id và user_id
    public static function findByUserIdAndOrderId($user_id, $order_id) {
        $query = new ConnectDatabase();

        // Xây dựng câu lệnh SQL cơ bản
        $sql = "
            SELECT
                o.id AS order_id,
                o.subtotal_price,
                o.shipping_fee,
                o.discount,
                o.final_price,
                o.revenue,
                o.paid,
                o.vnp_txnref,
                o.vnp_url,
                o.vnp_created_at,
                o.created_at,
                o.ghn_order_code,
                o.current_status,
                o.current_status_name,
                o.seller_id,
                o.user_id,

                u.name,
                u.avatar,

                s.store_name AS store_name,  
                s.logo AS logo,

                af.province_name AS from_province_name,
                af.address_line AS from_address_line,

                at.province_name AS to_province_name,
                at.address_line AS to_address_line,

                oi.id AS order_item_id,
                oi.product_variant_id,
                oi.quantity,
                oi.price,

                pi.image_path AS image,

                p.id AS product_id,
                p.name AS product_name
            FROM
                orders o
                JOIN addresses af ON o.from_address_id = af.id
                JOIN addresses at ON o.to_address_id = at.id
                JOIN users u ON o.user_id = u.id
                JOIN sellers s ON o.seller_id = s.id
                JOIN order_items oi ON o.id = oi.order_id
                JOIN product_variants pv ON oi.product_variant_id = pv.id
                JOIN products p ON pv.product_id = p.id
                LEFT JOIN product_images pi ON pi.product_id = p.id
            WHERE
                o.user_id = :user_id
                AND o.id = :order_id
                AND o.deleted_at IS NULL
                AND pi.default = 1
        ";

        // Build params for the query
        $params = [
            'user_id' => $user_id,
            'order_id' => $order_id
        ];

        // Thực thi câu lệnh SQL và lấy kết quả
        $result = $query->query($sql, $params)->fetchAll();

        $data = null;

        if (!empty($result)) {
            $config = [
                'keep_columns' => [
                    'order_id',
                    'subtotal_price',
                    'shipping_fee',
                    'discount',
                    'final_price',
                    'revenue',
                    'paid',
                    'vnp_txnref',
                    'vnp_url',
                    'vnp_created_at',
                    'created_at',
                    'ghn_order_code',
                    'current_status',
                    'current_status_name',
                    'seller_id',
                    'user_id'
                ],
                'group_columns' => [
                    'user' => [
                        'name',
                        'avatar'
                    ],
                    'seller' => [
                        'store_name',
                        'logo'
                    ],
                    'from_address' => [
                        'from_province_name',
                        'from_address_line'
                    ],
                    'to_address' => [
                        'to_province_name',
                        'to_address_line'
                    ],
                    'order_items' => [
                        'order_item_id',
                        'order_id',
                        'product_variant_id',
                        'quantity',
                        'price',
                        'attributes',
                        'product_name',
                        'product_id',
                        'image'
                    ]
                ]
            ];

            $result = DataHelper::groupData($result, $config);

            if (isset($result[0])) {
                $data = $result[0];
                $data['user'] = $data['user'][0];
                $data['seller'] = $data['seller'][0];
                $data['from_address'] = $data['from_address'][0];
                $data['to_address'] = $data['to_address'][0];

                // Lấy thuộc tính cho các sản phẩm trong đơn hàng
                $sql = "
                    SELECT DISTINCT
                        pv.id AS product_variant_id,
                        pa.name,
                        pav.value
                    FROM
                        product_variants pv
                        LEFT JOIN product_variant_values pvv ON pvv.product_variant_id = pv.id
                        JOIN product_attribute_values pav ON pav.id = pvv.product_attribute_value_id
                        JOIN product_attributes pa ON pa.id = pav.product_attribute_id
                        JOIN order_items oi ON oi.product_variant_id = pv.id
                        JOIN orders o ON o.id = oi.order_id
                    WHERE
                        o.id = :order_id
                ";

                $result_variants = $query->query($sql, ['order_id' => $order_id])->fetchAll();

                foreach ($data['order_items'] as $key => $order_item) {
                    $attributes = [];
                    foreach ($result_variants as $result_variant) {
                        if ($result_variant['product_variant_id'] === $order_item['product_variant_id']) {
                            $attributes[] = [
                                'name' => $result_variant['name'],
                                'value' => $result_variant['value']
                            ];
                        }
                    }

                    $data['order_items'][$key]['attributes'] = $attributes;
                }
            }
        }

        return $data;
    }

    // Tạo đơn hàng
    public static function add($seller_id, $user_id, $from_address_id, $to_address_id, $shipping_fee, $subtotal_price, $discount, $final_price, $revenue, $coupon_id = null) {
        $query = new ConnectDatabase();

        $created_at = Carbon::now();

        $sql =  "
            INSERT INTO
                orders (seller_id, user_id, from_address_id, to_address_id, shipping_fee, subtotal_price, discount, final_price, revenue, coupon_id, created_at, current_status, current_status_name)
            VALUES
                (:seller_id, :user_id, :from_address_id, :to_address_id, :shipping_fee, :subtotal_price, :discount, :final_price, :revenue, :coupon_id, :created_at, :current_status, :current_status_name)
        ";

        $query->query($sql, [
            'seller_id' => $seller_id,
            'user_id' => $user_id,
            'from_address_id' => $from_address_id,
            'to_address_id' => $to_address_id,
            'shipping_fee' => $shipping_fee,
            'subtotal_price' => $subtotal_price,
            'discount' => $discount,
            'final_price' => $final_price,
            'revenue' => $revenue,
            'coupon_id' => $coupon_id,
            'created_at' => $created_at,
            'current_status' => "unpaid",
            'current_status_name' => Format::getOrderStatusInVie("unpaid")
        ]);

        $orderId = $query->getConnection()->lastInsertId();

        return $orderId > 0 ? $orderId : $orderId;
    }

    // Tìm đơn hàng theo ghn_order_code
    public static function findByGhnOrderCode($ghn_order_code) {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                o.id AS order_id,
                o.subtotal_price,
                o.shipping_fee,
                o.discount,
                o.final_price,
                o.revenue,
                o.paid,
                o.vnp_txnref,
                o.vnp_url,
                o.vnp_created_at,
                o.created_at,
                o.ghn_order_code,
                o.current_status,
                o.current_status_name,
                o.from_address_id,
                o.to_address_id,
                o.seller_id,
                o.user_id,
                o.coupon_id
            FROM
                orders o
            WHERE
                o.ghn_order_code = :ghn_order_code
                AND o.deleted_at IS NULL
        ";

        $result = $query->query($sql, [
            'ghn_order_code' => $ghn_order_code
        ]);

        return $result->fetch();
    }

    // Cập nhật ghn_order_code
    public static function updateGhnOrderCode($orderId, $ghn_order_code) {
        $query = new ConnectDatabase();

        $sql = "
            UPDATE
                orders
            SET
                ghn_order_code = :ghn_order_code
            WHERE
                id = :orderId
        ";

        $result = $query->query($sql, [
            'ghn_order_code' => $ghn_order_code,
            'orderId' => $orderId
        ]);

        return $result;
    }

    // Cập nhật trạng thái
    public static function updateStatus($orderId, $status) {
        $query = new ConnectDatabase();

        $sql = "
            UPDATE
                orders
            SET
                current_status = :status,
                current_status_name = :statusName
            WHERE
                id = :orderId
        ";

        $result = $query->query($sql, [
            'status' => $status,
            'statusName' => Format::getOrderStatusInVie($status),
            'orderId' => $orderId
        ]);

        return $result;
    }

    // Xóa đơn hàng
    public static function delete($orderId) {
        $query = new ConnectDatabase();

        $sql = "
            UPDATE
                orders
            SET
                deleted_at = :deleted_at,
                current_status = :current_status,
                current_status_name = :current_status_name
            WHERE
                id = :orderId
        ";

        $result = $query->query($sql, [
            'deleted_at' => Carbon::now(),
            'current_status' => "deleted",
            'current_status_name' => Format::getOrderStatusInVie("deleted"),
            'orderId' => $orderId
        ]);

        return $result;
    }

    // Lưu link thanh toán 
    public static function updateVnpTxnRef($orderId, $vnp_TxnRef, $vnp_Url) {
        $query = new ConnectDatabase();

        $sql = "
            UPDATE
                orders
            SET
                vnp_txnref = :vnp_TxnRef,
                vnp_url = :vnp_Url,
                vnp_created_at = :vnp_CreatedAt
            WHERE
                id = :orderId
        ";

        $result = $query->query($sql, [
            'vnp_TxnRef' => $vnp_TxnRef,
            'orderId' => $orderId,
            'vnp_Url' => $vnp_Url,
            'vnp_CreatedAt' => Carbon::now()
        ])->rowCount();

        return $result > 0 ? true : false;
    }

    // Tìm kiếm đơn hàng theo vnp_TxnRef
    public static function findByVnpTxnRef($vnp_TxnRef) {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                o.id AS order_id,
                o.seller_id,
                o.user_id,
                o.from_address_id,
                o.to_address_id,
                o.paid
            FROM
                orders o
            WHERE
                o.vnp_txnref = :vnp_TxnRef
                AND o.deleted_at IS NULL
        ";

        $result = $query->query($sql, [
            'vnp_TxnRef' => $vnp_TxnRef
        ])->fetch();

        return $result;
    }

    // Tìm đơn hàng theo order_id và user id
    public static function findByOrderIdAndUserId($orderId, $userId) {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                o.id AS order_id,
                o.subtotal_price,
                o.shipping_fee,
                o.discount,
                o.final_price,
                o.revenue,
                o.paid,
                o.vnp_txnref,
                o.vnp_url,
                o.vnp_created_at,
                o.created_at,
                o.ghn_order_code,
                o.current_status,
                o.current_status_name,
                o.from_address_id,
                o.to_address_id,
                o.seller_id,
                o.user_id,
                o.coupon_id
            FROM
                orders o
            WHERE
                o.id = :orderId
                AND o.user_id = :userId
                AND o.deleted_at IS NULL
        ";

        $result = $query->query($sql, [
            'orderId' => $orderId,
            'userId' => $userId
        ])->fetch();

        return $result;
    }

    // Tìm đơn hàng theo order_id
    public static function find($orderId) {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                o.id AS order_id,
                o.subtotal_price,
                o.shipping_fee,
                o.discount,
                o.final_price,
                o.revenue,
                o.paid,
                o.vnp_txnref,
                o.vnp_url,
                o.vnp_created_at,
                o.created_at,
                o.ghn_order_code,
                o.current_status,
                o.current_status_name,
                o.from_address_id,
                o.to_address_id,
                o.seller_id,
                o.user_id,
                o.coupon_id
            FROM
                orders o
            WHERE
                o.id = :orderId
                AND o.deleted_at IS NULL
        ";

        $result = $query->query($sql, [
            'orderId' => $orderId
        ])->fetch();

        return $result;
    }

    // Cập nhật thanh toán theo id và user id
    public static function updatePaid($orderId, $paid) {
        $query = new ConnectDatabase();

        $sql = "
            UPDATE
                orders
            SET
                paid = :paid
            WHERE
                id = :orderId
        ";

        $result = $query->query($sql, [
            'paid' => $paid,
            'orderId' => $orderId
        ]);

        return $result;
    }

    // Lấy tổng số đơn hàng theo user id
    public static function countByUserId($user_id, $status = []) {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                COUNT(*) AS total
            FROM
                orders o
            WHERE
                o.user_id = :user_id
                AND o.deleted_at IS NULL
        ";

        // Nếu có mảng trạng thái, thay đổi điều kiện để sử dụng IN với named parameters
        if (!empty($status)) {
            $sql .= " AND o.current_status IN (" . implode(',', array_map(function ($key) {
                return ":status" . $key;
            }, array_keys($status))) . ")";
        }

        // Xây dựng tham số cho câu lệnh SQL
        $params = [
            'user_id' => $user_id
        ];

        // Nếu có trạng thái, thêm các trạng thái vào mảng params với named parameters
        if (!empty($status)) {
            foreach ($status as $key => $value) {
                $params["status" . $key] = $value;
            }
        }

        // Thực thi câu lệnh SQL và lấy kết quả
        $result = $query->query($sql, $params)->fetch();

        // Trả về số lượng đơn hàng hoặc 0 nếu không có kết quả
        return $result['total'] ?? 0;
    }

    // Lấy tổng số đơn hàng theo seller id
    public static function countBySellerId($seller_id, $status = []) {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                COUNT(*) AS total
            FROM
                orders o
            WHERE
                o.seller_id = :seller_id
                AND o.deleted_at IS NULL
        ";

        // Nếu có mảng trạng thái, thay đổi điều kiện để sử dụng IN với named parameters
        if (!empty($status)) {
            $sql .= " AND o.current_status IN (" . implode(',', array_map(function ($key) {
                return ":status" . $key;
            }, array_keys($status))) . ")";
        }

        // Xây dựng tham số cho câu lệnh SQL
        $params = [
            'seller_id' => $seller_id
        ];

        // Nếu có trạng thái, thêm các trạng thái vào mảng params với named parameters
        if (!empty($status)) {
            foreach ($status as $key => $value) {
                $params["status" . $key] = $value;
            }
        }

        // Thực thi câu lệnh SQL và lấy kết quả
        $result = $query->query($sql, $params)->fetch();

        // Trả về số lượng đơn hàng hoặc 0 nếu không có kết quả
        return $result['total'] ?? 0;
    }

    // Tìm đơn hàng theo order_id và seller_id
    public static function findByOrderIdAndSellerId($orderId, $sellerId) {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                o.id AS order_id,
                o.subtotal_price,
                o.shipping_fee,
                o.discount,
                o.final_price,
                o.revenue,
                o.paid,
                o.vnp_txnref,
                o.vnp_url,
                o.vnp_created_at,
                o.created_at,
                o.ghn_order_code,
                o.current_status,
                o.current_status_name,
                o.from_address_id,
                o.to_address_id,
                o.seller_id,
                o.user_id,
                o.coupon_id
            FROM
                orders o
            WHERE
                o.id = :orderId
                AND o.seller_id = :sellerId
                AND o.deleted_at IS NULL
        ";

        $result = $query->query($sql, [
            'orderId' => $orderId,
            'sellerId' => $sellerId
        ])->fetch();

        return $result;
    }

    // Lây danh sách đơn hàng đã có vận chuyển
    public static function getDeliveredOrders() {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                o.id AS order_id,
                o.ghn_order_code,
                o.current_status
            FROM
                orders o
            WHERE
                o.ghn_order_code IS NOT NULL
                AND o.deleted_at IS NULL
        ";

        $result = $query->query($sql, [])->fetchAll();

        return $result;
    }

    public static function findByUserIdOrderIdAndOrderItemId(
        $user_id,
        $order_id,
        $order_item_id
    ) {
        $conn = new ConnectDatabase();

        $sql = "
            SELECT
                o.id AS order_id,
                u.id AS user_id,
                pv.id AS product_variant_id,
                r.id AS review_id
            FROM
                orders o
                JOIN order_items oi ON o.id = oi.order_id
                JOIN users u ON o.user_id = u.id
                JOIN product_variants pv ON oi.product_variant_id = pv.id
                LEFT JOIN reviews r ON pv.id = r.product_variant_id
            WHERE
                o.id = :order_id
                AND u.id = :user_id
                AND oi.id = :order_item_id
                AND o.current_status = 'completed'
        ";

        $result = $conn->query($sql, [
            'order_id' => $order_id,
            'user_id' => $user_id,
            'order_item_id' => $order_item_id
        ])->fetch();

        return $result;
    }
}
