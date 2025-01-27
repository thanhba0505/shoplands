<!-- Bộ lọc tìm kiếm -->
<div>
    <div class="text-lg font-semibold">
        Bộ lọc tìm kiếm
    </div>
</div>

<!-- Theo danh mục -->
<div class="mt-4">
    <h3 class="text-sm font-semibold text-gray-700 mb-2">Theo Danh Mục</h3>
    <ul class="space-y-1 pl-2 text-sm text-gray-600">
        <?php foreach ($categories as $category) : ?>
            <li>
                <?php echo Other::checkbox('category', $category['id'], $category['name']); ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<!-- Khoảng giá -->
<div class="mt-4">
    <h3 class="text-sm font-semibold text-gray-700 mb-2">Khoảng Giá</h3>
    <div class="flex items-center space-x-2">
        <input type="text" placeholder="₫ TỪ" class="w-1/2 p-2 border rounded text-sm focus:ring-red-500 focus:border-red-500">
        <span>-</span>
        <input type="text" placeholder="₫ ĐẾN" class="w-1/2 p-2 border rounded text-sm focus:ring-red-500 focus:border-red-500">
    </div>
    <button class="w-full mt-2 bg-red-500 text-white py-2 rounded text-sm font-semibold hover:bg-red-600 focus:ring-2 focus:ring-red-500">
        ÁP DỤNG
    </button>
</div>

<!-- Đơn vị vận chuyển -->
<div class="mt-4">
    <h3 class="text-sm font-semibold text-gray-700 mb-2">Đơn vị vận chuyển</h3>
    <ul class="space-y-2 text-sm text-gray-600">
        <li>
            <label class="flex items-center cursor-pointer select-none">
                <input type="checkbox" class=" px-4 py-2 mt-2 text-blue-700 bg-white border-2 border-blue-300 rounded-lg shadow-sm focus:ring focus:ring-blue-500 focus:outline-none focus:border-blue-500 w-full">
                Hỏa tốc
            </label>
        </li>
        <li>
            <label class="flex items-center cursor-pointer select-none">
                <input type="checkbox" class=" px-4 py-2 mt-2 text-blue-700 bg-white border-2 border-blue-300 rounded-lg shadow-sm focus:ring focus:ring-blue-500 focus:outline-none focus:border-blue-500 w-full">
                Nhanh
            </label>
        </li>
        <li>
            <label class="flex items-center cursor-pointer select-none">
                <input type="checkbox" class=" px-4 py-2 mt-2 text-blue-700 bg-white border-2 border-blue-300 rounded-lg shadow-sm focus:ring focus:ring-blue-500 focus:outline-none focus:border-blue-500 w-full">
                Tiết kiệm
            </label>
        </li>
    </ul>
</div>

