<?php

namespace App\Models;

use App\Helpers\Carbon;
use App\Helpers\Format;
use App\Helpers\Response;
use App\Models\ConnectDatabase;

class OrderModel {
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

    // Lưu link thanh toán 
    public static function updateVnpTxnRef($orderId, $vnp_TxnRef, $vnp_Url) {
        $query = new ConnectDatabase();

        $sql = "
            UPDATE
                orders
            SET
                vnp_txnref = :vnp_TxnRef,
                vnp_url = :vnp_Url
            WHERE
                id = :orderId
        ";

        $result = $query->query($sql, [
            'vnp_TxnRef' => $vnp_TxnRef,
            'orderId' => $orderId,
            'vnp_Url' => $vnp_Url
        ])->rowCount();

        return $result > 0 ? true : false;
    }

    // Tìm kiếm đơn hàng theo  vnp_TxnRef
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

    // Lấy danh sach đơn hang theo user id
    public static function getByUserId($user_id, $status = [], $limit = 12, $page = 0) {
        $query = new ConnectDatabase();

        $offset = ($page) * $limit;

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
                o.user_id = :user_id
        ";

        // Nếu có mảng trạng thái, thêm điều kiện AND với IN vào câu lệnh SQL
        if (!empty($status)) {
            $statusPlaceholders = implode(',', array_map(function ($key) {
                return ":status" . $key;  // Tạo tham số có tên cho mảng trạng thái
            }, array_keys($status)));

            $sql .= " AND o.current_status IN ($statusPlaceholders)";
        }

        // Thêm các điều kiện sắp xếp và phân trang
        $sql .= "
            ORDER BY
                o.created_at DESC
            LIMIT
                :limit OFFSET :offset
        ";

        // Xây dựng các tham số cho câu lệnh SQL
        $params = [
            'user_id' => $user_id,
            'limit' => $limit,
            'offset' => $offset
        ];

        // Nếu có trạng thái, thêm các trạng thái vào mảng params
        if (!empty($status)) {
            foreach ($status as $key => $value) {
                $params["status" . $key] = $value; // Thêm các trạng thái vào params với tên tham số
            }
        }

        // Thực thi câu lệnh SQL và lấy kết quả
        $result = $query->query($sql, $params)->fetchAll();

        // Trả về kết quả hoặc mảng rỗng nếu không có kết quả
        return $result ?? [];
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

    // Lấy danh sach đơn hang theo seller id
    public static function getBySellerId($seller_id, $status = [], $limit = 12, $page = 0) {
        $query = new ConnectDatabase();

        $offset = ($page) * $limit;

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
                o.seller_id = :seller_id
        ";

        // Nếu có mảng trạng thái, thêm điều kiện AND với IN vào câu lệnh SQL
        if (!empty($status)) {
            $statusPlaceholders = implode(',', array_map(function ($key) {
                return ":status" . $key;  // Tạo tham số có tên cho mảng trạng thái
            }, array_keys($status)));

            $sql .= " AND o.current_status IN ($statusPlaceholders)";
        }

        // Thêm các điều kiện sắp xếp và phân trang
        $sql .= "
            ORDER BY
                o.created_at DESC
            LIMIT
                :limit OFFSET :offset
        ";

        // Xây dựng các tham số cho câu lệnh SQL
        $params = [
            'seller_id' => $seller_id,
            'limit' => $limit,
            'offset' => $offset
        ];

        // Nếu có trạng thái, thêm các trạng thái vào mảng params
        if (!empty($status)) {
            foreach ($status as $key => $value) {
                $params["status" . $key] = $value; // Thêm các trạng thái vào params với tên tham số
            }
        }

        // Thực thi câu lệnh SQL và lấy kết quả
        $result = $query->query($sql, $params)->fetchAll();

        // Trả về kết quả hoặc mảng rỗng nếu không có kết quả
        return $result ?? [];
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
        ";

        $result = $query->query($sql, [
            'orderId' => $orderId,
            'sellerId' => $sellerId
        ])->fetch();

        return $result;
    }



















    // // Lấy danh sách đơn hàng theo selelr id theo trang thai
    // public static function getBySellerId($seller_id, $status = "all", $limit = 12, $page = 1) {
    //     $query = new ConnectDatabase();

    //     $status = $status ?? "all";

    //     // Tính toán OFFSET
    //     $offset = ($page - 1) * $limit;

    //     // Nếu status là "all", không cần điều kiện về trạng thái
    //     $statusCondition = ($status === "all") ? "" : "AND os.status = :status";

    //     // Câu truy vấn với subquery để lấy trạng thái cuối cùng (last status) của mỗi đơn hàng
    //     $sql = "
    //         SELECT
    //             o.id AS order_id,
    //             o.seller_id,
    //             o.user_id,
    //             o.from_address_id,
    //             o.to_address_id,
    //             o.shipping_fee_id,
    //             o.subtotal_price,
    //             o.discount,
    //             o.final_price,
    //             o.paid,
    //             o.revenue,
    //             o.cancel_reason,
    //             o.coupon_id,
    //             o.created_at
    //         FROM
    //             orders o
    //             JOIN (
    //                 SELECT order_id, status
    //                 FROM order_status
    //                 WHERE (order_id, created_at) IN (
    //                     SELECT order_id, MAX(created_at) FROM order_status GROUP BY order_id
    //                 )
    //             ) os ON os.order_id = o.id
    //         WHERE
    //             o.seller_id = :seller_id
    //             $statusCondition
    //         ORDER BY
    //             o.created_at DESC
    //         LIMIT
    //             :limit OFFSET :offset
    //     ";

    //     // Thực hiện truy vấn
    //     $params = [
    //         'seller_id' => $seller_id,
    //         'limit' => $limit,
    //         'offset' => $offset
    //     ];

    //     // Nếu status không phải "all", thêm tham số status vào query
    //     if ($status !== "all") {
    //         $params['status'] = $status;
    //     }

    //     $result = $query->query($sql, $params)->fetchAll();

    //     return $result ?? [];
    // }

    // // Lấy danh 1 đơn hàng theo order_id
    // public static function findByOrderIdAndSellerId($order_id, $seller_id) {
    //     $query = new ConnectDatabase();

    //     $sql = "
    //         SELECT
    //             o.id AS order_id,
    //             o.seller_id,
    //             o.user_id,
    //             o.from_address_id,
    //             o.to_address_id,
    //             o.shipping_fee_id,
    //             o.subtotal_price,
    //             o.discount,
    //             o.final_price,
    //             o.paid,
    //             o.revenue,
    //             o.cancel_reason,
    //             o.coupon_id,
    //             o.created_at
    //         FROM
    //             orders o
    //             JOIN (
    //                 SELECT order_id, status
    //                 FROM order_status
    //                 WHERE (order_id, created_at) IN (
    //                     SELECT order_id, MAX(created_at) FROM order_status GROUP BY order_id
    //                 )
    //             ) os ON os.order_id = o.id
    //         WHERE
    //             o.id = :order_id
    //             AND o.seller_id = :seller_id
    //         ORDER BY
    //             o.created_at DESC
    //     ";

    //     $result = $query->query($sql, ['order_id' => $order_id, 'seller_id' => $seller_id])->fetch();

    //     return $result ?? [];
    // }

    // // Lấy danh 1 đơn hàng theo order_id
    // public static function findByOrderIdAndUserId($order_id, $user_id) {
    //     $query = new ConnectDatabase();

    //     $sql = "
    //         SELECT
    //             o.id AS order_id,
    //             o.seller_id,
    //             o.user_id,
    //             o.from_address_id,
    //             o.to_address_id,
    //             o.shipping_fee_id,
    //             o.subtotal_price,
    //             o.discount,
    //             o.final_price,
    //             o.paid,
    //             o.vnp_txnref,
    //             o.vnp_url,
    //             o.revenue,
    //             o.cancel_reason,
    //             o.coupon_id,
    //             o.created_at
    //         FROM
    //             orders o
    //             JOIN (
    //                 SELECT order_id, status
    //                 FROM order_status
    //                 WHERE (order_id, created_at) IN (
    //                     SELECT order_id, MAX(created_at) FROM order_status GROUP BY order_id
    //                 )
    //             ) os ON os.order_id = o.id
    //         WHERE
    //             o.id = :order_id
    //             AND o.user_id = :user_id
    //         ORDER BY
    //             o.created_at DESC
    //     ";

    //     $result = $query->query($sql, ['order_id' => $order_id, 'user_id' => $user_id])->fetch();

    //     return $result ?? [];
    // }

    // // Lấy tổng số đơn hàng theo seller id
    // public static function countBySellerId($seller_id, $status = "all") {
    //     $query = new ConnectDatabase();

    //     $status = $status ?? "all";

    //     // Nếu status là "all", không cần điều kiện về trạng thái
    //     $statusCondition = ($status === "all") ? "" : "AND os.status = :status";

    //     $sql = "
    //         SELECT
    //             COUNT(*) AS total
    //         FROM
    //             orders o
    //             JOIN (
    //                 SELECT order_id, status
    //                 FROM order_status
    //                 WHERE (order_id, created_at) IN (
    //                     SELECT order_id, MAX(created_at) FROM order_status GROUP BY order_id
    //                 )
    //             ) os ON os.order_id = o.id
    //         WHERE
    //             o.seller_id = :seller_id
    //             $statusCondition
    //     ";

    //     // Truyền tham số vào câu truy vấn
    //     $params = ['seller_id' => $seller_id];

    //     // Nếu status không phải "all", thêm tham số status vào query
    //     if ($status !== "all") {
    //         $params['status'] = $status;
    //     }

    //     // Thực hiện truy vấn
    //     $result = $query->query($sql, $params)->fetch();

    //     return $result['total'] ?? 0;
    // }



    // // Lấy tổng số đơn hàng theo status
    // public static function count($status = "all") {
    //     $query = new ConnectDatabase();

    //     $status = $status ?? "all";

    //     // Nếu status là "all", không cần điều kiện về trạng thái
    //     $statusCondition = ($status === "all") ? "" : "AND os.status = :status";

    //     $sql = "
    //         SELECT
    //             COUNT(*) AS total
    //         FROM
    //             orders o
    //             JOIN (
    //                 SELECT order_id, status
    //                 FROM order_status
    //                 WHERE (order_id, created_at) IN (
    //                     SELECT order_id, MAX(created_at) FROM order_status GROUP BY order_id
    //                 )
    //             ) os ON os.order_id = o.id
    //         WHERE
    //             1=1 $statusCondition
    //     ";

    //     $params = [];

    //     // Nếu status không phải "all", thêm tham số status vào query
    //     if ($status !== "all") {
    //         $params['status'] = $status;
    //     }

    //     // Thực hiện truy vấn
    //     $result = $query->query($sql, $params)->fetch();

    //     return $result['total'] ?? 0;
    // }

    // // Lấy danh sách đơn hàng theo status
    // public static function get($status = "all", $limit = 12, $page = 1) {
    //     $query = new ConnectDatabase();

    //     $status = $status ?? "all";

    //     // Tính toán OFFSET
    //     $offset = ($page - 1) * $limit;

    //     // Nếu status là "all", không cần điều kiện về trạng thái
    //     $statusCondition = ($status === "all") ? "" : "AND os.status = :status";

    //     // Câu truy vấn với subquery để lấy trạng thái cuối cùng (last status) của mỗi đơn hàng
    //     $sql = "
    //         SELECT
    //             o.id AS order_id,
    //             o.seller_id,
    //             o.user_id,
    //             o.from_address_id,
    //             o.to_address_id,
    //             o.shipping_fee_id,
    //             o.subtotal_price,
    //             o.discount,
    //             o.final_price,
    //             o.paid,
    //             o.vnp_txnref,
    //             o.vnp_url,
    //             o.revenue,
    //             o.cancel_reason,
    //             o.coupon_id,
    //             o.created_at
    //         FROM
    //             orders o
    //             JOIN (
    //                 SELECT order_id, status
    //                 FROM order_status
    //                 WHERE (order_id, created_at) IN (
    //                     SELECT order_id, MAX(created_at) FROM order_status GROUP BY order_id
    //                 )
    //             ) os ON os.order_id = o.id
    //         WHERE
    //             1=1 $statusCondition
    //         ORDER BY
    //             o.created_at DESC
    //         LIMIT
    //             :limit OFFSET :offset
    //     ";

    //     // Thực hiện truy vấn
    //     $params = [
    //         'limit' => $limit,
    //         'offset' => $offset
    //     ];

    //     // Nếu status không phải "all", thêm tham số status vào query
    //     if ($status !== "all") {
    //         $params['status'] = $status;
    //     }

    //     $result = $query->query($sql, $params)->fetchAll();

    //     return $result ?? [];
    // }

    // // Lấy danh sách đơn hàng cho shipper
    // public static function shipperGet($status = "packed", $limit = 12, $page = 1) {
    //     $query = new ConnectDatabase();

    //     // Tính toán OFFSET
    //     $offset = ($page - 1) * $limit;

    //     $status = $status ?? "packed";

    //     // Câu truy vấn với subquery để lấy trạng thái cuối cùng (last status) của mỗi đơn hàng
    //     $sql = "
    //         SELECT
    //             o.id AS order_id,
    //             o.seller_id,
    //             o.user_id,
    //             o.from_address_id,
    //             o.to_address_id,
    //             o.shipping_fee_id,
    //             o.final_price,
    //             o.cancel_reason,
    //             o.created_at
    //         FROM
    //             orders o
    //             JOIN (
    //                 SELECT order_id, status
    //                 FROM order_status
    //                 WHERE (order_id, created_at) IN (
    //                     SELECT order_id, MAX(created_at) FROM order_status GROUP BY order_id
    //                 )
    //             ) os ON os.order_id = o.id
    //         WHERE
    //             status = :status
    //         ORDER BY
    //             o.created_at DESC
    //         LIMIT
    //             :limit OFFSET :offset
    //     ";

    //     // Thực hiện truy vấn
    //     $params = [
    //         'limit' => $limit,
    //         'offset' => $offset,
    //         'status' => $status
    //     ];

    //     $result = $query->query($sql, $params)->fetchAll();

    //     return $result ?? [];
    // }
}
