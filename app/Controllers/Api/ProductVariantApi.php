<?php

require_once 'app/Models/ProductVariant.php';

class ProductVariantApi
{
    public function checkStock()
    {
        $product_variant_id = $_GET['id'] ?? null;

        if ($product_variant_id) {
            $productVariantModel = new ProductVariant();
            $quantity = $productVariantModel->getQuantityByProductVariantId($product_variant_id);

            return Api::encode($quantity, 'Check stock successfully', 'success');
        }
        return Api::encode(null, 'Check stock failed', 'error');
    }
}
