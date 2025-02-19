<!-- SIDEBAR -->
<form method="GET" action="<?= Redirect::product()->getUrl() ?>" onsubmit="removeEmptyFields(this)">
    <div class="grid grid-cols-6 gap-4">
        <div class="col-span-1 ">
            <!-- Bộ lọc tìm kiếm -->

            <div class="text-lg font-semibold">
                Bộ lọc tìm kiếm
            </div>

            <!-- Khoảng giá -->
            <div class="mt-4">
                <h3 class="text-sm font-semibold text-gray-700 mb-2">Khoảng Giá</h3>
                <div class="flex items-center space-x-2 mt-3">

                    <?php
                    $minPrice = $filter['min_price'];
                    $maxPrice = $filter['max_price'];
                    ?>

                    <div class="relative w-80 max-w-md">
                        <input
                            type="text"
                            name="min_price"
                            value="<?= $minPrice ?? '' ?>"
                            placeholder="Từ..."
                            class="w-full px-4 py-2 h-10 text-base text-gray-900 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <span>-</span>
                    <div class="relative w-80 max-w-md">
                        <input
                            type="text"
                            name="max_price"
                            value="<?= $maxPrice ?? '' ?>"
                            placeholder="Đến..."
                            class="w-full px-4 py-2 h-10 text-base text-gray-900 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
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
                            <?= Other::checkbox('categories[]', $category['id'], $category['name'], $checked); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Đánh giá -->
            <div class="mt-4">
                <h3 class="text-sm font-semibold text-gray-700 mb-2">Theo Đánh Giá</h3>
                <ul class="space-y-1 pl-2 text-sm text-gray-600">
                    <?php $filteredRatings = $filter['ratings']; ?>
                    <li><?= Other::checkbox('ratings[]', 5, '5 Sao', in_array('5', $filteredRatings)) ?></li>
                    <li><?= Other::checkbox('ratings[]', 4, '4 Sao', in_array('4', $filteredRatings)) ?></li>
                    <li><?= Other::checkbox('ratings[]', 3, '3 Sao', in_array('3', $filteredRatings)) ?></li>
                    <li><?= Other::checkbox('ratings[]', 2, '2 Sao', in_array('2', $filteredRatings)) ?></li>
                    <li><?= Other::checkbox('ratings[]', 1, '1 Sao', in_array('1', $filteredRatings)) ?></li>
                </ul>
            </div>



            <!-- Xóa tất cả -->
            <div class="mt-4 flex items-center space-x-2 bg-white sticky bottom-0 pb-6 pt-2">
                <a href="<?= Redirect::product()->getUrl() ?>" type="submit" class="text-center w-full bg-white text-blue-500 py-2 rounded text-sm font-semibold border border-blue-500  hover:bg-blue-50">
                    LÀM LẠI
                </a>
                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded text-sm font-semibold hover:bg-blue-600">
                    LỌC
                </button>
            </div>
        </div>



        <!-- CONTENT -->
        <div class="col-span-5">
            <div class="">
                <div class="flex items-center justify-between px-4 py-3 bg-gray-100">
                    <!-- Bộ lọc sắp xếp -->
                    <div class="flex items-center space-x-4 text-sm font-medium text-gray-700">
                        <div class="bg-white border border-gray-300 rounded-lg flex items"><?= Other::checkbox('latest', 1, 'Mới nhất', $arrange['latest']); ?></div>
                        <div class="bg-white border border-gray-300 rounded-lg flex items"><?= Other::checkbox('popular', 1, 'Bán chạy', $arrange['popular']); ?></div>


                        <!-- Select option -->
                        <select name="price" class="px-4 py-2 h-full border border-gray-300 rounded-lg bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            <option value="" disabled <?= $arrange['price'] === '' ? 'selected' : '' ?>>Sắp xếp theo giá</option>
                            <option value="asc" <?= $arrange['price'] === 'asc' ? 'selected' : '' ?>>Tăng dần</option>
                            <option value="desc" <?= $arrange['price'] === 'desc' ? 'selected' : '' ?>>Giảm dần</option>
                        </select>
                    </div>
                </div>
            </div>


            <div class="grid grid-cols-10 gap-4 mt-4">
                <!-- Product Item -->
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <div class="col-span-2">
                            <a href="<?= Redirect::product("detail")->withQuery(['id' => $product['id']])->getUrl() ?>" class="flex flex-col items-start p-4 border rounded-lg hover:shadow-md">
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
            </div>


        </div>
    </div>
</form>