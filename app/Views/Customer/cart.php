<?php
// Nhóm dữ liệu $carts theo seller_id
$groupedCarts = [];
foreach ($carts as $cart) {
    $groupedCarts[$cart['seller_id']]['seller_id'] = $cart['seller_id'];
    $groupedCarts[$cart['seller_id']]['seller_name'] = $cart['seller_name'];
    $groupedCarts[$cart['seller_id']]['products'][] = $cart;
}
?>


<div class="flex flex-col">
    <div class="w-full overflow-x-auto">
        <table class="table-auto border-separate border-spacing-y-2 w-full">

            <?php if (!empty($groupedCarts)): ?>
                <?php foreach ($groupedCarts as $sellerId => $group): ?>
                    <!-- header cart -->
                    <tr class="border-b border-gray-300 bg-blue-50">
                        <td class="w-24 py-4">
                            <div class="flex ml-9">
                                <input type="checkbox" id="checkbox" class="appearance-none h-5 w-5 border border-gray-300 rounded checked:bg-blue-500">
                            </div>
                        </td>
                        <td colspan="2">
                            <div class="flex"><a href="<?= Redirect::shop() . '/' . $group['seller_id'] ?>" class="text-blue-600 hover:underline"><?= $group['seller_name'] ?></a></div>
                        </td>
                        <td class="text-center text-lg">Phân loại</td>
                        <td class="text-center text-lg">Đơn giá</td>
                        <td class="text-center text-lg">Số lượng</td>
                        <td class="text-center text-lg">Tổng tiền</td>
                        <td class="text-center text-lg">Hành động</td>
                    </tr>

                    <!-- product item -->
                    <?php foreach ($group['products'] as $product): ?>
                        <tr>
                            <td class="w-24">
                                <div class="flex ml-9">
                                    <input type="checkbox" id="checkbox" class="appearance-none h-5 w-5 border border-gray-300 rounded checked:bg-blue-500">
                                </div>
                            </td>
                            <td class="w-24">
                                <div class="w-24 h-24"><img src="<?= BASE_URL ?>/public/uploads/img/cap-sac.webp" alt="" class="w-full h-full object-cover"></div>
                            </td>
                            <td>
                                <a href="#" class="line-clamp-2 font-semibold text-base px-4"><?= $product['product_name'] ?></a>
                            </td>
                            <td class="w-36 text-center">
                                <span class="block text-sm font-bold"><?= htmlspecialchars($product['product_attribute']) ?>: <?= htmlspecialchars($product['product_attribute_value']) ?></span>
                            </td>
                            <td class="w-36 text-center">
                                <?php if ($product['product_promotion_price'] != ''): ?>
                                    <span class="block line-through text-sm"><?= number_format($product['product_price'], 0, ',', '.') ?>đ</span>
                                    <span class="block text-lg font-bold text-red-600">
                                        <?= number_format($product['product_promotion_price'], 0, ',', '.') ?> Vnđ
                                    </span>
                                <?php else: ?>
                                    <span class="font-bold text-lg text-red-600"><?= number_format($product['product_price'], 0, ',', '.') ?> Vnđ</span>
                                <?php endif; ?>
                            </td>
                            <td class="w-36 text-center">
                                <input type="number" value="<?= $product['cart_quantity'] ?>" class="form-input w-16 mx-auto text-center border border-gray-300 rounded">
                            </td>
                            <td class="w-36 text-center">

                                <span class="font-bold text-lg text-red-600">
                                    <?php if ($product['product_promotion_price'] != '')
                                        echo number_format($product['product_promotion_price'] * $product['cart_quantity'], 0, ',', '.');
                                    else
                                        echo number_format($product['product_price'] * $product['cart_quantity'], 0, ',', '.');
                                    ?> Vnđ
                                </span>
                            </td>
                            <td class="w-36 text-center">
                                <a href="<?= Redirect::cart() . '/delete/' . $product['cart_id'] ?>" class="text-red-600 hover:underline">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    <!-- khuyen mai -->
                    <tr class="border-t border-gray-300">
                        <td></td>
                        <td colspan="7">
                            <div class="text-gray-600 flex align-middle gap-x-3 mt-4">
                                <i class="fa-solid fa-ticket text-xl"></i>
                                Xem tất cả voucher của shop
                            </div>
                        </td>
                    </tr>

                    <tr class="border-t border-gray-300">
                        <td></td>
                        <td colspan="7">
                            <div class="text-gray-600 flex align-middle gap-x-3">
                                <i class="fa-solid fa-ticket text-xl"></i>
                                Giảm 20.000đ phí vận chuyển đơn tối thiểu 150.000đ; Miễn phí vận chuyển cho đơn từ 350.000đ
                            </div>
                        </td>
                    </tr>

                    <tr class="">
                        <td colspan="8" class="py-3">
                            <div class="h-px bg-gray-300"></div>
                        </td>
                    </tr>

                <?php endforeach; ?>
            <?php endif; ?>
        </table>

        <div class="flex items-center justify-between py-4 px-6">
            <button class="btn btn-outline border px-6 py-2">Xóa tất cả</button>
            <div class="text-lg">Tổng thanh toán (0 sản phẩm): 0 VNĐ</div>
            <a href="#" class="btn px-6 py-2 bg-blue-500 text-white">Mua hàng</a>
        </div>
    </div>

    <div class="w-full mt-8">
        <h2 class="text-center text-xl text-gray-700">Có thể bạn cũng thích</h2>
    </div>
</div>