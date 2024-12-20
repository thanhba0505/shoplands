<div class="bg-light p-4 rounded-2 box-shadow sidebar-seller">
    <span class="mb-2 font-size-4 fw-bold">Quản lý đơn hàng</span>
    <a href="<?= BASE_URL ?>/seller/orders/all" class="<?= $group . '-' . $page == 'order-all' ? 'active' : ''; ?>">Tất cả</a>
    <a href="<?= BASE_URL ?>/seller/orders/pending" class="<?= $group . '-' . $page == 'order-pending' ? 'active' : ''; ?>">Chờ xác nhận</a>
    <a href="<?= BASE_URL ?>/seller/orders/packing" class="<?= $group . '-' . $page == 'order-packing' ? 'active' : ''; ?>">Đang đóng gói</a>
    <a href="<?= BASE_URL ?>/seller/orders/packed" class="<?= $group . '-' . $page == 'order-packed' ? 'active' : ''; ?>">Đã đóng gói</a>
    <a href="<?= BASE_URL ?>/seller/orders/shipping" class="<?= $group . '-' . $page == 'order-shipping' ? 'active' : ''; ?>">Đang vận chuyển</a>
    <a href="<?= BASE_URL ?>/seller/orders/dilivered" class="<?= $group . '-' . $page == 'order-dilivered' ? 'active' : ''; ?>">Đã giao hàng</a>
    <a href="<?= BASE_URL ?>/seller/orders/completed" class="<?= $group . '-' . $page == 'order-completed' ? 'active' : ''; ?>">Đã hoàn thành</a>
    <a href="<?= BASE_URL ?>/seller/orders/returned" class="<?= $group . '-' . $page == 'order-returned' ? 'active' : ''; ?>">Đơn hoàn trả</a>
    <a href="<?= BASE_URL ?>/seller/orders/cancelled" class="<?= $group . '-' . $page == 'order-cancelled' ? 'active' : ''; ?>">Đã hủy</a>

    <span class="mt-3 mb-2 font-size-4 fw-bold">Quản lý sản phẩm</span>
    <a href="<?= BASE_URL ?>/seller/products/all" class="<?= $group . '-' . $page == 'product-all' ? 'active' : ''; ?>">Tất cả</a>
    <a href="<?= BASE_URL ?>/seller/products/in-stock" class="<?= $group . '-' . $page == 'product-in-stock' ? 'active' : ''; ?>">Còn hàng</a>
    <a href="<?= BASE_URL ?>/seller/products/out-of-stock" class="<?= $group . '-' . $page == 'product-out-of-stock' ? 'active' : ''; ?>">Hết hàng</a>
    <a href="<?= BASE_URL ?>/seller/products/locked" class="<?= $group . '-' . $page == 'product-locked' ? 'active' : ''; ?>">Đã bị khóa</a>
    <a href="<?= BASE_URL ?>/seller/products/hidden" class="<?= $group . '-' . $page == 'product-hidden' ? 'active' : ''; ?>">Đã ẩn</a>
    <a href="<?= BASE_URL ?>/seller/products/deleted" class="<?= $group . '-' . $page == 'product-deleted' ? 'active' : ''; ?>">Đã xóa</a>

    <span class="mt-3 mb-2 font-size-4 fw-bold">Kênh marketing</span>
    <a href="<?= BASE_URL ?>/seller/orders/all">Mã giảm giá</a>
    <a href="<?= BASE_URL ?>/seller/orders/all">Combo khuyến mãi</a>
    <a href="<?= BASE_URL ?>/seller/orders/all">Flash sale</a>

    <span class="mt-3 mb-2 font-size-4 fw-bold">Quản lý đánh giá</span>
    <a href="<?= BASE_URL ?>/seller/orders/all">Tất cả</a>
    <a href="<?= BASE_URL ?>/seller/orders/all">Chưa trả lời</a>
    <a href="<?= BASE_URL ?>/seller/orders/all">Đã trả lời</a>

    <span class="mt-3 mb-2 font-size-4 fw-bold">Cài đặt cửa hàng</span>
    <a href="<?= BASE_URL ?>/seller/orders/all">Thông tin cửa hàng</a>
    <a href="<?= BASE_URL ?>/seller/orders/all">Trang trí cửa hàng</a>
    <a href="<?= BASE_URL ?>/seller/orders/all">Ghim sản phẩm nổi bật</a>
</div>