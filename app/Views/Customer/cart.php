<div class="flex flex-col"">
    <div class=" w-full overflow-x-auto">
    <table class="table-auto border-separate border-spacing-y-2 w-full">
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

                            <?= Other::checkbox('c_ids[]', $product['c_id'], '', false, ['data-group' => $group['s_id']]); ?>

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
                            <div class="flex items-center">
                                <?= Other::button('-') ?>
                                <?= Other::inputNumber('quantity', $product['c_quantity'], ['min' => 1, 'max' => $product['pv_quantity']]) ?>
                            </div>
                        </td>
                        <td class="text-center">
                            <?= Util::formatCurrency($product['pv_price']) ?>
                        </td>
                        <td class="text-center">
                            <a href="<?= Redirect::cart('delete')->withQuery(['id' => $product['c_id']])->getUrl() ?>" class="text-red-600 hover:underline">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
        <?php endif; ?>

        <tr>
            <td><button class="sticky bottom-0">Xóa tất cả</button></td>
        </tr>
    </table>


    <div class="flex items-center justify-between py-4 px-6 sticky bottom-0 h-96 bg-yellow-50">
        <button class="btn btn-outline border px-6 py-2">Xóa tất cả</button>
        <!-- <div class="text-lg">Tổng thanh toán: <span x-text="formatCurrency(totalAmount)"></span></div> -->



        <a href="#" class="btn px-6 py-2 bg-blue-500 text-white">Mua hàng</a>
    </div>
</div>

<div class="w-full mt-8">
    <h2 class="text-center text-xl text-gray-700 " style="height: 1000px;">Có thể bạn cũng thích</h2>
</div>

<script>
    $(document).ready(function() {
        checkboxGroup();
    });
</script>