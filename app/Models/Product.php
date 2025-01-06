<?php

require_once 'app/Models/QueryCustom.php';

class Product
{
    public function getProducts($limit = 12)
    {
        $productQuery = new QueryCustom();
        $ratingQuery = new QueryCustom();

        $productImg = "
        SELECT 
            id,
            image_path,
            product_id
        FROM (
            SELECT 
                product_images.id,
                product_images.image_path,
                product_images.product_id,
                ROW_NUMBER() OVER (PARTITION BY product_images.product_id ORDER BY product_images.id ASC) AS row_num
            FROM product_images
        ) AS ranked_images
        WHERE row_num = 1
        ";

        // $rating = $ratingQuery
        //     ->select(['reviews.id', 'reviews.rating', 'products.id', 'products.name'])
        //     ->from('reviews')
        //     ->join('product_variants', 'reviews.product_variant_id = product_variants.id')
        //     ->where(' = :status', ['status' => 'active'])
        //     ->limit($limit)
        //     ->all();

        $product = $productQuery
            ->select(['products.id', 'products.name',  'product_images.image_path'])
            ->from('products')
            ->joinSubQuery($productImg, 'product_images', 'products.id = product_images.product_id')
            ->where('products.status = :status', ['status' => 'active'])
            ->limit($limit)
            ->all();

        return $product;
    }
}
