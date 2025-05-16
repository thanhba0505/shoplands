<?php

namespace App\Controllers;

use App\Helpers\Auth;
use App\Helpers\Log;
use App\Helpers\Request;
use App\Helpers\Response;
use App\Helpers\Validator;
use App\Models\CouponModel;

class CouponController {
    public function get($seller_id) {
        try {
            if (!$seller_id) {
                Response::json(['message' => "Mã người bán rỗng"]);
            }

            $result = CouponModel::getActiveCoupons($seller_id);

            Response::json($result);
        } catch (\Throwable $th) {
            Log::throwable("CouponController -> get: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    public function sellerGet() {
        try {
            $seller = Auth::seller();
            $expired = Request::get('expired') ? Request::get('expired') : false;

            if ($expired) {
                $result = CouponModel::getExpiredCoupons($seller["seller_id"]);
                Response::json($result);
            }

            $result = CouponModel::getUpcomingCoupons($seller["seller_id"]);
            Response::json($result);
        } catch (\Throwable $th) {
            Log::throwable("CouponController -> get: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Người bán thêm coupon
    public function sellerAdd() {
        try {
            $seller = Auth::seller();

            $code = strtoupper(Request::json('code'));
            $description = Request::json('description');
            $discount_type = Request::json('discount_type');
            $discount_value = Request::json('discount_value');
            $maximum_discount = Request::json('maximum_discount');
            $minimum_order_value = Request::json('minimum_order_value');
            $usage_limit = Request::json('usage_limit');
            $start_date = Request::json('start_date');
            $end_date = Request::json('end_date');

            if (
                !$code ||
                !$discount_type ||
                !$discount_value ||
                !$start_date ||
                !$end_date
            ) {
                Response::json(['message' => 'Thông tin không đủ'], 400);
            }

            $checkCode = CouponModel::checkCode($code);

            if ($checkCode) {
                Response::json(['message' => 'Mã giảm giá đã tồn tại'], 400);
            }

            if (!in_array($discount_type, ['percentage', 'fixed'])) {
                return Response::json(['message' => 'Loại giảm giá không hợp lệ'], 400);
            }

            $checkDescription = Validator::isText($description, 'Mô tả', 0, 5000, true);
            if ($checkDescription !== true) {
                Response::json(['message' => $checkDescription], 400);
            }

            $checkDisountValue = Validator::isNumber($discount_value, 'Giá trị giảm', 1, MAX_PRICE_ORDER);
            if ($checkDisountValue !== true) {
                Response::json(['message' => $checkDisountValue], 400);
            }

            $checkMaximumDiscount = Validator::isNumber($maximum_discount, 'Giá trị giảm tối đa', 0, MAX_PRICE_ORDER);
            if ($checkMaximumDiscount !== true) {
                Response::json(['message' => $checkMaximumDiscount], 400);
            }

            $checkMinimumOrderValue = Validator::isNumber($minimum_order_value, 'Giá trị đơn hàng tối thiểu', 0, MAX_PRICE_ORDER);
            if ($checkMinimumOrderValue !== true) {
                Response::json(['message' => $checkMinimumOrderValue], 400);
            }

            $checkUsageLimit = Validator::isNumber($usage_limit, 'Số lượt sử dụng', 0, 10000);
            if ($checkUsageLimit !== true) {
                Response::json(['message' => $checkUsageLimit], 400);
            }

            $checkStartDate = Validator::isDate($start_date, 'Ngày bắt dầu');
            if ($checkStartDate !== true) {
                Response::json(['message' => $checkStartDate], 400);
            }

            $checkEndDate = Validator::isDate($end_date, 'Ngày kết thúc');
            if ($checkEndDate !== true) {
                Response::json(['message' => $checkEndDate], 400);
            }

            if (strtotime($start_date) > strtotime($end_date)) {
                return Response::json(['message' => 'Ngày kết thúc phải sau ngày bắt đầu'], 400);
            }

            $couponId = CouponModel::add(
                $code,
                $description,
                $discount_type,
                $discount_value,
                $maximum_discount,
                $minimum_order_value,
                $usage_limit,
                $start_date,
                $end_date,
                $seller['seller_id']
            );

            if (!$couponId) {
                Response::json(['message' => 'Thêm mã giảm giá không thành công'], 400);
            }

            Response::json([
                'coupon_id' => $couponId,
                'message' => 'Thêm mã giảm giá thành công'
            ]);
        } catch (\Throwable $th) {
            Log::throwable("CouponController -> post: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }
}
