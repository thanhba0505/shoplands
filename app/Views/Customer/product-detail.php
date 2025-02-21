<!-- Sản phẩm -->
<div class=" mx-auto bg-white  rounded-lg p-6">
    <!-- Product Images and Details -->
    <div class="grid grid-cols-5 gap-6">
        <!-- Images -->
        <div class="col-span-2">

            <!-- Mặc định hiển thị -->
            <?php
            $defaultImage = null;

            // Kiểm tra danh sách ảnh và tìm ảnh mặc định
            if (!empty($images)) {
                foreach ($images as $image) {
                    if (!empty($image['is_default']) && $image['is_default'] == 1) {
                        $defaultImage = $image['path'];
                        break;
                    }
                }
            }
            ?>

            <?php if ($defaultImage): ?>
                <img id="main-img" class="w-full h-full object-cover max-w-[550px] max-h-[550px] rounded-md"
                    src="<?= Asset::getProduct($defaultImage) ?>"
                    alt="<?= Asset::getProduct($defaultImage) ?>">
            <?php else: ?>
                <img class="w-full h-16 rounded-md cursor-pointer" src="" alt="error">
            <?php endif; ?>


            <!-- Danh sách ảnh -->
            <div class="relative mt-4">
                <button id="prev-btn" class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-gray-300 rounded-full w-8 h-8 flex items-center justify-center">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
                <div id="thumbnails" class="grid grid-cols-5 gap-2 px-10">
                    <?php if (!empty($images)): ?>
                        <?php foreach ($images as $image): ?>
                            <img class="size-24 border border-1 border-gray rounded-md cursor-pointer object-contain" src="<?= Asset::getProduct($image['path']) ?>" alt="<?= Asset::getProduct($image['path']) ?>">
                        <?php endforeach; ?>
                    <?php else: ?>
                        <img class="w-full h-16 rounded-md cursor-pointer" src="" alt="error">
                    <?php endif; ?>
                </div>
                <button id="next-btn" class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-gray-300 rounded-full w-8 h-8 flex items-center justify-center">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            </div>
            <script>
                $(document).ready(function() {
                    imgTransfer()
                })
            </script>
        </div>

        <!-- Product Details -->
        <div class="col-span-3">
            <h1 class="text-2xl mb-2"><?= Util::encodeHtml($product['product_name']) ?></h1>

            <!-- Đánh giá -->
            <div class="flex items-center justify-between text-gray-700 text-sm mb-4">
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-1">
                        <span class="text-lg font-semibold"><?= Util::formatNumber($reviews['averageRating'], 1) ?: 0 ?></span>
                        <?= Other::ratingStar($reviews['averageRating'], 'text-xs') ?>
                    </div>
                    <div><?= Util::formatNumberShort($reviews['total']) ?> Đánh Giá</div>
                    <div>| <?= Util::formatNumberShort($product['sold_quantity']) ?> Đã bán</div>
                </div>
            </div>

            <div class="bg-gray-100 p-4 rounded-lg mb-4 flex items-center gap-4 w-full">
                <span id="price" class="text-2xl font-semibold text-red-500"></span>
                <span id="old-price" class="text-gray-500 line-through"></span>
                <span id="discount" class="bg-red-100 text-red-500 text-sm font-medium px-2 py-1 rounded"></span>
            </div>

            <div class="mt-8 grid grid-cols-12 gap-4 items-center">
                <!-- Vận Chuyển -->
                <div class="col-span-3 text-gray-600 font-medium">Vận Chuyển</div>
                <div class="col-span-9 flex items-center gap-2">
                    <i class="fa-solid fa-truck-fast text-green-600"></i>
                    <p class="text-gray-800">
                        Đảm bảo nhận hàng trong 2 ngày với Giao hàng nhanh
                    </p>
                </div>

                <!-- An Tâm Mua Sắm -->
                <div class="col-span-3 text-gray-600 font-medium leading-6">An Tâm Mua<br>Sắm Cùng<br>Shopee</div>
                <div class="col-span-9 flex items-center gap-2">
                    <i class="fa-solid fa-location-pin text-red-600"></i>
                    <p class="text-gray-800">
                        Trả hàng miễn phí 15 ngày
                    </p>
                </div>

                <?php foreach ($attributes as $attributeId => $attribute): ?>
                    <div class="col-span-3 text-gray-600 font-medium"><?= $attribute['name'] ?></div>
                    <div class="col-span-9 flex flex-wrap gap-4">
                        <?php foreach ($attribute['values'] as $valueId => $value): ?>
                            <button
                                data-attribute-id="<?= $attributeId ?>"
                                data-value-id="<?= $valueId ?>"
                                class="attribute-option flex flex-col text-gray-800 items-center border px-4 py-2 rounded-md text-center hover:border-blue-500">
                                <?= $value ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>

                <script>
                    var productVariants = <?= json_encode($productVariant) ?>;

                    $(document).ready(function() {
                        showPriceAndAddToCartProductDetail(productVariants, '<?= Redirect::cart(api: true)->getUrl() ?>');
                    });
                </script>

                <!-- Số lượng -->
                <div class="col-span-3 text-gray-600 font-medium">Số lượng</div>
                <div class=" col-span-6 flex items-center gap-2">
                    <div class="counter-container flex items-center border rounded-md">
                        <button class="w-10 h-10 flex items-center justify-center text-gray-500 hover:text-gray-800 border-r">
                            -
                        </button>
                        <input
                            id="quantity"
                            type="text"
                            name="quantity"
                            value="1"
                            class="w-12 h-10 text-center focus:outline-none text-gray-800" />
                        <button class="w-10 h-10 flex items-center justify-center text-gray-500 hover:text-gray-800 border-l">
                            +
                        </button>
                    </div>
                </div>
                <script>
                    $(document).ready(function() {
                        counter();
                    });
                </script>
            </div>

            <!-- Buttons -->
            <div class="mt-8 flex gap-4 w-full">
                <?php if (Auth::checkAuth()): ?>
                    <button id="addToCart" class="flex items-center justify-center gap-2 border border-blue-500 text-gray-500 bg-blue-50 px-4 py-2 rounded hover:bg-blue-100 w-52">
                        <i class="fa-solid fa-cart-plus"></i>
                        <span class="text-base">Thêm Vào Giỏ Hàng</span>
                    </button>

                    <button class="flex flex-col justify-center items-center bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 w-52">
                        <span class="text-base">Mua Với Voucher</span>
                        <span class="text-lg font-bold">₫204.000</span>
                    </button>
                <?php else: ?>
                    <a href="<?= Redirect::login()->getUrl() ?>" class="text-center flex items-center justify-center gap-2 border border-blue-500 text-gray-500 bg-blue-50 px-4 py-2 rounded hover:bg-blue-100 w-52">
                        <span class="text-base">Đăng nhập để thêm vào giỏ hàng</span>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Sản phẩm tương tự -->
