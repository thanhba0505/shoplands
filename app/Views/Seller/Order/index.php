<h2 class="text-2xl font-semibold">Quản lý đơn hàng</h2>
<div id="tab-order-content" class="flex space-x-1 mt-4 border-b text-center text-sm">
    <?php foreach ($listOrderStatus as $key => $label): ?>
        <div data-tab-order="<?= Util::encodeHtml($key) ?>" class="py-2 px-2 select-none cursor-pointer">
            <?= Util::encodeHtml($label) ?>
        </div>
    <?php endforeach; ?>
</div>


<div class="text-center bg-blue-200 py-3 mt-5 text-lg font-medium">
    Lọc
</div>


<div class="overflow-x-auto">
    <table class="table-auto w-full mt-5 border-collapse text-sm">
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

        <!-- Nội dung -->
        <tbody id="order-content"></tbody>

        <tfoot>
            <tr id="loadingId" class="hidden">
                <td colspan="10" class="py-20"><?= Other::loading() ?></td>
            </tr>
            <tr id="noContentId" class="hidden">
                <td colspan="10" class="py-20 border border-blue-300 align-middle">
                    <div class="h-10 text-center py-2">Không có đơn hàng nào.</div>
                </td>
            </tr>
            <tr id="errorId" class="hidden">
                <td colspan="10" class="py-20 text-center border border-blue-300 h-10">Lỗi tải dữ liệu!</td>
            </tr>
        </tfoot>
    </table>
</div>