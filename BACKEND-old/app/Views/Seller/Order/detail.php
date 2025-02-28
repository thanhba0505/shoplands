<div class="text-2xl font-semibold">Chi tiết đơn hàng</div>

<div class="grid grid-cols-2 mt-4 gap-x-6 gap-y-6">
    <div class="col-span-1 px-6">
        <ul class="space-y-2">
            <li><span class="font-bold text-gray-500">Mã đơn hàng:</span> <?= Util::encodeHtml($order['order_id']) ?></li>
            <li><span class="font-bold text-gray-500">Ngày đặt hàng:</span> 1231312</li>
            <li><span class="font-bold text-gray-500">Người mua:</span> <?= Util::encodeHtml($order['user_name']) ?></li>
            <li><span class="font-bold text-gray-500">Địa chỉ:</span> <?= Util::encodeHtml($order['to_province']) ?>, <?= Util::encodeHtml($order['to_address']) ?></li>
            <li><span class="font-bold text-gray-500">Phương thức thanh toán:</span> <span class="uppercase"><?= Util::encodeHtml($order['payment_method']) ?></span></li>
        </ul>
    </div>

    <div class="col-span-1 px-6">
        <ul class="space-y-2">
            <li><span class="font-bold text-gray-500">Tổng tiền sản phẩm:</span> <?= Util::formatCurrency($order['subtotal_price']) ?></li>
            <li><span class="font-bold text-gray-500">Tổng giảm giá:</span> <?= Util::formatCurrency($order['discount_amount']) ?></li>
            <li><span class="font-bold text-gray-500">Thành tiền:</span> <?= Util::formatCurrency($order['final_price']) ?></li>
            <li><span class="font-bold text-gray-500">Doanh thu:</span> <?= Util::formatCurrency($order['revenue']) ?></li>
        </ul>
    </div>

    <div class="col-span-2">
        <div class="text-xl font-semibold">Danh sách sản phẩm</div>
        <ul class="space-y-2">
            <li>

            </li>
        </ul>
    </div>

    <div class="col-span-2">
        <div class="text-xl font-semibold">Trạng thái đơn hàng</div>
        <div class="container mx-auto py-6">
            <!-- Thanh ngang timeline -->
            <div class="relative flex items-center justify-evenly">
                <!-- Line -->
                <div class="absolute top-2 pb-px left-0 w-full h-0.5 bg-gray-300"></div>

                <?php $l = Other::listOrderStatus(); ?>
                <?php foreach ($status as $s): ?>
                    <div class="relative flex flex-col items-center">
                        <div class="bg-blue-500 w-4 h-4 rounded-full border border-white"></div>
                        <div class="mt-6 text-center">
                            <h3 class="font-semibold text-blue-500"><?= Util::encodeHtml($l[$s['order_status']]) ?></h3>
                            <span class="block text-sm text-gray-500"><?= Util::formatTime($s['order_status_date'], 'H:i') ?></span>
                            <span class="block text-sm text-gray-500"><?= Util::formatDate($s['order_status_date']) ?></span>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>

    </div>

    <div class="col-span-2">
        <div class="flex justify-end">
            <a href="" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
                Button
            </a>
        </div>
    </div>
</div>