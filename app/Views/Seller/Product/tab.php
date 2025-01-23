<?php foreach ($products as $product): ?>
    <tr class="text-center">
        <td class="border border-blue-300 px-4 py-2"><?= Util::encodeHtml($product['product_id']) ?></td>
        <td class="border border-blue-300 px-4 py-2">
            <div class="gap-3 py-2 flex flex-col">
                <div class="flex items-center gap-x-4">
                    <img src="<?= BASE_URL ?>/public/uploads/img/cap-sac.webp" alt="" class="w-10 h-10 border border-blue-300">
                    <span class="line-clamp-2 w-20 flex-1 pe-4 text-start"><?= Util::encodeHtml($product['product_name']) ?></span>
                </div>
            </div>
        </td>
        <td class="border border-blue-300 px-4 py-2"><?= Util::encodeHtml($product['category']) ?></td>
        <td class="border border-blue-300 px-4 py-2">
            <?php if ($product['min_product_price'] == $product['max_product_price']): ?>
                <?= Util::formatCurrency($product['min_product_price']) ?>
            <?php else: ?>
                <?= Util::formatCurrency($product['min_product_price']) . ' - ' . Util::formatCurrency($product['max_product_price']) ?>
            <?php endif; ?>
        </td>
        <td class="border border-blue-300 px-4 py-2"><?= Util::encodeHtml($product['sold_quantity']) ?></td>
        <td class="border border-blue-300 px-4 py-2"><?= Util::encodeHtml($product['quantity']) ?></td>
        <td class="border border-blue-300 px-4 py-2"><?= Util::encodeHtml($listProductStatus[$product['product_status']]) ?></td>
        <td class="border border-blue-300 px-4 py-2">Chi tiết</td>
    </tr>
<?php endforeach; ?>