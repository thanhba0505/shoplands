<div class="">
    Địa chỉ nhận hàng:
    <?php if (!$address): ?>
        Chưa có địa chỉ
    <?php else: ?>
        <?= Util::encodeHtml($address['a_province'] . ' - ' . $address['a_line']) ?>
    <?php endif; ?>
</div>
<form action="<?= Redirect::order('checkout')->getUrl() ?>" method="POST">
    <?= CSRF::input() ?>
    <div class="mt-6">
        Sản phẩm:
        <table class="table-auto border-separate border-spacing-y-2 w-full">
            <?php foreach ($products as $product): ?>
                <tr>
                    <td class="w-24">
                        <input type="hidden" name="c_ids[]" value="<?= Util::encodeHtml($product['c_id']) ?>">
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
                            <div class="font-bold text-red-600" id="price-<?= Util::encodeHtml($product['c_id']) ?>"><?= Util::formatCurrency($product['pv_promotion_price']) ?></div>
                        <?php else: ?>
                            <div class="font-bold text-red-600" id="price-<?= Util::encodeHtml($product['c_id']) ?>"><?= Util::formatCurrency($product['pv_price']) ?></div>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <?= Util::encodeHtml($product['c_quantity']) ?>
                    </td>
                    <td class="text-center" id="total-price-<?= Util::encodeHtml($product['c_id']) ?>">
                        <?= Util::formatCurrency(($product['pv_promotion_price'] ? $product['pv_promotion_price'] : $product['pv_price']) * $product['c_quantity']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <div class="mt-6">
        <p>Phương thức vận chuyển:</p>
        <?php if (empty($shippingFees)) : ?>
            <p class="text-gray-500">Thêm địa chỉ để chọn phương thức vận chuyển</p>
        <?php else : ?>
            <?php foreach ($shippingFees as $key => $shippingFee) : ?>
                <?= Other::radio($shippingFee['sf_method'] . ' - ' . Util::formatCurrency($shippingFee['sf_fee']), ['checked' => $key == 0, 'name' => 'sf_id', 'value' => $shippingFee['sf_id'], 'data-fee' => $shippingFee['sf_fee']]) ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <div class="mt-6">
        <p>Mã giảm giá:</p>
        <div class="overflow-y-auto max-h-72 w-full p-1 scroll scroll-smooth">
            <div class="grid grid-cols-2 gap-4">
                <?php foreach ($coupons as $coupon) : ?>
                    <?php
                    $isDisabled = Util::encodeHtml($subtotalPrice) < Util::encodeHtml($coupon['cp_minimum_order_value']);
                    $couponId = Util::encodeHtml($coupon['cp_id']);
                    ?>
                    <div class="coupon-item p-4 rounded-lg shadow-md border transition-all duration-200 flex flex-col justify-between <?= $isDisabled ? 'bg-gray-200 opacity-50 cursor-default' : 'cursor-pointer' ?>"
                        data-coupon-id="<?= $couponId ?>"
                        data-discount-type="<?= Util::encodeHtml($coupon['cp_discount_type']) ?>"
                        data-discount-value="<?= Util::encodeHtml($coupon['cp_discount_value']) ?>"
                        data-min-order="<?= Util::encodeHtml($coupon['cp_minimum_order_value']) ?>"
                        data-max-discount="<?= Util::encodeHtml($coupon['cp_maximum_discount'] ?? 0) ?>">
                        <div class="flex justify-between">
                            <div>
                                <h3 class="text-lg font-bold"><?= Util::encodeHtml($coupon['cp_code']) ?></h3>
                                <p class="text-sm text-gray-600"><?= Util::encodeHtml($coupon['cp_description']) ?></p>
                            </div>
                            <div class="text-sm text-gray-600 text-end">
                                <p>Giảm
                                    <b class="text-xl text-red-600">
                                        <?= $coupon['cp_discount_type'] === 'fixed' ? Util::formatCurrency($coupon['cp_discount_value']) : Util::encodeHtml($coupon['cp_discount_value']) . '%' ?>
                                    </b>
                                </p>
                                <p>Đơn tối thiểu: <?= Util::formatCurrency($coupon['cp_minimum_order_value']) ?></p>
                                <?php if ($coupon['cp_discount_type'] === 'percentage') : ?>
                                    <p>Giảm tối đa: <b><?= Util::formatCurrency($coupon['cp_maximum_discount']) ?></b></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="flex justify-between text-sm text-gray-600 mt-2">
                            <p class="">
                                Đã sử dụng: <?= Util::encodeHtml($coupon['cp_usage_count']) ?>/<?= Util::encodeHtml($coupon['cp_usage_limit']) ?>
                            </p>
                            <p>HSD: <?= Util::formatDate($coupon['cp_end_date']) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <input type="hidden" name="cp_id" id="selected-coupon-id" value="">
    </div>

    <div class="mt-6">
        Phương thức thanh toán:

        <?= Other::radio('Thanh toán qua QR ngân hàng', ['checked' => true, 'name' => 'payment_method', 'value' => 'QR']) ?>
        <?= Other::radio('Thanh toán khi giao hàng', ['checked' => false, 'name' => 'payment_method', 'value' => 'COD']) ?>
    </div>

    <div class="mt-6 grid grid-cols-2 gap-4 w-96 ml-auto">
        <div class="text-start">
            <p>Tổng tiền sản phẩm:</p>
            <p>Phí vận chuyển:</p>
            <p>Phiếu giảm giá:</p>
            <p class="font-bold text-lg">Tổng thanh toán:</p>
        </div>
        <div class="text-end">
            <p><span id="subtotal"><?= Util::formatCurrency($subtotalPrice) ?></span></p>
            <p><span id="shipping-fee"><?= Util::formatCurrency(0) ?></span></p>
            <p><span id="discount"><?= Util::formatCurrency(0) ?></span></p>
            <p class="font-bold text-lg"><span id="total"><?= Util::formatCurrency($subtotalPrice) ?></span></p>
        </div>
    </div>

    <div class="mt-6 text-end">
        <div class="w-48 ml-auto"> <?= Other::button('Thanh toán', 'dark', ['type' => 'submit', 'disabled' => empty($shippingFees)]) ?></div>
    </div>
</form>
<script>
    $(document).ready(function() {
        applyCouponAndShippingFee(<?= Util::encodeHtml($subtotalPrice) ?>);
    });
</script>