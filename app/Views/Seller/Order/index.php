<h2 class="text-2xl font-semibold">Quản lý đơn hàng</h2>
<div class="flex space-x-4 mt-4 border-b text-center text-sm">
    <a href="<?= Redirect::seller('order')->withQuery(['page' => 'all'])->getUrl() ?>" class="py-2 px-4 <?= $page == 'all' ? 'border-b-2 border-blue-500 font-semibold text-blue-500' : 'text-gray-600'; ?>">Tất cả</a>
    <a href="<?= Redirect::seller('order')->withQuery(['page' => 'pending'])->getUrl() ?>" class="py-2 px-4 <?= $page == 'pending' ? 'border-b-2 border-blue-500 font-semibold text-blue-500' : 'text-gray-600'; ?>">Chờ xác nhận</a>
    <a href="<?= Redirect::seller('order')->withQuery(['page' => 'packing'])->getUrl() ?>" class="py-2 px-4 <?= $page == 'packing' ? 'border-b-2 border-blue-500 font-semibold text-blue-500' : 'text-gray-600'; ?>">Đang đóng gói</a>
    <a href="<?= Redirect::seller('order')->withQuery(['page' => 'packed'])->getUrl() ?>" class="py-2 px-4 <?= $page == 'packed' ? 'border-b-2 border-blue-500 font-semibold text-blue-500' : 'text-gray-600'; ?>">Đã đóng gói</a>
    <a href="<?= Redirect::seller('order')->withQuery(['page' => 'shipping'])->getUrl() ?>" class="py-2 px-4 <?= $page == 'shipping' ? 'border-b-2 border-blue-500 font-semibold text-blue-500' : 'text-gray-600'; ?>">Đang vận chuyển</a>
    <a href="<?= Redirect::seller('order')->withQuery(['page' => 'dilivered'])->getUrl() ?>" class="py-2 px-4 <?= $page == 'dilivered' ? 'border-b-2 border-blue-500 font-semibold text-blue-500' : 'text-gray-600'; ?>">Đã giao hàng</a>
    <a href="<?= Redirect::seller('order')->withQuery(['page' => 'completed'])->getUrl() ?>" class="py-2 px-4 <?= $page == 'completed' ? 'border-b-2 border-blue-500 font-semibold text-blue-500' : 'text-gray-600'; ?>">Đã hoàn thành</a>
    <a href="<?= Redirect::seller('order')->withQuery(['page' => 'returned'])->getUrl() ?>" class="py-2 px-4 <?= $page == 'returned' ? 'border-b-2 border-blue-500 font-semibold text-blue-500' : 'text-gray-600'; ?>">Đơn hoàn trả</a>
    <a href="<?= Redirect::seller('order')->withQuery(['page' => 'cancelled'])->getUrl() ?>" class="py-2 px-4 <?= $page == 'cancelled' ? 'border-b-2 border-blue-500 font-semibold text-blue-500' : 'text-gray-600'; ?>">Đã hủy</a>
</div>

<div class="text-center bg-blue-200 py-3 mt-5 text-lg font-medium">
    Lọc
</div>

<div class="overflow-x-auto">
    <table class="table-auto w-full mt-5 border-collapse border border-blue-300 text-sm">
        <thead>
            <tr class="bg-blue-200 text-center font-semibold">
                <th class="border border-blue-300 px-4 py-2">Sản phẩm</th>
                <th class="border border-blue-300 px-4 py-2">Doanh thu đơn hàng</th>
                <th class="border border-blue-300 px-4 py-2">Đơn vị vận chuyển</th>
                <th class="border border-blue-300 px-4 py-2">Thời gian tạo đơn</th>
                <th class="border border-blue-300 px-4 py-2">Trạng thái</th>
                <th class="border border-blue-300 px-4 py-2">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 0; $i < 5; $i++): ?>
                <tr>
                    <td colspan="6" class="py-2"></td>
                </tr>
                <tr class="bg-blue-100">
                    <td colspan="3" class="border border-blue-300 px-4 py-2 font-bold">Tên người mua</td>
                    <td colspan="3" class="border border-blue-300 px-4 py-2 text-right">Mã đơn hàng: <?= rand(10000000, 99999999) ?></td>
                </tr>
                <tr class="text-center">
                    <td class="border border-blue-300 px-4 py-2">
                        <?php $limit = rand(1, 3); ?>
                        <?php for ($j = 0; $j < $limit; $j++): ?>
                            <div class="flex justify-between items-center gap-x-1 <?= $j != $limit - 1 ? 'mb-3' : ''; ?>">
                                <img src="<?= BASE_URL ?>/public/uploads/img/cap-sac.webp" alt="" class="w-10 h-10 border border-blue-300">
                                <span class="truncate w-40">20w Sạc Nhanh Thông Minh USB C PD US Cắm Dữ Liệu Sạc Nhanh 1Meter PD Cáp Adapter USB-C Dây Cắm</span>
                                <span>x<?= rand(1, 3) ?></span>
                                <span>Cáp, dây sạc</span>
                            </div>
                        <?php endfor; ?>
                    </td>
                    <td class="border border-blue-300 px-4 py-2">180.000đ</td>
                    <td class="border border-blue-300 px-4 py-2">Giao hàng nhanh</td>
                    <td class="border border-blue-300 px-4 py-2">01/01/2022</td>
                    <td class="border border-blue-300 px-4 py-2">Đang đóng gói</td>
                    <td class="border border-blue-300 px-4 py-2">
                        <a href="<?= BASE_URL ?>/seller/orders/detail" class="text-blue-500 hover:underline">Chi tiết</a><br>
                        <?php
                        $trang_thai = $page ?? null;
                        switch ($trang_thai) {
                            case 'pending':
                                echo '<a href="' . BASE_URL . '/seller/orders/detail" class="pt-1 text-green-500 hover:underline">Xác nhận</a>';
                                break;
                            case 'packing':
                                echo '<a href="' . BASE_URL . '/seller/orders/detail" class="pt-1 text-green-500 hover:underline">Đã đóng gói</a>';
                                break;
                            case 'packed':
                                echo '<a href="' . BASE_URL . '/seller/orders/detail" class="pt-1 text-green-500 hover:underline">Đã giao</a>';
                                break;
                            case 'returned':
                                echo '<a href="' . BASE_URL . '/seller/orders/detail" class="pt-1 text-yellow-500 hover:underline">Chấp nhận</a><br>';
                                echo '<a href="' . BASE_URL . '/seller/orders/detail" class="pt-1 text-red-500 hover:underline">Từ chối</a>';
                                break;
                            default:
                                break;
                        }
                        ?>
                    </td>
                </tr>
            <?php endfor; ?>
        </tbody>
    </table>
</div>