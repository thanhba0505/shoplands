<!-- Quản lý đơn hàng -->
<div class="mb-6">
    <h3 class="text-lg font-semibold mb-2">Quản lý đơn hàng</h3>
    <nav class="space-y-1">
        <?php $listOrderStatus = Other::listOrderStatus(); ?>
        <?php foreach ($listOrderStatus as $key => $label): ?>
            <a href="<?= Redirect::seller('order')->withQuery(['page' => $key])->getUrl() ?>"
                class="block px-4 py-2 rounded-md linear duration-200 hover:bg-blue-400 hover:text-white <?= ($group . '-' . $page) == ('order-' . $key) ? 'bg-blue-400 font-semibold text-white' : '' ?>">
                <?= Util::encodeHtml($label) ?>
            </a>
        <?php endforeach; ?>
    </nav>

</div>

<!-- Quản lý sản phẩm -->
<div class="mb-6">
    <h3 class="text-lg font-semibold mb-2">Quản lý sản phẩm</h3>
    <nav class="space-y-1">
        <a href="<?= Redirect::seller('product')->withQuery(['page' => 'all'])->getUrl() ?>" class="block px-4 py-2 rounded-md linear duration-200 hover:bg-blue-400 hover:text-white <?= $group . '-' . $page == 'product-all' ? 'bg-blue-400 font-semibold text-white' : '' ?>">Tất cả</a>
        <a href="<?= Redirect::seller('product')->withQuery(['page' => 'in-stock'])->getUrl() ?>" class="block px-4 py-2 rounded-md linear duration-200 hover:bg-blue-400 hover:text-white <?= $group . '-' . $page == 'product-in-stock' ? 'bg-blue-400 font-semibold text-white' : '' ?>">Còn hàng</a>
        <a href="<?= Redirect::seller('product')->withQuery(['page' => 'out-of-stock'])->getUrl() ?>" class="block px-4 py-2 rounded-md linear duration-200 hover:bg-blue-400 hover:text-white <?= $group . '-' . $page == 'product-out-of-stock' ? 'bg-blue-400 font-semibold text-white' : '' ?>">Hết hàng</a>
        <a href="<?= Redirect::seller('product')->withQuery(['page' => 'locked'])->getUrl() ?>" class="block px-4 py-2 rounded-md linear duration-200 hover:bg-blue-400 hover:text-white <?= $group . '-' . $page == 'product-locked' ? 'bg-blue-400 font-semibold text-white' : '' ?>">Đã bị khóa</a>
        <a href="<?= Redirect::seller('product')->withQuery(['page' => 'hidden'])->getUrl() ?>" class="block px-4 py-2 rounded-md linear duration-200 hover:bg-blue-400 hover:text-white <?= $group . '-' . $page == 'product-hidden' ? 'bg-blue-400 font-semibold text-white' : '' ?>">Đã ẩn</a>
        <a href="<?= Redirect::seller('product')->withQuery(['page' => 'deleted'])->getUrl() ?>" class="block px-4 py-2 rounded-md linear duration-200 hover:bg-blue-400 hover:text-white <?= $group . '-' . $page == 'product-deleted' ? 'bg-blue-400 font-semibold text-white' : '' ?>">Đã xóa</a>
    </nav>
</div>