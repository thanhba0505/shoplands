<?php
// Nhóm dữ liệu $carts theo seller_id và product_variant_id
$groupedCarts = [];
foreach ($carts as $cart) {
    $sellerId = $cart['seller_id'];
    $variantId = $cart['variant_id'];

    // Tạo nhóm theo seller_id và product_variant_id
    if (!isset($groupedCarts[$sellerId])) {
        $groupedCarts[$sellerId] = [
            'seller_id' => $cart['seller_id'],
            'seller_name' => $cart['seller_name'],
            'products' => [],
        ];
    }

    // Nếu product_variant_id đã tồn tại, chỉ cần thêm phân loại
    if (isset($groupedCarts[$sellerId]['products'][$variantId])) {
        $groupedCarts[$sellerId]['products'][$variantId]['attributes'][] = [
            'attribute_name' => $cart['product_attribute'],
            'attribute_value' => $cart['product_attribute_value'],
        ];
    } else {
        // Nếu product_variant_id chưa tồn tại, thêm sản phẩm mới
        $groupedCarts[$sellerId]['products'][$variantId] = [
            'product_id' => $cart['product_id'],
            'product_name' => $cart['product_name'],
            'cart_quantity' => $cart['cart_quantity'],
            'cart_id' => $cart['cart_id'],
            'product_price' => $cart['product_price'],
            'product_promotion_price' => $cart['product_promotion_price'],
            'attributes' => [
                [
                    'attribute_name' => $cart['product_attribute'],
                    'attribute_value' => $cart['product_attribute_value'],
                ]
            ],
        ];
    }
}
?>

<div class="flex flex-col" x-data="cartHandler()">
    <div class="w-full overflow-x-auto">
        <table class="table-auto border-separate border-spacing-y-2 w-full">
            <?php if (!empty($groupedCarts)): ?>
                <?php foreach ($groupedCarts as $group): ?>
                    <tr class="border-b border-gray-300 bg-blue-50">
                        <td class="w-24 py-4">
                            <!-- <input type="checkbox" class="h-5 w-5 border border-gray-300 rounded checked:bg-blue-500"> -->
                            <input type="checkbox"
                                class="h-5 w-5 border border-gray-300 rounded checked:bg-blue-500"
                                x-model="sellers['<?= $group['seller_id'] ?>'].checked"
                                @change="toggleSeller('<?= $group['seller_id'] ?>')">
                        </td>
                        <td colspan="2">
                            <a href="<?= Redirect::shop()->withQuery(['id' => $group['seller_id']])->getUrl() ?>" class="text-blue-600 hover:underline">
                                <?= Util::encodeHtml($group['seller_name']) ?>
                            </a>
                        </td>
                        <td class="text-center">Phân loại</td>
                        <td class="text-center">Đơn giá</td>
                        <td class="text-center">Số lượng</td>
                        <td class="text-center">Tổng tiền</td>
                        <td class="text-center">Hành động</td>
                    </tr>

                    <?php foreach ($group['products'] as $product): ?>
                        <?php
                        $quantity = (int)$product['cart_quantity'];
                        $price = (float)($product['product_promotion_price'] ?: $product['product_price']);
                        $amount = $price * $quantity;

                        // Tạo chuỗi HTML cho các phân loại
                        $attributesHtml = '';
                        if (!empty($product['attributes'])) {
                            foreach ($product['attributes'] as $attribute) {
                                // Chỉ nối chuỗi khi có dữ liệu phân loại
                                if (!empty($attribute['attribute_name']) && !empty($attribute['attribute_value'])) {
                                    $attributesHtml .= sprintf(
                                        '<div>%s: %s</div>',
                                        Util::encodeHtml($attribute['attribute_name']),
                                        Util::encodeHtml($attribute['attribute_value'])
                                    );
                                }
                            }
                        }

                        ?>
                        <tr>
                            <td class="w-24">
                                <!-- <input type="checkbox" class="h-5 w-5 border border-gray-300 rounded checked:bg-blue-500"> -->
                                <input type="checkbox"
                                    class="h-5 w-5 border border-gray-300 rounded checked:bg-blue-500"
                                    x-model="sellers['<?= $group['seller_id'] ?>'].products['<?= $product['cart_id'] ?>'].checked"
                                    @change="toggleProduct('<?= $group['seller_id'] ?>')">
                            </td>
                            <td class="w-24">
                                <a href="<?= Redirect::product('detail')->withQuery(['id' => $product['product_id']])->getUrl() ?>" class="w-24 h-24">
                                    <img src="<?= BASE_URL ?>/public/uploads/img/cap-sac.webp" alt="Product" class="w-24 h-24 object-cover">
                                </a>
                            </td>
                            <td>
                                <a href="<?= Redirect::product('detail')->withQuery(['id' => $product['product_id']])->getUrl() ?>" class="line-clamp-2 font-semibold text-base px-4">
                                    <?= Util::encodeHtml($product['product_name']) ?>
                                </a>
                            </td>
                            <td class="text-center">
                                <?= $attributesHtml ?>
                            </td>
                            <td class="text-center">
                                <?= Util::formatCurrency($price) ?>
                            </td>
                            <td class="text-center">
                                <!-- <input type="number" value="<?= Util::encodeHtml($product['cart_quantity']) ?>" class="form-input w-16 text-center border border-gray-300 rounded"> -->
                                <input type="number"
                                    x-model.number="sellers['<?= $group['seller_id'] ?>'].products['<?= $product['cart_id'] ?>'].quantity"
                                    min="1"
                                    class="form-input w-16 text-center border border-gray-300 rounded"
                                    @input="updateProductPrice('<?= $group['seller_id'] ?>', '<?= $product['cart_id'] ?>')">
                            </td>
                            <td class="text-center">
                                <?= Util::formatCurrency($amount) ?>
                            </td>
                            <td class="text-center">
                                <a href="<?= Redirect::cart('delete')->withQuery(['id' => $product['cart_id']])->getUrl() ?>" class="text-red-600 hover:underline">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>


        <div class="flex items-center justify-between py-4 px-6">
            <button class="btn btn-outline border px-6 py-2">Xóa tất cả</button>
            <div class="text-lg">Tổng thanh toán: <span x-text="formatCurrency(totalAmount)"></span></div>
            <a href="#" class="btn px-6 py-2 bg-blue-500 text-white">Mua hàng</a>
        </div>
    </div>

    <div class="w-full mt-8">
        <h2 class="text-center text-xl text-gray-700">Có thể bạn cũng thích</h2>
    </div>
