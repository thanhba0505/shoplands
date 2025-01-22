<div class="w-60 bg-white border rounded-lg shadow-md p-4 space-y-6">
    <!-- Bộ lọc tìm kiếm -->
    <div>
        <h2 class="text-lg font-semibold text-gray-800 flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a2 2 0 012-2h14a2 2 0 012 2v2M7 10h10M7 14h6m5 4H6a2 2 0 01-2-2V6m16 10a2 2 0 002-2v-4" />
            </svg>
            <span>BỘ LỌC TÌM KIẾM</span>
        </h2>
    </div>

    <!-- Theo danh mục -->
    <div>
        <h3 class="text-sm font-semibold text-gray-700 mb-2">Theo Danh Mục</h3>
        <ul class="space-y-2 text-sm text-gray-600">
            <li>
                <label class="flex items-center">
                    <input type="checkbox" class="mr-2 rounded text-red-500 focus:ring-red-400">
                    Thời trang nam
                </label>
            </li>
            <li>
                <label class="flex items-center">
                    <input type="checkbox" class="mr-2 rounded text-red-500 focus:ring-red-400">
                    Thời trang nữ
                </label>
            </li>
            <li>
                <label class="flex items-center">
                    <input type="checkbox" class="mr-2 rounded text-red-500 focus:ring-red-400">
                    Thời trang trẻ em
                </label>
            </li>
            <li>
                <label class="flex items-center">
                    <input type="checkbox" class="mr-2 rounded text-red-500 focus:ring-red-400">
                    Điện thoại và phụ kiện
                </label>
            </li>
            <li>
                <label class="flex items-center">
                    <input type="checkbox" class="mr-2 rounded text-red-500 focus:ring-red-400">
                    Đồng hồ
                </label>
            </li>
            <li>
                <label class="flex items-center">
                    <input type="checkbox" class="mr-2 rounded text-red-500 focus:ring-red-400">
                    Máy tính
                </label>
            </li>
            <li>
                <label class="flex items-center">
                    <input type="checkbox" class="mr-2 rounded text-red-500 focus:ring-red-400">
                    Nhà cửa đời sống
                </label>
            </li>
            <li>
                <label class="flex items-center">
                    <input type="checkbox" class="mr-2 rounded text-red-500 focus:ring-red-400">
                    Nhà sách online
                </label>
            </li>
            <li>
                <label class="flex items-center">
                    <input type="checkbox" class="mr-2 rounded text-red-500 focus:ring-red-400">
                    Phụ kiện trang sức
                </label>
            </li>
            <li>
                <label class="flex items-center">
                    <input type="checkbox" class="mr-2 rounded text-red-500 focus:ring-red-400">
                    Thể thao và du lịch
                </label>
            </li>
            <li>
                <label class="flex items-center">
                    <input type="checkbox" class="mr-2 rounded text-red-500 focus:ring-red-400">
                    Thiết bị điện tử
                </label>
            </li>
            <li>
                <label class="flex items-center">
                    <input type="checkbox" class="mr-2 rounded text-red-500 focus:ring-red-400">
                    Thiết bị gia dụng
                </label>
            </li>
            <!-- <li>
                <button class="text-red-500 hover:underline">Thêm</button>
            </li> -->
        </ul>
    </div>

    <!-- Khoảng giá -->
    <div>
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
    <div>
        <h3 class="text-sm font-semibold text-gray-700 mb-2">Đơn vị vận chuyển</h3>
        <ul class="space-y-2 text-sm text-gray-600">
            <li>
                <label class="flex items-center">
                    <input type="checkbox" class="mr-2 rounded text-red-500 focus:ring-red-400">
                    Hỏa tốc
                </label>
            </li>
            <li>
                <label class="flex items-center">
                    <input type="checkbox" class="mr-2 rounded text-red-500 focus:ring-red-400">
                    Nhanh
                </label>
            </li>
            <li>
                <label class="flex items-center">
                    <input type="checkbox" class="mr-2 rounded text-red-500 focus:ring-red-400">
                    Tiết kiệm
                </label>
            </li>
        </ul>
    </div>

    <!-- Đánh giá -->
    <div>
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
</div>