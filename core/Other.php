<?php

class Other
{
    public static function listOrderStatus()
    {
        return [
            'order-all' => 'Tất cả',
            'pending' => 'Chờ xác nhận',
            'packing' => 'Đang đóng gói',
            'packed' => 'Đã đóng gói',
            'shipping' => 'Đang vận chuyển',
            'delivered' => 'Đã giao hàng',
            'completed' => 'Đã hoàn thành',
            'return-requested' => 'Yêu cầu trả hàng',
            'return-approved' => 'Chấp nhận trả hàng',
            'return-rejected' => 'Từ chối trả hàng',
            'returned' => 'Đã trả hàng',
            'canceled' => 'Đã hủy',
        ];
    }

    public static function listProductStatus()
    {
        return [
            'product-all' => 'Tất cả',
            'in-stock' => 'Còn hàng',
            'out-of-stock' => 'Hết hàng',
            'hidden' => 'Đã ẩn',
            'deleted' => 'Đã xóa',
            'locked' => 'Đã khóa',
        ];
    }
}
