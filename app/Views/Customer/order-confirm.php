<div class="">
    Địa chỉ nhận hàng:
    <?php if (!$address): ?>
        Chưa có địa chỉ
    <?php else: ?>
        <?= $address['a_province'] . ' - ' . $address['a_line'] ?>
    <?php endif; ?>
</div>

<div class="mt-6">
    Sản phẩm:
    <table class="table-auto border-separate border-spacing-y-2 w-full">
        <?php foreach ($products as $product): ?>
            <tr>
                <td class="w-24">
                    <div class="w-24 h-24">
                        <img src="<?= Asset::getProduct($product['i_path']) ?>" alt="product" class="w-24 h-24 object-cover">
                    </div>
                </td>
                <td>
                    <div class="line-clamp-2 w-72 font-semibold text-base px-4">
                        <?= Util::encodeHtml($product['p_name']) ?>
                    </div>
                </td>
                <td class="text-center">
                    <?php
                    $productAttributes = $product['attributes'];
                    $html = '';

                    foreach ($productAttributes as $attributes) {
                        $name = Util::encodeHtml($attributes['name']);
                        $value = Util::encodeHtml($attributes['value']);

                        echo sprintf('<p>%s: %s</p>', $name, $value);
                    }
                    ?>
                </td>
                <td class="text-center">
                    <?php if ($product['pv_promotion_price'] != null): ?>
                        <del class="text-xs"><?= Util::formatCurrency($product['pv_price']) ?></del>
                        <br>
                        <div class="font-bold text-red-600" id="price-<?= $product['c_id'] ?>"><?= Util::formatCurrency($product['pv_promotion_price']) ?></div>
                    <?php else: ?>
                        <div class="font-bold text-red-600" id="price-<?= $product['c_id'] ?>"><?= Util::formatCurrency($product['pv_price']) ?></div>
                    <?php endif; ?>
                </td>
                <td class="text-center">
                    <?= Util::encodeHtml($product['c_quantity']) ?>
                </td>
                <td class="text-center" id="total-price-<?= $product['c_id'] ?>">
                    <?= Util::formatCurrency(($product['pv_promotion_price'] ? $product['pv_promotion_price'] : $product['pv_price']) * $product['c_quantity']) ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<div class="mt-6">
    Phương thức vận chuyển:
    <?php if (empty($shippingFees)): ?>
        Chưa có phương thức vận chuyển
    <?php else: ?>
        <?php foreach ($shippingFees as $key => $shippingFee): ?>
            <?= Other::radio($shippingFee['sf_method'] . ' - ' . Util::formatCurrency($shippingFee['sf_fee']), ['checked' => $key == 0, 'name' => 'shipping_fee']) ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<div class="mt-6">
    Voucher

</div>

<div class="mt-6">
    Phương thức thanh toán:


</div>