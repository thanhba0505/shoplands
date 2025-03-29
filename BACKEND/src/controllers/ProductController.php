<?php

namespace App\Controllers;

use App\Helpers\Auth;
use App\Helpers\FileSave;
use App\Helpers\Log;
use App\Helpers\Request;
use App\Helpers\Response;
use App\Helpers\Validator;
use App\Models\CategoryModel;
use App\Models\ProductAttributeModel;
use App\Models\ProductAttributeValueModel;
use App\Models\ProductDetailModel;
use App\Models\ProductImageModel;
use App\Models\ProductModel;
use App\Models\ProductVariantModel;
use App\Models\ProductVariantValueModel;
use App\Models\ReviewModel;

class ProductController {
    public function get() {
        try {
            // Lấy các thông tin từ request
            $limit = Request::get('limit', 12);
            $page = max(1, Request::get('page', 1));
            $categories = Request::get('categories', []);
            $order_by_price = Request::get('order_by_price', '');
            $order_by_rating = Request::get('order_by_rating', '');

            // Lấy tổng số sản phẩm và danh sách sản phẩm
            $count = ProductModel::count();
            $products = ProductModel::getAll($limit, $page);

            // Enrich dữ liệu sản phẩm
            foreach ($products as $key => $product) {
                $products[$key] = $this->enrichProductData($product);
            }

            // Sắp xếp sản phẩm theo rating và price nếu có yêu cầu
            $this->sortProducts($products, $order_by_price, $order_by_rating);

            Response::json(['count' => $count, 'products' => $products], 200);
        } catch (\Throwable $th) {
            $this->logAndRespond("Lỗi lấy danh sách sản phẩm", $th);
        }
    }

    private function sortProducts(&$products, $order_by_price, $order_by_rating) {
        // Sắp xếp sản phẩm theo giá nếu có yêu cầu
        $this->sortProductsByPrice($products, $order_by_price);

        // Sắp xếp sản phẩm theo đánh giá nếu có yêu cầu
        $this->sortProductsByRating($products, $order_by_rating);
    }

    private function sortProductsByPrice(&$products, $order_by_price) {
        if ($order_by_price === 'asc') {
            usort($products, function ($a, $b) {
                return $a['min_price'] - $b['min_price'];
            });
        } elseif ($order_by_price === 'desc') {
            usort($products, function ($a, $b) {
                return $b['min_price'] - $a['min_price'];
            });
        }
    }

    private function sortProductsByRating(&$products, $order_by_rating) {
        if ($order_by_rating === 'asc') {
            usort($products, function ($a, $b) {
                $ratingA = $this->getValidRating($a['average_rating']);
                $ratingB = $this->getValidRating($b['average_rating']);

                if ($ratingA === $ratingB) {
                    return 0;
                } elseif ($ratingA < $ratingB) {
                    return -1;
                } else {
                    return 1;
                }
            });
        } elseif ($order_by_rating === 'desc') {
            usort($products, function ($a, $b) {
                $ratingA = $this->getValidRating($a['average_rating']);
                $ratingB = $this->getValidRating($b['average_rating']);

                if ($ratingA === $ratingB) {
                    return 0;
                } elseif ($ratingA > $ratingB) {
                    return -1;
                } else {
                    return 1;
                }
            });
        }
    }

    private function getValidRating($rating) {
        // Kiểm tra rating hợp lệ (là số)
        if (is_numeric($rating)) {
            return (float) $rating;
        }
        // Nếu không hợp lệ, trả về 0 (hoặc giá trị mặc định bạn muốn)
        return 0;
    }



    public function find($id) {
        try {
            $product = ProductModel::getByProductId($id);

            if (!$product) {
                Response::json(['message' => 'Không tìm thấy sản phẩm'], 404);
                return;
            }

            $product = $this->enrichProductData($product);
            Response::json($product);
        } catch (\Throwable $th) {
            $this->logAndRespond("AddressController -> userGet", $th);
        }
    }

    public function sellerGet() {
        try {
            $seller = Auth::seller();
            $limit = Request::get('limit', 12);
            $page = Request::get('page', 1);
            $status = Request::get('status', 'all');

            $count = ProductModel::countBySellerId($seller['seller_id'], $status);
            $products = ProductModel::getBySellerId($seller['seller_id'], $status, $limit, $page);

            foreach ($products as $key => $product) {
                $products[$key] = $this->enrichProductData($product);
            }

            Response::json(['count' => $count, 'products' => $products]);
        } catch (\Throwable $th) {
            $this->logAndRespond("AddressController -> sellerGet", $th);
        }
    }

