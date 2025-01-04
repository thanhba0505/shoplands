<div class="flex flex-col">
    <div class="w-full overflow-x-auto">
        <table class="table-auto border-separate border-spacing-y-2 w-full">
            <!-- Item 1 -->
            <tr class="border-b border-gray-300">
                <td class="w-24 py-4">
                    <div class="flex ml-9">
                        <input type="checkbox" id="checkbox" class="appearance-none h-5 w-5 border border-gray-300 rounded checked:bg-blue-500">
                    </div>
                </td>
                <td colspan="2">
                    <div class="flex"><a href="<?= BASE_URL ?>/shop" class="text-blue-600 hover:underline">Tên shop</a></div>
                </td>
                <td class="text-center text-lg">Phân loại</td>
                <td class="text-center text-lg">Đơn giá</td>
                <td class="text-center text-lg">Số lượng</td>
                <td class="text-center text-lg">Tổng tiền</td>
                <td class="text-center text-lg">Hành động</td>
            </tr>

            <tr>
                <td class="w-24">
                    <div class="flex ml-9">
                        <input type="checkbox" id="checkbox" class="appearance-none h-5 w-5 border border-gray-300 rounded checked:bg-blue-500">
                    </div>
                </td>
                <td class="w-24">
                    <div class="w-24 h-24"><img src="<?= BASE_URL ?>/public/uploads/img/cap-sac.webp" alt="" class="w-full h-full object-cover"></div>
                </td>
                <td>
                    <a href="#" class="block text-ellipsis overflow-hidden whitespace-nowrap font-semibold text-base">20w Sạc Nhanh Thông Minh USB C PD US Cắm Dữ Liệu Sạc Nhanh 1Meter PD Cáp Adapter USB-C Dây Cắm</a>
                </td>
                <td class="w-36 text-center">
                    <span class="block text-sm">Bộ sạc và cáp</span>
                    <span class="block text-sm">20W</span>
                    <span class="block text-sm">USB-C</span>
                </td>
                <td class="w-36 text-center">
                    <span class="block line-through text-sm">3.000.000đ</span>
                    <span class="block text-lg font-bold text-red-600">200.000đ</span>
                </td>
                <td class="w-36">
                    <input type="number" value="1" class="form-input w-16 mx-auto text-center border border-gray-300 rounded">
                </td>
                <td class="w-36 text-center">
                    <span class="font-bold text-lg text-red-600">200.000đ</span>
                </td>
                <td class="w-36 text-center">
                    <a href="#" class="text-red-600 hover:underline">Xóa</a>
                </td>
            </tr>

            <tr class="border-t border-gray-300">
                <td>
                    <div class="text-gray-600 text-xl ml-9">
                        <i class="fa-solid fa-ticket"></i>
                    </div>
                </td>
                <td colspan="7">Xem tất cả voucher của shop</td>
            </tr>

            <tr class="border-t border-gray-300">
                <td>
                    <div class="text-gray-600 text-xl ml-9">
                        <i class="fa-solid fa-truck-fast"></i>
                    </div>
                </td>
                <td colspan="7">Giảm 20.000đ phí vận chuyển đơn tối thiểu 150.000đ; Miễn phí vận chuyển cho đơn từ 350.000đ</td>
            </tr>

            <tr class="bg-gray-200">
                <td colspan="8"></td>
            </tr>
        </table>

        <div class="flex items-center justify-between border-t-2 py-4 px-6">
            <button class="btn btn-outline border px-6 py-2">Xóa tất cả</button>
            <div class="text-lg">Tổng thanh toán (0 sản phẩm): 0 VNĐ</div>
            <a href="#" class="btn px-6 py-2 bg-blue-500 text-white">Mua hàng</a>
        </div>
    </div>

    <div class="w-full mt-8">
        <h2 class="text-center text-xl text-gray-700">Có thể bạn cũng thích</h2>
    </div>
</div>