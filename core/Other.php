<?php

class Other
{
    public static function listOrderStatus()
    {
        return [
            'all' => 'Tất cả',
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
}
