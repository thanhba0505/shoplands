<?php

require_once 'app/Models/QueryCustom.php';

class Order
{
    // Lấy danh sách đơn hàng theo người bán và trạng thái
    public function getOrdersBySellerId($seller_id, $status = null)
    {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT
                o.id AS order_id,
                o.revenue AS order_revenue,
                o.created_at AS order_created_at,
                u.id AS user_id,
                u.name AS user_name,
                pv.id AS product_variant_id,
                pi.image_path AS product_image,
                p.id AS product_id,
                p.name AS product_name,
                oi.quantity AS order_quantity,
                pav.value AS product_attribute_value,
                pa.name AS product_attribute,
                sf.shipping_method AS shipping_method,
                os_pending.date_time AS order_date, -- Thời gian trạng thái Pending
                os_latest.date_time AS latest_status_date, -- Thời gian trạng thái mới nhất
                os_latest.status AS latest_status -- Trạng thái mới nhất
            FROM
                orders o
                JOIN users u ON u.id = o.user_id
                JOIN order_items oi ON oi.order_id = o.id
                JOIN product_variants pv ON pv.id = oi.product_variant_id
                JOIN products p ON p.id = pv.product_id
                LEFT JOIN product_variant_values pvv ON pvv.product_variant_id = pv.id
                LEFT JOIN product_attribute_values pav ON pav.id = pvv.product_attribute_value_id
                LEFT JOIN product_attributes pa ON pa.id = pav.product_attribute_id
                JOIN product_images pi ON pi.product_id = p.id
                JOIN shipping_fees sf ON sf.id = o.shipping_fee_id
                -- Lấy trạng thái Pending
                LEFT JOIN (
                    SELECT order_id, date_time
                    FROM order_status
                    WHERE status = 'Pending'
                ) os_pending ON os_pending.order_id = o.id
                -- Lấy trạng thái mới nhất
                LEFT JOIN (
                    SELECT order_id, status, date_time
                    FROM order_status
                    WHERE (order_id, date_time) IN (
                        SELECT order_id, MAX(date_time)
                        FROM order_status
                        GROUP BY order_id
                    )
                ) os_latest ON os_latest.order_id = o.id
            WHERE
                o.seller_id = :seller_id
                AND pi.default = :default
                " . ($status ? "AND os_latest.status = :status" : "") . " 
            GROUP BY
                o.id,
                o.revenue,
                o.created_at,
                u.id,
                u.name,
                pv.id,
                pi.image_path,
                p.id,
                p.name,
                oi.quantity,
                pav.value,
                pa.name,
                sf.shipping_method,
                os_pending.date_time,
                os_latest.date_time,
                os_latest.status
            LIMIT 100;
        ";

        // Gắn tham số truy vấn
        $params = [
            'seller_id' => $seller_id,
            'default' => 1
        ];
        if ($status) {
            $params['status'] = $status;
        }

        // Thực thi truy vấn
        $result = $query->query($sql, $params)->fetchAll();

        return $result;
    }

    // Lấy danh sách số lượng đơn hàng theo trạng thái
    public function getListOrderQuantity($seller_id)
    {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT
                os.status,
                COUNT(*) AS order_count
            FROM
                orders o
                JOIN (
                    SELECT
                        order_id,
                        status,
                        date_time
                    FROM
                        order_status
                    WHERE
                        (order_id, date_time) IN (
                            SELECT
                                order_id,
                                MAX(date_time)
                            FROM
                                order_status
                            GROUP BY
                                order_id
                        )
                ) os ON os.order_id = o.id
            WHERE
                o.seller_id = :seller_id
            GROUP BY
                os.status
        ";

        // Thực thi truy vấn
        $result = $query->query($sql, ['seller_id' => $seller_id])->fetchAll();

        return $result;
    }

    // Lấy thông tin chi tiết 1 đơn hàng
    public function getOrderDetail($order_id)
    {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT
                o.id AS order_id,
                o.payment_method AS payment_method,
                o.subtotal_price AS subtotal_price,
                o.discount_amount AS discount_amount,
                o.final_price AS final_price,
                o.revenue AS revenue,
                o.cancel_reason AS cancel_reason,
                u.name AS user_name,
                a_from.address_line AS from_address,
                a_to.address_line AS to_address,
                p_from.name AS from_province,
                p_to.name AS to_province
            FROM
                orders o
                JOIN users u ON u.id = o.user_id
                JOIN addresses a_from ON a_from.id = o.from_address_id
                JOIN provinces p_from ON p_from.id = a_from.province_id
                JOIN addresses a_to ON a_to.id = o.to_address_id
                JOIN provinces p_to ON p_to.id = a_to.province_id
            WHERE
                o.id = :order_id
        ";

        // Thực thi truy vấn
        $result = $query->query($sql, ['order_id' => $order_id])->fetch();

        return $result;
    }

    // Lấy tất cả trạng thái của 1 hóa đơn
    public function getOrderStatus($order_id)
    {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT
                os.id AS order_status_id,
                os.status AS order_status,
                os.date_time AS order_status_date
            FROM
                order_status os
            WHERE
                os.order_id = :order_id
            ORDER BY
                os.date_time
        ";

        // Thực thi truy vấn
        $result = $query->query($sql, ['order_id' => $order_id])->fetchAll();

        return $result;
    }
}
