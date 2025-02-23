<form method="GET" action="<?= Redirect::product()->getUrl() ?>" onsubmit="removeEmptyFields(this)">
    <div class="grid grid-cols-6 gap-4">
        <!-- SIDEBAR -->
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
                        <?= Other::inputField('min_price', $minPrice, ['placeholder' => 'Từ...']) ?>
                    </div>
                    <span>-</span>
                    <div class="relative w-80 max-w-md">
                        <?= Other::inputField('max_price', $maxPrice, ['placeholder' => 'Đến...']) ?>
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
                <?= Other::buttonLink('LÀM LẠI', Redirect::product()->getUrl(), 'linght', ['type' => 'submit']) ?>
                <?= Other::button('LỌC', 'dark', ['type' => 'submit']) ?>
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


            <?= Other::renderProducts($products,'', 5, '', Redirect::product()->getUrl()); ?>


        </div>
    </div>
</form>