<!-- Đánh giá -->
<div class="mt-4">
    <h3 class="text-sm font-semibold text-gray-700 mb-2">Đánh Giá</h3>
    <ul class="space-y-2 text-sm text-gray-600">
        <!-- 5 sao -->
        <li class="flex items-center space-x-2">
            <button class="flex items-center space-x-1 star-btn" data-rating="5">
                <div class="flex">
                    <div class="w-4 h-4 bg-yellow-400 border border-yellow-400 [clip-path:polygon(50%_0%,_61%_35%,_98%_35%,_68%_57%,_79%_91%,_50%_70%,_21%_91%,_32%_57%,_2%_35%,_39%_35%)]"></div>
                    <div class="w-4 h-4 bg-yellow-400 border border-yellow-400 [clip-path:polygon(50%_0%,_61%_35%,_98%_35%,_68%_57%,_79%_91%,_50%_70%,_21%_91%,_32%_57%,_2%_35%,_39%_35%)]"></div>
                    <div class="w-4 h-4 bg-yellow-400 border border-yellow-400 [clip-path:polygon(50%_0%,_61%_35%,_98%_35%,_68%_57%,_79%_91%,_50%_70%,_21%_91%,_32%_57%,_2%_35%,_39%_35%)]"></div>
                    <div class="w-4 h-4 bg-yellow-400 border border-yellow-400 [clip-path:polygon(50%_0%,_61%_35%,_98%_35%,_68%_57%,_79%_91%,_50%_70%,_21%_91%,_32%_57%,_2%_35%,_39%_35%)]"></div>
                    <div class="w-4 h-4 bg-yellow-400 border border-yellow-400 [clip-path:polygon(50%_0%,_61%_35%,_98%_35%,_68%_57%,_79%_91%,_50%_70%,_21%_91%,_32%_57%,_2%_35%,_39%_35%)]"></div>
                </div>
                <span>trở lên</span>
            </button>
        </li>

        <!-- 4 sao -->
        <li class="flex items-center space-x-2">
            <button class="flex items-center space-x-1 star-btn" data-rating="5">
                <div class="flex">
                    <div class="w-4 h-4 bg-yellow-400 border border-yellow-400 [clip-path:polygon(50%_0%,_61%_35%,_98%_35%,_68%_57%,_79%_91%,_50%_70%,_21%_91%,_32%_57%,_2%_35%,_39%_35%)]"></div>
                    <div class="w-4 h-4 bg-yellow-400 border border-yellow-400 [clip-path:polygon(50%_0%,_61%_35%,_98%_35%,_68%_57%,_79%_91%,_50%_70%,_21%_91%,_32%_57%,_2%_35%,_39%_35%)]"></div>
                    <div class="w-4 h-4 bg-yellow-400 border border-yellow-400 [clip-path:polygon(50%_0%,_61%_35%,_98%_35%,_68%_57%,_79%_91%,_50%_70%,_21%_91%,_32%_57%,_2%_35%,_39%_35%)]"></div>
                    <div class="w-4 h-4 bg-yellow-400 border border-yellow-400 [clip-path:polygon(50%_0%,_61%_35%,_98%_35%,_68%_57%,_79%_91%,_50%_70%,_21%_91%,_32%_57%,_2%_35%,_39%_35%)]"></div>
                    <div class="w-4 h-4 bg-white border border-yellow-400 [clip-path:polygon(50%_0%,_61%_35%,_98%_35%,_68%_57%,_79%_91%,_50%_70%,_21%_91%,_32%_57%,_2%_35%,_39%_35%)]"></div>
                </div>
                <span>trở lên</span>
            </button>
        </li>

        <!-- 3 sao -->
        <li class="flex items-center space-x-2">
            <button class="flex items-center space-x-1 star-btn" data-rating="5">
                <div class="flex">
                    <div class="w-4 h-4 bg-yellow-400 border border-yellow-400 [clip-path:polygon(50%_0%,_61%_35%,_98%_35%,_68%_57%,_79%_91%,_50%_70%,_21%_91%,_32%_57%,_2%_35%,_39%_35%)]"></div>
                    <div class="w-4 h-4 bg-yellow-400 border border-yellow-400 [clip-path:polygon(50%_0%,_61%_35%,_98%_35%,_68%_57%,_79%_91%,_50%_70%,_21%_91%,_32%_57%,_2%_35%,_39%_35%)]"></div>
                    <div class="w-4 h-4 bg-yellow-400 border border-yellow-400 [clip-path:polygon(50%_0%,_61%_35%,_98%_35%,_68%_57%,_79%_91%,_50%_70%,_21%_91%,_32%_57%,_2%_35%,_39%_35%)]"></div>
                    <div class="w-4 h-4 bg-white border border-yellow-400 [clip-path:polygon(50%_0%,_61%_35%,_98%_35%,_68%_57%,_79%_91%,_50%_70%,_21%_91%,_32%_57%,_2%_35%,_39%_35%)]"></div>
                    <div class="w-4 h-4 bg-white border border-yellow-400 [clip-path:polygon(50%_0%,_61%_35%,_98%_35%,_68%_57%,_79%_91%,_50%_70%,_21%_91%,_32%_57%,_2%_35%,_39%_35%)]"></div>
                </div>
                <span>trở lên</span>
            </button>
        </li>

        <!-- 2 sao -->
        <li class="flex items-center space-x-2">
            <button class="flex items-center space-x-1 star-btn" data-rating="5">
                <div class="flex">
                    <div class="w-4 h-4 bg-yellow-400 border border-yellow-400 [clip-path:polygon(50%_0%,_61%_35%,_98%_35%,_68%_57%,_79%_91%,_50%_70%,_21%_91%,_32%_57%,_2%_35%,_39%_35%)]"></div>
                    <div class="w-4 h-4 bg-yellow-400 border border-yellow-400 [clip-path:polygon(50%_0%,_61%_35%,_98%_35%,_68%_57%,_79%_91%,_50%_70%,_21%_91%,_32%_57%,_2%_35%,_39%_35%)]"></div>
                    <div class="w-4 h-4 bg-white border border-yellow-400 [clip-path:polygon(50%_0%,_61%_35%,_98%_35%,_68%_57%,_79%_91%,_50%_70%,_21%_91%,_32%_57%,_2%_35%,_39%_35%)]"></div>
                    <div class="w-4 h-4 bg-white border border-yellow-400 [clip-path:polygon(50%_0%,_61%_35%,_98%_35%,_68%_57%,_79%_91%,_50%_70%,_21%_91%,_32%_57%,_2%_35%,_39%_35%)]"></div>
                    <div class="w-4 h-4 bg-white border border-yellow-400 [clip-path:polygon(50%_0%,_61%_35%,_98%_35%,_68%_57%,_79%_91%,_50%_70%,_21%_91%,_32%_57%,_2%_35%,_39%_35%)]"></div>
                </div>
                <span>trở lên</span>
            </button>
        </li>

        <!-- 1 sao -->
        <li class="flex items-center space-x-2">
            <button class="flex items-center space-x-1 star-btn" data-rating="5">
                <div class="flex">
                    <div class="w-4 h-4 bg-yellow-400 border border-yellow-400 [clip-path:polygon(50%_0%,_61%_35%,_98%_35%,_68%_57%,_79%_91%,_50%_70%,_21%_91%,_32%_57%,_2%_35%,_39%_35%)]"></div>
                    <div class="w-4 h-4 bg-white border border-yellow-400 [clip-path:polygon(50%_0%,_61%_35%,_98%_35%,_68%_57%,_79%_91%,_50%_70%,_21%_91%,_32%_57%,_2%_35%,_39%_35%)]"></div>
                    <div class="w-4 h-4 bg-white border border-yellow-400 [clip-path:polygon(50%_0%,_61%_35%,_98%_35%,_68%_57%,_79%_91%,_50%_70%,_21%_91%,_32%_57%,_2%_35%,_39%_35%)]"></div>
                    <div class="w-4 h-4 bg-white border border-yellow-400 [clip-path:polygon(50%_0%,_61%_35%,_98%_35%,_68%_57%,_79%_91%,_50%_70%,_21%_91%,_32%_57%,_2%_35%,_39%_35%)]"></div>
                    <div class="w-4 h-4 bg-white border border-yellow-400 [clip-path:polygon(50%_0%,_61%_35%,_98%_35%,_68%_57%,_79%_91%,_50%_70%,_21%_91%,_32%_57%,_2%_35%,_39%_35%)]"></div>
                </div>
                <span>trở lên</span>
            </button>
        </li>
    </ul>
</div>


<!-- Xóa tất cả -->
<button class="w-full bg-red-500 text-white py-2 rounded text-sm font-semibold hover:bg-red-600 focus:ring-2 focus:ring-red-500">
    XÓA TẤT CẢ
</button>