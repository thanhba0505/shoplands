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
            $orderItemId = Request::json("order_item_id") ?? Request::post("order_item_id");
            $images = Request::files('images');

            if (!$rating || !$orderId || !$orderItemId) {
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

            $order = OrderModel::findByUserIdOrderIdAndOrderItemId(
                $user["user_id"],
                $orderId,
                $orderItemId
            );

            if (!$order) {
                Response::json([
                    "message" => "Không tìm thấy đơn hàng hợp lệ"
                ], 400);
            }

            if ($order["review_id"]) {
                Response::json([
                    "message" => "Đã đánh giá sản phẩm này",
                ], 400);
            }

            $review = ReviewModel::add(
                $user["user_id"],
                $orderId,
                $order["product_variant_id"],
                $rating,
                $comment
            );

            $fileNames = [];

            if ($images) {
                $this->addReviewImages($review["review_id"], $images, $fileNames);
            }

            $image_paths = [];

            foreach ($fileNames as $key => $fileName) {
                $image_paths[$key]["image_path"] = $fileName;
            }

            Response::json([
                'message' => 'Thêm đánh giá thành công',
                'data' => [
                    'review_id' => $review["review_id"],
                    'order_id' => $orderId,
                    'comment' => $comment,
                    'created_at' => $review["created_at"],
                    'order_item_id' => $orderItemId,
                    'product_variant_id' => $order["product_variant_id"],
                    'rating' => $rating,
                    'user_id' => $user["user_id"],
                    'image_paths' => $image_paths ? $image_paths : ['image_path' => null]
                ]
            ], 200);
        } catch (\Throwable $th) {
            Log::throwable("CartController -> userGet: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    private function addReviewImages($review_id, $images, &$fileNames) {

        foreach ($images as $image) {
            $fileSave = FileSave::reviewImage($image);
            if ($fileSave['success'] === true) {
                $fileNames[] = $fileSave['file_name'];
            }
        }

        ReviewModel::addListImages($review_id, $fileNames);
    }

    // Lấy danh sách đánh giá theo order_id
    public function userGet($order_id) {
        try {
            $reviews = ReviewModel::getByOrderId($order_id);


            Response::json($reviews, 200);
        } catch (\Throwable $th) {
            Log::throwable("ReviewController -> getByOrderId: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Lấy danh sách đánh giá theo product_id
    public function userGetByProductId($product_id) {
        try {
            $reviews = ReviewModel::getByProductId($product_id);


            Response::json($reviews, 200);
        } catch (\Throwable $th) {
            Log::throwable("ReviewController -> getByProductId: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }
}
