<!-- Quản lý đơn hàng -->
<div class="mb-6">
    <h3 class="text-lg font-semibold mb-2">Quản lý đơn hàng</h3>
    <nav class="space-y-1">
        <a href="<?= Redirect::seller('order')->withQuery(['page'=>'all'])->getUrl() ?>" class="block px-4 py-2 rounded-md linear duration-200 hover:bg-blue-400 hover:text-white <?= $group . '-' . $page == 'order-all' ? 'bg-blue-400 font-semibold text-white' : '' ?>">Tất cả</a>
        <a href="<?= Redirect::seller('order')->withQuery(['page'=>'pending'])->getUrl() ?>" class="block px-4 py-2 rounded-md linear duration-200 hover:bg-blue-400 hover:text-white <?= $group . '-' . $page == 'order-pending' ? 'bg-blue-400 font-semibold text-white' : '' ?>">Chờ xác nhận</a>
        <a href="<?= Redirect::seller('order')->withQuery(['page'=>'packing'])->getUrl() ?>" class="block px-4 py-2 rounded-md linear duration-200 hover:bg-blue-400 hover:text-white <?= $group . '-' . $page == 'order-packing' ? 'bg-blue-400 font-semibold text-white' : '' ?>">Đang đóng gói</a>
        <a href="<?= Redirect::seller('order')->withQuery(['page'=>'packed'])->getUrl() ?>" class="block px-4 py-2 rounded-md linear duration-200 hover:bg-blue-400 hover:text-white <?= $group . '-' . $page == 'order-packed' ? 'bg-blue-400 font-semibold text-white' : '' ?>">Đã đóng gói</a>
        <a href="<?= Redirect::seller('order')->withQuery(['page'=>'shipping'])->getUrl() ?>" class="block px-4 py-2 rounded-md linear duration-200 hover:bg-blue-400 hover:text-white <?= $group . '-' . $page == 'order-shipping' ? 'bg-blue-400 font-semibold text-white' : '' ?>">Đang vận chuyển</a>
        <a href="<?= Redirect::seller('order')->withQuery(['page'=>'dilivered'])->getUrl() ?>" class="block px-4 py-2 rounded-md linear duration-200 hover:bg-blue-400 hover:text-white <?= $group . '-' . $page == 'order-dilivered' ? 'bg-blue-400 font-semibold text-white' : '' ?>">Đã giao hàng</a>
        <a href="<?= Redirect::seller('order')->withQuery(['page'=>'completed'])->getUrl() ?>" class="block px-4 py-2 rounded-md linear duration-200 hover:bg-blue-400 hover:text-white <?= $group . '-' . $page == 'order-completed' ? 'bg-blue-400 font-semibold text-white' : '' ?>">Đã hoàn thành</a>
        <a href="<?= Redirect::seller('order')->withQuery(['page'=>'returned'])->getUrl() ?>" class="block px-4 py-2 rounded-md linear duration-200 hover:bg-blue-400 hover:text-white <?= $group . '-' . $page == 'order-returned' ? 'bg-blue-400 font-semibold text-white' : '' ?>">Đơn hoàn trả</a>
        <a href="<?= Redirect::seller('order')->withQuery(['page'=>'cancelled'])->getUrl() ?>" class="block px-4 py-2 rounded-md linear duration-200 hover:bg-blue-400 hover:text-white <?= $group . '-' . $page == 'order-cancelled' ? 'bg-blue-400 font-semibold text-white' : '' ?>">Đã hủy</a>
    </nav>
</div>

<!-- Quản lý sản phẩm -->
<div class="mb-6">
    <h3 class="text-lg font-semibold mb-2">Quản lý sản phẩm</h3>
    <nav class="space-y-1">
        <a href="<?= Redirect::seller('product')->withQuery(['page'=>'all'])->getUrl() ?>" class="block px-4 py-2 rounded-md linear duration-200 hover:bg-blue-400 hover:text-white <?= $group . '-' . $page == 'product-all' ? 'bg-blue-400 font-semibold text-white' : '' ?>">Tất cả</a>
        <a href="<?= Redirect::seller('product')->withQuery(['page'=>'in-stock'])->getUrl() ?>" class="block px-4 py-2 rounded-md linear duration-200 hover:bg-blue-400 hover:text-white <?= $group . '-' . $page == 'product-in-stock' ? 'bg-blue-400 font-semibold text-white' : '' ?>">Còn hàng</a>
        <a href="<?= Redirect::seller('product')->withQuery(['page'=>'out-of-stock'])->getUrl() ?>" class="block px-4 py-2 rounded-md linear duration-200 hover:bg-blue-400 hover:text-white <?= $group . '-' . $page == 'product-out-of-stock' ? 'bg-blue-400 font-semibold text-white' : '' ?>">Hết hàng</a>
        <a href="<?= Redirect::seller('product')->withQuery(['page'=>'locked'])->getUrl() ?>" class="block px-4 py-2 rounded-md linear duration-200 hover:bg-blue-400 hover:text-white <?= $group . '-' . $page == 'product-locked' ? 'bg-blue-400 font-semibold text-white' : '' ?>">Đã bị khóa</a>
        <a href="<?= Redirect::seller('product')->withQuery(['page'=>'hidden'])->getUrl() ?>" class="block px-4 py-2 rounded-md linear duration-200 hover:bg-blue-400 hover:text-white <?= $group . '-' . $page == 'product-hidden' ? 'bg-blue-400 font-semibold text-white' : '' ?>">Đã ẩn</a>
        <a href="<?= Redirect::seller('product')->withQuery(['page'=>'deleted'])->getUrl() ?>" class="block px-4 py-2 rounded-md linear duration-200 hover:bg-blue-400 hover:text-white <?= $group . '-' . $page == 'product-deleted' ? 'bg-blue-400 font-semibold text-white' : '' ?>">Đã xóa</a>
    </nav>
</div>