<div class="mt-10">
    <div class="text-center text-xl font-bold py-3 bg-gray-100 text-gray-800">Sản phẩm tương tự</div>
    <div class="grid grid-cols-12 gap-4 mt-10">

        <!-- Product Item -->
        <?php if (!empty($similarProducts)): ?>
            <?php foreach ($similarProducts as $sProduct): ?>
                <div class="col-span-2">
                    <a href="<?= Redirect::product('detail')->withQuery(['id' => $sProduct['id']])->getUrl() ?>" class="flex flex-col items-start p-4 border rounded-lg hover:shadow-md">
                        <img class="mb-3 w-full h-48 object-cover" src="<?= Asset::getProduct($sProduct['image_path']) ?>" alt="<?= Util::encodeHtml($sProduct['name']) ?>">
                        <span class="line-clamp-2 h-10 w-full font-bold leading-tight"><?= Util::encodeHtml($sProduct['name']) ?></span>
                        <div class="flex items-center mt-2">
                            <?php
                            $rating = round($sProduct['rating'] ?? 0);
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
                            <?php if ($sProduct['promotion_price']): ?>
                                <span class="line-through text-sm text-gray-500"><?= Util::formatCurrency($sProduct['price']) ?></span>
                                <span class="text-red-500 font-bold text-lg"><?= Util::formatCurrency($sProduct['promotion_price']) ?></span>
                            <?php else: ?>
                                <span class="text-red-500 font-bold text-lg text-end w-full"><?= Util::formatCurrency($sProduct['price']) ?></span>
                            <?php endif; ?>
                        </div>
                        <span class="text-sm w-full text-gray-600 text-end">Đã bán <?= Util::encodeHtml($sProduct['sold_quantity']) ?? 0 ?></span>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <div class="flex justify-center mt-5">
        <a href="<?= Redirect::product()->getUrl() ?>" class="px-5 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Xem thêm</a>
    </div>
