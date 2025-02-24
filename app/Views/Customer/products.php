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
                <?= Other::buttonLink('LÀM LẠI', Redirect::product()->getUrl(), 'light', ['type' => 'submit']) ?>
                <?= Other::button('LỌC', 'dark', ['type' => 'submit']) ?>
            </div>
        </div>



        <!-- CONTENT -->
        <div class="col-span-5">
            <div class="bg-blue-50 p-4 space-y-2 rounded-md">
                <?= Other::inputField(['id' => 'search', 'name' => 'search', 'value' => $filter['search'], 'placeholder' => 'Tìm kiếm...', 'style' => 'height: 46px;', 'autocomplete' => 'off'], 'search') ?>

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

<script>
    $(document).ready(function() {
        // Xử lý sự kiện input của bất kỳ ô nào có name="search"
        $('input[name="search"]').on('input', function() {
            // Lấy giá trị của ô input đầu tiên
            var searchValue = $(this).val();

            // Cập nhật tất cả các ô input có name="search" với giá trị đã lấy
            $('input[name="search"]').val(searchValue);
        });
    });
</script>