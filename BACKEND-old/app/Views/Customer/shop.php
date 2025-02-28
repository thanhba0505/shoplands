<div class="p-4 bg-white rounded-md flex items-center justify-between mt-6 grid-cols-12">
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

<!-- Sản phẩm tương tự -->
<div class="mt-10">
    <div class="text-center text-xl font-bold py-3 bg-gray-100 text-gray-800">Sản phẩm bán chạy</div>
    <div class="grid grid-cols-12 gap-4 mt-10">

        <!-- Product Item -->
        <?php if (!empty($bestSellingProducts)): ?>
            <?php foreach ($bestSellingProducts as $sProduct): ?>
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
</div>

<!-- Danh mục -->
<form method="GET" action="<?= Redirect::shop()->getUrl() ?>" onsubmit="removeEmptyFields(this)">
    <input type="text" name="id" value="<?= $seller['id'] ?>" hidden>
    <div class="grid grid-cols-6 gap-4 mt-10">
        <!-- SIDEBAR -->
        <div class="col-span-1 ">
            <!-- Bộ lọc tìm kiếm -->

            <div class="text-lg font-semibold">
                Bộ lọc tìm kiếm
            </div>

            <!-- Khoảng giá -->
            <div class="mt-4">
                <h3 class="text-sm font-semibold text-gray-700 mb-2">Khoảng Giá</h3>
                <div class="flex items-center flex-col space-y-3 mt-3">

                    <?php
                    $minPrice = $filter['min_price'];
                    $maxPrice = $filter['max_price'];
                    ?>

                    <div class=" w-full">
                        <?= Other::inputField(['name' => 'min_price', 'value' => $minPrice, 'placeholder' => 'Từ...', 'autocomplete' => 'off'], 'dollar') ?>
                    </div>

                    <div class=" w-full">
                        <?= Other::inputField(['name' => 'max_price', 'value' => $maxPrice, 'placeholder' => 'Đến...', 'autocomplete' => 'off'], 'dollar') ?>
                    </div>

                </div>
            </div>

            <!-- Theo danh mục -->
            <div class="mt-4">
                <h3 class="text-sm font-semibold text-gray-700 mb-2">Theo Danh Mục</h3>
                <ul class="space-y-1 pl-2 text-sm text-gray-600">
                    <?php $filteredCategories = $filter['categories'] ?? []; ?>
                    <?php foreach ($categories as $category) : ?>
                        <li>
                            <?php $checked = in_array($category['id'], $filteredCategories); ?>
                            <?= Other::checkbox($category['name'], [
                                'id'  => 'categories[]' . $category['id'],
                                'name' => 'categories[]',
                                'value' => $category['id'],
                                'checked' => $checked
                            ]); ?>

                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Đánh giá -->
            <div class="mt-4">
                <h3 class="text-sm font-semibold text-gray-700 mb-2">Theo Đánh Giá</h3>
                <ul class="space-y-1 pl-2 text-sm text-gray-600">
                    <?php $filteredRatings = $filter['ratings']; ?>

                    <li><?= Other::checkbox('5 Sao', ['name' => 'ratings[]', 'value' => 5, 'checked' => in_array('5', $filteredRatings)]) ?></li>
                    <li><?= Other::checkbox('4 Sao', ['name' => 'ratings[]', 'value' => 4, 'checked' => in_array('4', $filteredRatings)]) ?></li>
                    <li><?= Other::checkbox('3 Sao', ['name' => 'ratings[]', 'value' => 3, 'checked' => in_array('3', $filteredRatings)]) ?></li>
                    <li><?= Other::checkbox('2 Sao', ['name' => 'ratings[]', 'value' => 2, 'checked' => in_array('2', $filteredRatings)]) ?></li>
                    <li><?= Other::checkbox('1 Sao', ['name' => 'ratings[]', 'value' => 1, 'checked' => in_array('1', $filteredRatings)]) ?></li>
                </ul>
            </div>



            <!-- Xóa tất cả -->
            <div class="mt-4 flex items-center space-x-2 bg-white sticky bottom-0 pb-6 pt-2">
                <?= Other::buttonLink('LÀM LẠI', Redirect::shop()->withQuery(['id' => $seller['id']])->getUrl(), 'light', ['type' => 'submit']) ?>
                <?= Other::button('LỌC', 'dark', ['type' => 'submit']) ?>
            </div>
        </div>



        <!-- CONTENT -->
        <div class="col-span-5">
            <div class="bg-blue-50 p-4 space-y-2 rounded-md">

                <div class="flex items-center justify-between">
                    <!-- Bộ lọc sắp xếp -->
                    <div class="flex items-center space-x-4 text-sm font-medium text-gray-700">
                        <!-- Select option -->
                        <div style="height: 46px;">
                            <select name="price" class="px-4 py-3 h-full border border-gray-300 rounded-lg bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                <option value="" <?= $arrange['price'] === '' ? 'selected' : '' ?>>Sắp xếp theo giá</option>
                                <option value="asc" <?= $arrange['price'] === 'asc' ? 'selected' : '' ?>>Tăng dần</option>
                                <option value="desc" <?= $arrange['price'] === 'desc' ? 'selected' : '' ?>>Giảm dần</option>
                            </select>
                        </div>

                        <div class="bg-white border border-gray-300 rounded-lg flex" style="height: 46px;">
                            <?= Other::checkbox('Đánh giá cao nhất', ['name' => 'top-rated', 'value' => 1, 'checked' => $arrange['top-rated']]); ?>
                        </div>
                        <div class="bg-white border border-gray-300 rounded-lg flex" style="height: 46px;">
                            <?= Other::checkbox('Lượt bán nhiều nhất', ['name' => 'top-seller', 'value' => 1, 'checked' => $arrange['top-seller']]); ?>
                        </div>

                    </div>
                </div>
            </div>


            <?= Other::renderProducts($products, '', 5); ?>


        </div>


    </div>
</form>