<?php

require_once 'app/Models/QueryCustom.php';

class ProductImage
{
    // Lấy danh sách ảnh của sản phẩm theo id
    public function getImagesByProductId($product_id)
    {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                pi.image_path AS path,
                pi.default AS is_default
            FROM
                product_images pi
            WHERE
                pi.product_id = :product_id
        ";

        $result = $query->query($sql, ['product_id' => $product_id])->fetchAll();

        return $result;
    }

    // Lấy ảnh"default" cơ bản
    public function getDefaultImage($product_id)
    {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                pi.image_path AS path
            FROM
                product_images pi
            WHERE
                pi.product_id = :product_id
                AND pi.default = :default
        ";

        $result = $query->query($sql, ['product_id' => $product_id, 'default' => 1])->fetch();

        return $result['path'] ?? null;
    }
}
