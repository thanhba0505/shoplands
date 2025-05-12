<?php

namespace App\Controllers;

use App\Helpers\Auth;
use App\Helpers\FileSave;
use App\Helpers\Log;
use App\Helpers\Request;
use App\Helpers\Response;
use App\Helpers\Validator;
use App\Models\OrderModel;
use App\Models\ReviewModel;

class ReviewController {
    // Thêm đánh giá
    public function add() {
        try {
            $user = Auth::user();
            $rating = Request::json("rating") ?? Request::post("rating");
            $comment = Request::json("comment") ?? Request::post("comment");
            $orderId = Request::json("order_id") ?? Request::post("order_id");
            $productVariantId = Request::json("product_variant_id") ?? Request::post("product_variant_id");
            $images = Request::files('images');

            if (!$rating || !$orderId || !$productVariantId) {
                Response::json([
                    "message" => "Thông tin không đủ"
                ], 400);
            }

            if ($rating < 1 || $rating > 5) {
                Response::json([
                    "message" => "Đánh giá không hợp lệ"
                ], 400);
            }

            $checkComment = Validator::isText($comment, 'Nội dung', 0, 5000, true);
            if ($checkComment !== true) {
                Response::json([
                    "message" => $checkComment
                ], 400);
            }

            $rating = (int) $rating;

            $order = OrderModel::findByUserIdOrderIdAndProductVariantId(
                $user["user_id"],
                $orderId,
                $productVariantId
            );

            if (!$order) {
                Response::json([
                    "message" => "Không tìm thấy đơn hàng hợp lệ"
                ], 400);
            }

            if ($order["review_id"]) {
                Response::json([
                    "message" => "Đã đánh giá sản phẩm này"
                ], 400);
            }

            $reviewId = ReviewModel::add($user["user_id"], $orderId, $productVariantId, $rating, $comment);
            if ($images) {
                $this->addReviewImages($reviewId, $images);
            }

            Response::json(['message' => 'Thêm đánh giá thành công'], 200);
            Response::json([$order], 200);
        } catch (\Throwable $th) {
            Log::throwable("CartController -> userGet: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    private function addReviewImages($review_id, $images) {
        $fileNames = [];

        foreach ($images as $image) {
            $fileSave = FileSave::reviewImage($image);
            if ($fileSave['success'] === true) {
                $fileNames[] = $fileSave['file_name'];
            }
        }

        ReviewModel::addListImages($review_id, $fileNames);
    }
}
