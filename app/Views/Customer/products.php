<div class="mt-10">
    <div class="flex items-center justify-between px-4 py-3 bg-gray-100">
        <!-- Bộ lọc sắp xếp -->
        <div id="sortButtons" class="flex space-x-4 text-sm font-medium text-gray-700">
            <button class="sort-btn px-4 py-2 bg-white border border-gray-300 rounded-lg ">
                Phổ Biến
            </button>
            <button class="sort-btn px-4 py-2 bg-white border border-gray-300 rounded-lg ">
                Mới Nhất
            </button>
            <button class="sort-btn px-4 py-2 bg-white border border-gray-300 rounded-lg ">
                Bán Chạy
            </button>
            <!-- Select option -->
            <div>
                <select id="sortSelect" class="px-4 py-2 border border-gray-300 rounded-lg bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="default" disabled selected>Giá</option>
                    <option value="asc">Giá: Thấp đến Cao</option>
                    <option value="desc">Giá: Cao đến Thấp</option>
                </select>
            </div>
        </div>

        <!-- Điều hướng -->
        <div class="flex items-center space-x-2 text-gray-700 text-sm font-medium">
            <span>1/17</span>
            <button class="p-2 border border-gray-300 rounded-lg hover:bg-gray-200">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <button class="p-2 border border-gray-300 rounded-lg hover:bg-gray-200">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>
    </div>
</div>


<div class="grid grid-cols-12 gap-4 mt-4">
    <!-- Product Item -->
    <?php if (!empty($products)): ?>
        <?php foreach ($products as $product): ?>
            <div class="col-span-2">
                <a href="<?= Redirect::product()->withQuery(['id' => $product['id']])->getUrl() ?>" class="flex flex-col items-start p-4 border rounded-lg hover:shadow-md">
                    <img class="mb-3 w-full h-48 object-cover" src="<?= Util::encodeHtml($product['image_path']) ?>" alt="<?= Util::encodeHtml($product['name']) ?>">
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

    <!-- Chuyển đỏ nút khi bấm -->
    <script>
        // JavaScript để quản lý nút active
        const buttons = document.querySelectorAll(".sort-btn");

        buttons.forEach((button) => {
            button.addEventListener("click", () => {
                // Xóa lớp active khỏi tất cả các nút
                buttons.forEach((btn) => {
                    btn.classList.remove("bg-red-500", "text-white");
                    btn.classList.add("bg-white", "text-gray-700"); // Trả lại màu trắng cho các nút khác
                });
                // Thêm lớp active cho nút được chọn
                button.classList.remove("bg-white", "text-gray-700"); // Xóa màu trắng
                button.classList.add("bg-red-500", "text-white"); // Thêm màu đỏ
            });
        });
    </script>