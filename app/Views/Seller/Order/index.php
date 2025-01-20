<h2 class="text-2xl font-semibold">Quản lý đơn hàng</h2>
<div id="tab-content-order" class="flex space-x-1 mt-4 border-b text-center text-sm">
    <?php foreach ($listOrderStatus as $key => $label): ?>
        <div data-tab="<?= Util::encodeHtml($key) ?>" class="py-2 px-2 cursor-pointer">
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
        <tbody id="tab-content">
            <!-- Nội dung -->
        </tbody>
    </table>
</div>