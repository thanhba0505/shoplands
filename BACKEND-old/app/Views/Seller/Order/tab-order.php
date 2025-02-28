<?php foreach ($orders as $order): ?>
    <tr>
        <td colspan="6" class="py-2"></td>
    </tr>
    <tr class="bg-blue-100">
        <td colspan="3" class="border border-blue-300 px-4 py-2 font-bold"><?= Util::encodeHtml($order['user_name']) ?></td>
        <td colspan="3" class="border border-blue-300 px-4 py-2 text-right">Mã đơn hàng: <?= Util::encodeHtml($order['order_id']) ?></td>
    </tr>
    <tr class="text-center">
        <td class="border border-blue-300 px-4 py-2">
            <div class="gap-3 py-2 flex flex-col">
                <?php foreach ($order['products'] as $product): ?>
                    <div class="flex items-center gap-x-4">
                        <img src="<?= BASE_URL ?>/public/uploads/img/cap-sac.webp" alt="" class="w-10 h-10 border border-blue-300">
                        <span class="line-clamp-2 w-20 flex-1 pe-4 text-start"><?= Util::encodeHtml($product['product_name']) ?></span>
                        <?php if (count($product['attributes']) > 1): ?>
                            <ul class="text-end">
                                <?php foreach ($product['attributes'] as $attribute): ?>
                                    <li><?= Util::encodeHtml($attribute['attribute_name']) ?>: <i><?= Util::encodeHtml($attribute['attribute_value']) ?></i></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                        <div>
                            x<?= Util::encodeHtml($product['order_quantity']) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </td>
        <td class="border border-blue-300 px-4 py-2"><?= Util::formatCurrency($order['revenue']) ?></td>
        <td class="border border-blue-300 px-4 py-2"><?= Util::encodeHtml($order['shipping_method']) ?></td>
        <td class="border border-blue-300 px-4 py-2"><?= Util::formatDate($order['order_created_at']) ?></td>
        <td class="border border-blue-300 px-4 py-2">
            <?= Util::formatDate($order['latest_status_date']) ?>
            <br>
            <?= Util::encodeHtml($listOrderStatus[$order['order_status']]) ?>
        </td>
        <td class="border border-blue-300 px-4 py-2">
            <a href="<?= Redirect::seller('order/detail')->withQuery(['id' => $order['order_id']])->getUrl() ?>" class="text-blue-500 hover:underline">Chi tiết</a><br>

            <?php if ($order['order_status'] == 'pending'): ?>
                <a href="<?= Redirect::seller('order/pending')->withQuery(['id' => $order['order_id']])->getUrl() ?>" class="pt-1 text-green-500 hover:underline">Xác nhận</a>
            <?php elseif ($order['order_status'] == 'packing'): ?>
                <a href="<?= Redirect::seller('order/packing')->withQuery(['id' => $order['order_id']])->getUrl() ?>" class="pt-1 text-green-500 hover:underline">Đã đóng gói</a>
            <?php elseif ($order['order_status'] == 'packed'): ?>
                <a href="<?= Redirect::seller('order/packed')->withQuery(['id' => $order['order_id']])->getUrl() ?>" class="pt-1 text-green-500 hover:underline">Đã giao</a>
            <?php elseif ($order['order_status'] == 'return-requested'): ?>
                <a href="<?= Redirect::seller('order/return-requested/accept')->withQuery(['id' => $order['order_id']])->getUrl() ?>" class="pt-1 text-green-500 hover:underline">Chấp nhận</a><br>
                <a href="<?= Redirect::seller('order/return-requested/reject')->withQuery(['id' => $order['order_id']])->getUrl() ?>" class="pt-1 text-red-500 hover:underline">Từ chối</a>
            <?php elseif ($order['order_status'] == 'return-approved'): ?>
                <a href="<?= Redirect::seller('order/return-approved')->withQuery(['id' => $order['order_id']])->getUrl() ?>" class="pt-1 text-green-500 hover:underline">Đã nhận hàng</a>
            <?php endif; ?>
        </td>
    </tr>
<?php endforeach; ?>