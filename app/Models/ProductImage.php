<?php

require_once 'app/Models/QueryCustom.php';

class ProductImage
{
    // Lấy danh sách ảnh đầu tiên của mỗi sản phẩm
    public function getFirstImgOfProduct()
    {
        // $image = new ProductImage();
        // $images = $image->getOneImageOnProduct();


        // $query = new QueryCustom();

        // $result = $query
        //     ->select(['products.id', 'products.name', 'products.status'])
        //     ->from('products')
        //     ->join('product_images', 'products.id = product_images.product_id')
        //     ->where('products.status = :status', ['status' => 'active'])
        //     ->limit($limit)
        //     ->all();

        // return $result;
    }
}