</div>

<!-- Chi tiết cửa hàng -->
<div class="p-4 mt-10 bg-white rounded-md flex items-center justify-between grid-cols-12">
    <!-- Thông tin cửa hàng -->
    <div class="flex items-center gap-4 grid-cols-4 w-full">
        <!-- Logo -->
        <img src="<?= Asset::getAvatar($seller['logo']) ?>" alt="store-logo" class="size-20 rounded-full object-cover">
        <!-- Chi tiết cửa hàng -->
        <div class="mr-12">
            <h2 class="text-lg font-semibold"><?= Util::encodeHtml($seller['name']) ?></h2>
            <div class="flex gap-2 mt-2">
                <!-- Nút Chat -->
                <!-- <button class="flex items-center gap-1 px-4 py-1 text-blue-500 border border-blue-500 rounded-md text-sm hover:bg-red-100">
                    <i class="fa-brands fa-rocketchat text-blue-600"></i>
                    Chat Ngay
                </button> -->
                <!-- Nút Xem Shop -->
                <a href="<?= Redirect::shop()->withQuery(['id' => $seller['id']])->getUrl() ?>" class="flex items-center gap-1 px-4 py-1 text-gray-500 border border-gray-300 rounded-md text-sm hover:bg-gray-100">
                    <i class="fa-solid fa-store text-blue-600"></i>
                    Xem Shop
                </a>
            </div>
        </div>

        <div class="grid grid-cols-6 gap-y-4 gap-x-8  text-gray-500">
            <!-- Hàng 1 -->
            <div class="flex justify-between items-center gap-10 col-span-3 mr-12">
                <p>Xếp hạng</p>
                <p class="text-red-500 font-semibold"><?= Util::formatNumber($seller['averageRating'], 1) ?></p>
            </div>
            <div class="flex justify-between items-center gap-10 col-span-3">
                <p>Lượt đánh giá</p>
                <p class="text-red-500 font-semibold"><?= Util::formatNumberShort($seller['countReviews']) ?></p>
            </div>

            <!-- Hàng 2 -->
            <div class="flex justify-between items-center gap-10 col-span-3 mr-12">
                <p>Sản Phẩm</p>
                <p class="text-red-500 font-semibold"><?= Util::formatNumberShort($seller['countProducts']) ?></p>
            </div>
            <!-- <div class="flex justify-between items-center gap-10 col-span-3">
                <p>Người Theo Dõi</p>
                <p class="text-red-500 font-semibold">38,7k</p>
            </div> -->
        </div>
    </div>
</div>

<!-- Chi tiết sản phẩm -->
<div class="mx-auto bg-white  rounded-lg p-6 mt-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold">CHI TIẾT SẢN PHẨM</h2>
    </div>

    <div class="mt-4 grid grid-cols-12 gap-4 items-start">
        <div class="col-span-3 text-gray-600 font-medium leading-6">Danh mục</div>
        <div class="col-span-9 flex items-center gap-2">
            <p class="text-gray-800">
                <?= Util::encodeHtml($category['name']) ?>
            </p>
        </div>
    </div>

    <div class="mt-4 grid grid-cols-12 gap-4 items-start">
        <div class="col-span-3 text-gray-600 font-medium leading-6">Đã bán</div>
        <div class="col-span-9 flex items-center gap-2">
            <p class="text-gray-800">
                <?= Util::formatNumberShort($product['sold_quantity']) ?>
            </p>
        </div>
    </div>

    <div class="mt-4 grid grid-cols-12 gap-4 items-start">
        <div class="col-span-3 text-gray-600 font-medium leading-6">Tồn kho</div>
        <div class="col-span-9 flex items-center gap-2">
            <p class="text-gray-800">
                <?= Util::formatNumberShort($product['quantity']) ?>
            </p>
        </div>
    </div>

    <?php if (!empty($productDetail)): ?>
        <?php foreach ($productDetail as $detail): ?>
            <div class="mt-4 grid grid-cols-12 gap-4 items-start">
                <div class="col-span-3 text-gray-600 font-medium leading-6"><?= Util::encodeHtml($detail['name']) ?></div>
                <div class="col-span-9 flex items-center gap-2">
                    <p class="text-gray-800">
                        <?= Util::encodeHtml($detail['description']) ?>
                    </p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>


