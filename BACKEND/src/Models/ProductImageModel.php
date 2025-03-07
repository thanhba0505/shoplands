<?php

namespace App\Models;

use App\Models\ConnectDatabase;

class ProductImageModel
{
    // Lấy danh sách ảnh của sản phẩm theo id
    public static function getByProductId($product_id)
    {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                pi.image_path,
                pi.default
            FROM
                product_images pi
            WHERE
                pi.product_id = :product_id
        ";

        $result = $query->query($sql, ['product_id' => $product_id])->fetchAll();

        return $result;
    }

    // Lấy danh ảnh mặc định
    public static function getDefault($product_id)
    {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                pi.image_path,
                pi.default
            FROM
                product_images pi
            WHERE
                pi.product_id = :product_id
                AND pi.default = :default
        ";

        $result = $query->query($sql, ['product_id' => $product_id, "default" => 1])->fetch();

        return $result['image_path'] ?? null;
    }
}