    public function sellerAdd() {
        try {
            $seller = Auth::seller();

            $data = [
                'seller_id' => $seller['seller_id'],
                'name' => Request::post('name'),
                'description' => Request::post('description'),
                'category_id' => Request::post('category_id') === '' ? null : Request::post('category_id'),
                'product_details' => is_array(Request::post('product_details', [], true)) ? Request::post('product_details', [], true) : [],
                'product_variants' => is_array(Request::post('product_variants', [], true)) ? Request::post('product_variants', [], true) : [],
                'images' => Request::files('images')
            ];

            // Validate input data
            $this->checkAddProduct(
                $data['name'],
                $data['description'],
                $data['category_id'],
                $data['images'],
                $data['product_details'],
                $data['product_variants']
            );

            // Add product
            $product_id = ProductModel::add(
                $data['name'],
                $data['description'],
                $data['seller_id'],
                $data['category_id']
            );

            // Add product images
            $this->addProductImages($product_id, $data['images']);

            // Add product details
            $this->addProductDetails($product_id, $data['product_details']);

            // Add product variants
            $this->addProductVariants($product_id, $data['product_variants']);

            Response::json(['message' => 'Thêm sản phẩm thành công'], 201);
        } catch (\Throwable $th) {
            $this->logAndRespond("AddressController -> sellerAdd", $th);
        }
    }

    private function enrichProductData($product) {
        $product['variants'] = ProductVariantModel::getByProductId($product['product_id']);
        $product['average_rating'] = ReviewModel::getAverageRatingByProductId($product['product_id']);
        $product['count_reviews'] = ReviewModel::getCountReviewsByProductId($product['product_id']);

        $minPrice = null;
        $maxPrice = null;
        $priceFromMinPrice = null;
        $quantity = 0;
        $sold_quantity = 0;

        foreach ($product['variants'] as $key => $variant) {
            $quantity += $variant['quantity'];
            $sold_quantity += $variant['sold_quantity'];

            $values = ProductVariantValueModel::getByProductVariantId($variant['product_variant_id']);
            $product['variants'][$key]['values'] = $values;

            foreach ($values as $value) {
                $product['attributes'][$value['name']][] = $value['value'];
                $product['attributes'][$value['name']] = array_unique($product['attributes'][$value['name']]);
            }

            // Calculate min/max prices
            $currentMin = ($variant['promotion_price'] === null) ?
                $variant['price'] :
                min($variant['price'], $variant['promotion_price']);

            $currentMinPromotion = ($variant['promotion_price'] !== null && $currentMin === $variant['promotion_price']) ?
                $variant['price'] : null;

            if ($minPrice === null || $currentMin < $minPrice) {
                $minPrice = $currentMin;
                $priceFromMinPrice = $currentMinPromotion;
            }

            $currentMax = ($variant['promotion_price'] === null) ?
                $variant['price'] :
                max($variant['price'], $variant['promotion_price']);

            if ($maxPrice === null || $currentMax > $maxPrice) {
                $maxPrice = $currentMax;
            }
        }

        // Set calculated values
        $product['attributes'] = $product['attributes'] ?? [];
        $product['min_price'] = $minPrice;
        $product['max_price'] = $maxPrice;
        $product['price_from_min_price'] = $priceFromMinPrice;
        $product['quantity'] = $quantity;
        $product['sold_quantity'] = $sold_quantity;

        // Get additional data
        $product['images'] = ProductImageModel::getByProductId($product['product_id']);
        $product['category'] = CategoryModel::getByProductId($product['product_id']);
        $product['details'] = ProductDetailModel::getByProductId($product['product_id']);

        return $product;
    }

    private function logAndRespond($message, $throwable) {
        Log::throwable($message . ": " . $throwable->getMessage());
        Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
    }

    private function addProductImages($product_id, $images) {
        $default = 1;
        $countImageUpload = 0;

        foreach ($images as $image) {
            $fileSave = FileSave::productImage($image);
            if ($fileSave['success'] === true) {
                ProductImageModel::add($product_id, $fileSave['file_name'], $default);
                $default = 0;
                $countImageUpload++;
            }
        }

        if ($countImageUpload === 0) {
            Response::json(['message' => 'Có lỗi xảy ra, số ảnh được tải lên ít hơn 1'], 400);
        }
    }

    private function addProductDetails($product_id, $product_details) {
        foreach ($product_details as $detail) {
            ProductDetailModel::add(
                $product_id,
                $detail['name'],
                $detail['description']
            );
        }
    }

    private function addProductVariants($product_id, $product_variants) {
        if (count($product_variants) > 1) {
            $this->addVariantsWithAttributes($product_id, $product_variants);
        } else {
            $this->addSimpleVariants($product_id, $product_variants);
        }
    }

