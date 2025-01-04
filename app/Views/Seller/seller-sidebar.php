<!-- Quản lý đơn hàng -->
<div class="mb-6">
    <h3 class="text-lg font-semibold mb-2">Quản lý đơn hàng</h3>
    <nav class="space-y-1">
        <a href="<?= Redirect::url('seller/orders/all') ?>" class="block px-4 py-2 rounded-md linear duration-200 hover:bg-blue-400 hover:text-white hover:text-white <?= $group . '-' . $page == 'order-all' ? 'bg-blue-400 font-semibold text-white' : '' ?>">Tất cả</a>
        <a href="<?= Redirect::url('seller/orders/pending') ?>" class="block px-4 py-2 rounded-md linear duration-200 hover:bg-blue-400 hover:text-white hover:text-white <?= $group . '-' . $page == 'order-pending' ? 'bg-blue-400 font-semibold text-white' : '' ?>">Chờ xác nhận</a>
        <a href="<?= Redirect::url('seller/orders/packing') ?>" class="block px-4 py-2 rounded-md linear duration-200 hover:bg-blue-400 hover:text-white hover:text-white <?= $group . '-' . $page == 'order-packing' ? 'bg-blue-400 font-semibold text-white' : '' ?>">Đang đóng gói</a>
        <a href="<?= Redirect::url('seller/orders/packed') ?>" class="block px-4 py-2 rounded-md linear duration-200 hover:bg-blue-400 hover:text-white hover:text-white <?= $group . '-' . $page == 'order-packed' ? 'bg-blue-400 font-semibold text-white' : '' ?>">Đã đóng gói</a>
        <a href="<?= Redirect::url('seller/orders/shipping') ?>" class="block px-4 py-2 rounded-md linear duration-200 hover:bg-blue-400 hover:text-white hover:text-white <?= $group . '-' . $page == 'order-shipping' ? 'bg-blue-400 font-semibold text-white' : '' ?>">Đang vận chuyển</a>
        <a href="<?= Redirect::url('seller/orders/dilivered') ?>" class="block px-4 py-2 rounded-md linear duration-200 hover:bg-blue-400 hover:text-white hover:text-white <?= $group . '-' . $page == 'order-dilivered' ? 'bg-blue-400 font-semibold text-white' : '' ?>">Đã giao hàng</a>
        <a href="<?= Redirect::url('seller/orders/completed') ?>" class="block px-4 py-2 rounded-md linear duration-200 hover:bg-blue-400 hover:text-white hover:text-white <?= $group . '-' . $page == 'order-completed' ? 'bg-blue-400 font-semibold text-white' : '' ?>">Đã hoàn thành</a>
        <a href="<?= Redirect::url('seller/orders/returned') ?>" class="block px-4 py-2 rounded-md linear duration-200 hover:bg-blue-400 hover:text-white hover:text-white <?= $group . '-' . $page == 'order-returned' ? 'bg-blue-400 font-semibold text-white' : '' ?>">Đơn hoàn trả</a>
        <a href="<?= Redirect::url('seller/orders/cancelled') ?>" class="block px-4 py-2 rounded-md linear duration-200 hover:bg-blue-400 hover:text-white hover:text-white <?= $group . '-' . $page == 'order-cancelled' ? 'bg-blue-400 font-semibold text-white' : '' ?>">Đã hủy</a>
    </nav>
</div>

<!-- Quản lý sản phẩm -->
<div class="mb-6">
    <h3 class="text-lg font-semibold mb-2">Quản lý sản phẩm</h3>
    <nav class="space-y-1">
        <a href="<?= Redirect::url('seller/products/all') ?>" class="block px-4 py-2 rounded-md linear duration-200 hover:bg-blue-400 hover:text-white hover:text-white <?= $group . '-' . $page == 'product-all' ? 'bg-blue-400 font-semibold text-white' : '' ?>">Tất cả</a>
        <a href="<?= Redirect::url('seller/products/in-stock') ?>" class="block px-4 py-2 rounded-md linear duration-200 hover:bg-blue-400 hover:text-white hover:text-white <?= $group . '-' . $page == 'product-in-stock' ? 'bg-blue-400 font-semibold text-white' : '' ?>">Còn hàng</a>
        <a href="<?= Redirect::url('seller/products/out-of-stock') ?>" class="block px-4 py-2 rounded-md linear duration-200 hover:bg-blue-400 hover:text-white hover:text-white <?= $group . '-' . $page == 'product-out-of-stock' ? 'bg-blue-400 font-semibold text-white' : '' ?>">Hết hàng</a>
        <a href="<?= Redirect::url('seller/products/locked') ?>" class="block px-4 py-2 rounded-md linear duration-200 hover:bg-blue-400 hover:text-white hover:text-white <?= $group . '-' . $page == 'product-locked' ? 'bg-blue-400 font-semibold text-white' : '' ?>">Đã bị khóa</a>
        <a href="<?= Redirect::url('seller/products/hidden') ?>" class="block px-4 py-2 rounded-md linear duration-200 hover:bg-blue-400 hover:text-white hover:text-white <?= $group . '-' . $page == 'product-hidden' ? 'bg-blue-400 font-semibold text-white' : '' ?>">Đã ẩn</a>
        <a href="<?= Redirect::url('seller/products/deleted') ?>" class="block px-4 py-2 rounded-md linear duration-200 hover:bg-blue-400 hover:text-white hover:text-white <?= $group . '-' . $page == 'product-deleted' ? 'bg-blue-400 font-semibold text-white' : '' ?>">Đã xóa</a>
    </nav>
</div>