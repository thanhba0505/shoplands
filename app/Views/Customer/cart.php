<form action="<?= Redirect::order('confirm')->getUrl() ?>" method="post">
    <?= CSRF::input(); ?>
    <div class="flex flex-col">
        <div class="w-full">
            <table id="cart-table" class="table-auto border-separate border-spacing-y-2 w-full">
                <?php if (!empty($groupedCarts)): ?>
                    <?php foreach ($groupedCarts as $group): ?>
                        <tr class="border-b border-gray-300 bg-blue-50">
                            <td class="w-24 py-4">
                                <?= Other::checkbox('s_ids[]', $group['s_id'], '', false, ['data-group' => $group['s_id']]); ?>
                            </td>
                            <td colspan="2">
                                <a href="<?= Redirect::shop()->withQuery(['id' => $group['s_id']])->getUrl() ?>" class="text-blue-600 hover:underline">
                                    <?= Util::encodeHtml($group['s_name']) ?>
                                </a>
                            </td>
                            <td class="text-center">Phân loại</td>
                            <td class="text-center">Đơn giá</td>
                            <td class="text-center">Số lượng</td>
                            <td class="text-center">Tổng tiền</td>
                            <td class="text-center">Hành động</td>
                        </tr>

                        <?php foreach ($group['products'] as $product): ?>
                            <tr>
                                <td class="w-24">
                                    <?= Other::checkbox('c_ids[]', $product['c_id'], '', false, [
                                        'data-group' => $group['s_id'],
                                        'data-cart-id' => $product['c_id'], // Đổi thành data-cart-id
                                    ]); ?>
                                </td>
                                <td class="w-24">
                                    <a href="<?= Redirect::product('detail')->withQuery(['id' => $product['p_id']])->getUrl() ?>" class="w-24 h-24">
                                        <img src="<?= Asset::getProduct($product['i_path']) ?>" alt="product" class="w-24 h-24 object-cover">
                                    </a>
                                </td>
                                <td>
                                    <a href="<?= Redirect::product('detail')->withQuery(['id' => $product['p_id']])->getUrl() ?>" class="line-clamp-2 w-72 font-semibold text-base px-4">
                                        <?= Util::encodeHtml($product['p_name']) ?>
                                    </a>
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
                                    <?= Util::formatCurrency($product['pv_price']) ?>
                                </td>
                                <td class="text-center">
                                    <div class="flex items-center" id="counter-<?= $product['c_id'] ?>">
                                        <?= Other::button('-', 'light', ['type' => 'button']) ?>
                                        <?= Other::inputNumber('quantity[]', $product['c_quantity'], [
                                            'data-cart-id' => $product['c_id'], // Đổi thành data-cart-id
                                        ]) ?>
                                        <?= Other::button('+', 'light', ['type' => 'button']) ?>
                                    </div>
                                    <script>
                                        $(document).ready(function() {
                                            counter("#counter-<?= $product['c_id'] ?>", 1, <?= $product['pv_quantity'] ?>);
                                        });
                                    </script>
                                </td>
                                <td class="text-center">
                                    <?= Util::formatCurrency($product['pv_price']) ?>
                                </td>
                                <td class="text-center">
                                    <button type="button" data-cart-id="<?= $product['c_id'] ?>" class="delete-cart-button text-red-600 hover:underline">Xóa</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>

            <div id="empty-cart-message" class="text-center text-gray-600 h-80 flex items-center justify-center flex-col gap-y-4" style="display: none;">
                Chưa có sản phẩm nào trong giỏ hàng
                <div class="w-48"><?= Other::buttonLink('Mua ngay', Redirect::product()->getUrl(), 'light') ?></div>
            </div>
        </div>

        <!-- Phần tử sticky -->
        <div id="cart-footer" class="flex items-center justify-between py-4 px-6 sticky bottom-0  bg-white border-t-2 mt-4">
            <button class="btn btn-outline border px-6 py-2">Xóa tất cả</button>

            <button type="submit" class="btn px-6 py-2 bg-blue-500 text-white">Mua hàng</button>
        </div>
    </div>
</form>

<!-- Gợi ý sản phẩm -->
<div class="mt-10">
    <div class="text-center text-xl font-bold py-3 bg-gray-100 text-gray-800">Gợi ý cho bạn</div>
    <div class="grid grid-cols-12 gap-4 mt-4">

        <!-- Product Item -->
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <div class="col-span-2">
                    <a href="<?= Redirect::product('detail')->withQuery(['id' => $product['id']])->getUrl() ?>" class="flex flex-col items-start p-4 border rounded-lg hover:shadow-md">
                        <img class="mb-3 w-full h-48 object-cover" src="<?= Asset::getProduct($product['image_path']) ?>" alt="<?= Util::encodeHtml($product['name']) ?>">
                        <span class="line-clamp-2 h-10 w-full font-bold leading-tight"><?= Util::encodeHtml($product['name']) ?></span>
                        <div class="flex items-center mt-2">
                            <?php
                            $rating = round($product['rating'] ?? 0);
                            for ($star = 1; $star <= 5; $star++):
                            ?>
                                <?php if ($star <= $rating): ?>
                                    <i class="fa-solid fa-star text-yellow-400"></i>
                                <?php else: ?>
                                    <i class="fa-regular fa-star text-gray-400"></i>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </div>
                        <div class="mt-2 flex items-center justify-between w-full">
                            <?php if ($product['promotion_price']): ?>
                                <span class="line-through text-sm text-gray-500"><?= Util::formatCurrency($product['price']) ?></span>
                                <span class="text-red-500 font-bold text-lg"><?= Util::formatCurrency($product['promotion_price']) ?></span>
                            <?php else: ?>
                                <span class="text-red-500 font-bold text-lg text-end w-full"><?= Util::formatCurrency($product['price']) ?></span>
                            <?php endif; ?>
                        </div>
                        <span class="text-sm w-full text-gray-600 text-end">Đã bán <?= Util::encodeHtml($product['sold_quantity']) ?? 0 ?></span>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>


        <!-- Thêm các sản phẩm khác tương tự -->
    </div>
    <div class="flex justify-center mt-5">
        <a href="#" class="px-5 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Xem thêm</a>
    </div>
</div>

<script>
    $(document).ready(function() {
        checkboxGroup();
        submitFormCart();
        checkTable();
        deleteCart('<?= Redirect::cart('delete', true)->getUrl() ?>', '<?= CSRF::getToken() ?>');
    });
</script>