</div>

<!-- Mô tả sản phẩm -->
<div class="mx-auto bg-white  rounded-lg p-6 mt-6">
    <h2 class="text-xl font-bold mb-4">MÔ TẢ SẢN PHẨM</h2>
    <div>
        <?= Util::nl2br($product['product_description']) ?>
    </div>
</div>

<!-- Đánh giá sản phẩm -->
<div class="mx-auto bg-white  rounded-lg p-6 mt-6">
    <!-- Header -->
    <h2 class="text-2xl font-bold mb-4">ĐÁNH GIÁ SẢN PHẨM</h2>

    <!-- Rating Overview -->
    <div class="grid grid-cols-6 gap-4 items-center border border-blue-500 text-gray-500 bg-blue-50 rounded-lg py-10">
        <div class="col-span-1 text-center">
            <p class="text-4xl font-bold text-red-500"><?= Util::formatNumber($reviews['averageRating'], 1) ?: 0 ?>/5</p>
            <div class="flex justify-center mt-2">
                <?= Other::ratingStar($reviews['averageRating']) ?>
            </div>
        </div>

        <div class="col-span-5 flex flex-wrap gap-2">
            <button class="px-4 py-2 bg-red-100 text-red-500 rounded-md hover:bg-red-100">Tất Cả (<?= Util::formatNumberShort($reviews['total']) ?>)</button>
            <?php foreach ($reviews['ratingCounts'] as $rating => $count): ?>
                <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-red-100"><?= Util::encodeHtml($rating) ?> Sao (<?= Util::formatNumberShort($count) ?>)</button>
            <?php endforeach; ?>
            <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-red-100">Có Bình Luận (<?= Util::formatNumberShort($reviews['totalWithComments']) ?>)</button>
            <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-red-100">Có Hình Ảnh (<?= Util::formatNumberShort($reviews['totalWithImages']) ?>)</button>
        </div>
    </div>

    <!-- Review List -->
    <div class="mt-6 space-y-6">
        <?php if (!empty($reviews['content'])): ?>
            <?php foreach ($reviews['content'] as $review): ?>
                <div class="border-t pt-4">
                    <div class="flex items-center space-x-4">
                        <img src="<?= Asset::getAvatar($review['avatar']) ?>" alt="avatar" class="w-12 h-12 rounded-full">
                        <div>
                            <p class="font-bold"><?= Util::encodeHtml($review['username']) ?></p>
                            <div class="flex items-center text-yellow-400"><?= Other::ratingStar($review['rating'], 'text-xs') ?></div>
                            <p class="text-sm text-gray-500"><?= Util::formatDateTime($review['date_time']) ?>
                                | Phân loại hàng:
                                <?= implode(', ', array_map(fn($variant) => Util::encodeHtml($variant['value']), $review['variants'])) ?>
                            </p>
                        </div>
                    </div>
                    <div class="mt-2 text-gray-700">
                        <p><?= Util::encodeHtml($review['comment']) ?></p>
                    </div>

                    <?php if (!empty($review['images'])): ?>
                        <?php foreach ($review['images'] as $image): ?>
                            <div class="mt-2 flex justify-start gap-2">
                                <img src="<?= Asset::getProduct($image['path']) ?>" alt="review image" class="rounded-md size-40">
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div>
                <div class="border-t pt-4">
                    Không có đánh giá nào
                </div>
            </div>
        <?php endif; ?>
    </div>

    <?php if (!empty($reviews['content'])): ?>
        <div>
            <button class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Xem thêm</button>
        </div>
    <?php endif; ?>