    private function addVariantsWithAttributes($product_id, $product_variants) {
        $product_attributes = $this->extractUniqueAttributes($product_variants);

        // Verify combinations count
        $combinationsCount = 1;
        foreach ($product_attributes as $attribute) {
            $combinationsCount *= count($attribute['values']);
        }

        if ($combinationsCount !== count($product_variants)) {
            Response::json([
                'message' => 'Số lượng tổ hợp thuộc tính không khớp với số lượng biến thể sản phẩm.'
            ]);
        }

        // Add attributes and values
        $attribute_value = [];
        foreach ($product_attributes as $attribute) {
            $product_attribute_id = ProductAttributeModel::add($attribute['name']);

            foreach ($attribute['values'] as $value) {
                $product_attribute_value_id = ProductAttributeValueModel::add(
                    $value,
                    $product_attribute_id
                );

                $attribute_value[] = [
                    'name' => $attribute['name'],
                    'value' => $value,
                    'product_attribute_value_id' => $product_attribute_value_id
                ];
            }
        }

        // Add variants and link attributes
        foreach ($product_variants as $variant) {
            $product_variant_id = ProductVariantModel::add(
                $product_id,
                $variant['quantity'],
                $variant['price'],
                $variant['promotion_price'] ?? null
            );

            foreach ($variant['attributes'] as $attribute) {
                foreach ($attribute_value as $value) {
                    if ($value['name'] === $attribute['name'] && $value['value'] === $attribute['value']) {
                        ProductVariantValueModel::add(
                            $product_variant_id,
                            $value['product_attribute_value_id']
                        );
                    }
                }
            }
        }
    }

    private function addSimpleVariants($product_id, $product_variants) {
        foreach ($product_variants as $variant) {
            ProductVariantModel::add(
                $product_id,
                $variant['quantity'],
                $variant['price'],
                $variant['promotion_price'] ?? null
            );
        }
    }

    private function extractUniqueAttributes($product_variants) {
        $product_attributes = [];

        foreach ($product_variants as $variant) {
            foreach ($variant['attributes'] as $attribute) {
                $name = $attribute['name'];
                $value = $attribute['value'];

                if (!isset($product_attributes[$name])) {
                    $product_attributes[$name] = [
                        "name" => $name,
                        "values" => []
                    ];
                }

                if (!in_array($value, $product_attributes[$name]['values'])) {
                    $product_attributes[$name]['values'][] = $value;
                }
            }
        }

        return array_values($product_attributes);
    }

    private function checkAddProduct($name, $description, $category_id, $images, $product_details, $product_variants) {
        // Check product name
        $checkName = Validator::isText($name, 'Tên sản phẩm', 3, 100);
        if ($checkName !== true) {
            Response::json(['message' => $checkName], 400);
        }

        // Check description
        $checkDescription = Validator::isText($description, 'Mota', 0, 5000, true);
        if ($checkDescription !== true) {
            Response::json(['message' => $checkDescription], 400);
        }

        // Check category
        if (!empty($category_id)) {
            $checkCategory = CategoryModel::find($category_id);
            if (!$checkCategory) {
                Response::json(['message' => 'Không tìm thấy danh mục'], 400);
            }
        }

        // Check images
        if (!$images || count($images) < 1) {
            Response::json(['message' => 'Sản phẩm cần ít nhất 1 hình ảnh'], 400);
        }

        // Check product details
        foreach ($product_details as $product_detail) {
            $checkName = Validator::isText($product_detail['name'], 'Tên sản phẩm', 3, 300);
            if ($checkName !== true) {
                Response::json(['message' => $checkName], 400);
            }

            $checkDescription = Validator::isText($product_detail['description'], 'Mô tả', 0, 5000, true);
            if ($checkDescription !== true) {
                Response::json(['message' => $checkDescription], 400);
            }
        }

        // Check variants
        if (count($product_variants) < 1) {
            Response::json(['message' => 'Không đủ thông tin giá sản phẩm'], 400);
        }

        foreach ($product_variants as $variant) {
            $checkPrice = Validator::isNumber($variant['price'], 'Giá sản phẩm', 1, null);
            if ($checkPrice !== true) {
                Response::json(['message' => $checkPrice], 400);
            }

            $checkQuantity = Validator::isNumber($variant['quantity'], 'Số lượng sản phẩm', 1, 10000);
            if ($checkQuantity !== true) {
                Response::json(['message' => $checkQuantity], 400);
            }

            if ($variant['promotion_price'] && $variant['promotion_price'] >= $variant['price']) {
                Response::json(['message' => "Giá khuyến mãi phải nhỏ hơn giá bán"], 400);
            }

            if (isset($variant['promotion_price']) && $variant['promotion_price'] <= 0) {
                Response::json(['message' => "Giá khuyến mãi phải lớn hơn 0"], 400);
            }
        }
    }
}