</div>

<script>
    function cartHandler() {
        return {
            sellers: {},
            totalAmount: 0,

            init() {
                // Khởi tạo dữ liệu từ PHP
                <?php foreach ($groupedCarts as $group): ?>
                    this.sellers['<?= Util::encodeHtml($group['seller_id']) ?>'] = {
                        checked: false,
                        products: <?= json_encode(array_reduce($group['products'], function ($carry, $product) {
                                        $carry[$product['cart_id']] = [
                                            'checked' => false,
                                            'price' => Util::encodeHtml($product['product_promotion_price']) ?: Util::encodeHtml($product['product_price']),
                                            'quantity' => Util::encodeHtml($product['cart_quantity'])
                                        ];
                                        return $carry;
                                    }, [])) ?>
                    };
                <?php endforeach; ?>
            },

            toggleSeller(sellerId) {
                const seller = this.sellers[sellerId];
                const allChecked = seller.checked;

                // Nếu chọn seller, bỏ chọn toàn bộ seller khác
                this.resetAllExcept(sellerId);

                // Check hoặc bỏ check toàn bộ sản phẩm của seller
                for (const productId in seller.products) {
                    seller.products[productId].checked = allChecked;
                }

                this.updateTotals();
            },

            toggleProduct(sellerId) {
                const seller = this.sellers[sellerId];
                const allChecked = Object.values(seller.products).every(product => product.checked);

                // Nếu tất cả sản phẩm được chọn, check seller; ngược lại, bỏ check seller
                seller.checked = allChecked;

                // Nếu sản phẩm trong seller này được chọn, bỏ check toàn bộ sản phẩm của seller khác
                this.resetAllExcept(sellerId);

                this.updateTotals();
            },

            resetAllExcept(sellerId) {
                for (const otherSellerId in this.sellers) {
                    if (otherSellerId !== sellerId) {
                        this.sellers[otherSellerId].checked = false;
                        for (const productId in this.sellers[otherSellerId].products) {
                            this.sellers[otherSellerId].products[productId].checked = false;
                        }
                    }
                }
            },

            updateProductPrice(sellerId, productId) {
                const product = this.sellers[sellerId].products[productId];

                // Giữ giá trị số lượng hợp lệ (ít nhất là 1)
                if (product.quantity < 1) {
                    product.quantity = 1;
                }

                // Tính lại tổng
                this.updateTotals();
            },

            updateTotals() {
                this.totalAmount = 0;

                for (const sellerId in this.sellers) {
                    const seller = this.sellers[sellerId];

                    for (const productId in seller.products) {
                        const product = seller.products[productId];

                        if (product.checked) {
                            this.totalAmount += product.price * product.quantity;
                        }
                    }
                }
            },

            formatCurrency(amount) {
                return new Intl.NumberFormat('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                }).format(amount);
            }
        };
    }
</script>