</div>

<!-- Sản phẩm theo shop -->
<div class="mt-10">
    <div class="text-center text-xl font-bold py-3 bg-gray-100 text-gray-800">Các sản phẩm khác của shop</div>
    <div class="grid grid-cols-12 gap-4 mt-10">

        <!-- Product Item -->
        <?php if (!empty($shopProducts)): ?>
            <?php foreach ($shopProducts as $sProduct): ?>
                <div class="col-span-2">
                    <a href="<?= Redirect::product('detail')->withQuery(['id' => $sProduct['id']])->getUrl() ?>" class="flex flex-col items-start p-4 border rounded-lg hover:shadow-md">
                        <img class="mb-3 w-full h-48 object-cover" src="<?= Asset::getProduct($sProduct['image_path']) ?>" alt="<?= Util::encodeHtml($sProduct['name']) ?>">
                        <span class="line-clamp-2 h-10 w-full font-bold leading-tight"><?= Util::encodeHtml($sProduct['name']) ?></span>
                        <div class="flex items-center mt-2">
                            <?php
                            $rating = round($sProduct['rating'] ?? 0);
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
                            <?php if ($sProduct['promotion_price']): ?>
                                <span class="line-through text-sm text-gray-500"><?= Util::formatCurrency($sProduct['price']) ?></span>
                                <span class="text-red-500 font-bold text-lg"><?= Util::formatCurrency($sProduct['promotion_price']) ?></span>
                            <?php else: ?>
                                <span class="text-red-500 font-bold text-lg text-end w-full"><?= Util::formatCurrency($sProduct['price']) ?></span>
                            <?php endif; ?>
                        </div>
                        <span class="text-sm w-full text-gray-600 text-end">Đã bán <?= Util::encodeHtml($sProduct['sold_quantity']) ?? 0 ?></span>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <div class="flex justify-center mt-5">
        <a href="<?= Redirect::product()->getUrl() ?>" class="px-5 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Xem thêm</a>
    </div>
</div>

<!-- Sản phẩm gợi ý -->
<div class="mt-10">
    <div class="text-center text-xl font-bold py-3 bg-gray-100 text-gray-800">Có thể bạn cũng thích</div>
    <div class="grid grid-cols-12 gap-4 mt-10">

        <!-- Product Item -->
        <?php if (!empty($relatedProducts)): ?>
            <?php foreach ($relatedProducts as $sProduct): ?>
                <div class="col-span-2">
                    <a href="<?= Redirect::product('detail')->withQuery(['id' => $sProduct['id']])->getUrl() ?>" class="flex flex-col items-start p-4 border rounded-lg hover:shadow-md">
                        <img class="mb-3 w-full h-48 object-cover" src="<?= Asset::getProduct($sProduct['image_path']) ?>" alt="<?= Util::encodeHtml($sProduct['name']) ?>">
                        <span class="line-clamp-2 h-10 w-full font-bold leading-tight"><?= Util::encodeHtml($sProduct['name']) ?></span>
                        <div class="flex items-center mt-2">
                            <?php
                            $rating = round($sProduct['rating'] ?? 0);
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
                            <?php if ($sProduct['promotion_price']): ?>
                                <span class="line-through text-sm text-gray-500"><?= Util::formatCurrency($sProduct['price']) ?></span>
                                <span class="text-red-500 font-bold text-lg"><?= Util::formatCurrency($sProduct['promotion_price']) ?></span>
                            <?php else: ?>
                                <span class="text-red-500 font-bold text-lg text-end w-full"><?= Util::formatCurrency($sProduct['price']) ?></span>
                            <?php endif; ?>
                        </div>
                        <span class="text-sm w-full text-gray-600 text-end">Đã bán <?= Util::encodeHtml($sProduct['sold_quantity']) ?? 0 ?></span>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <div class="flex justify-center mt-5">
        <a href="<?= Redirect::product()->getUrl() ?>" class="px-5 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Xem thêm</a>
    </div>
</div>