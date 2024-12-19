<div class="bg-light p-3 rounded-2 box-shadow sidebar-seller">
    <h3 class="mb-1">Quản lý đơn hàng</h3>
    <a href="<?= BASE_URL ?>/seller/orders/all" class="<?= $page == 'all' ? 'active' : ''; ?>">Tất cả</a>
    <a href="<?= BASE_URL ?>/seller/orders/pending" class="<?= $page == 'pending' ? 'active' : ''; ?>">Chờ xác nhận</a>
    <a href="<?= BASE_URL ?>/seller/orders/packing" class="<?= $page == 'packing' ? 'active' : ''; ?>">Đang đóng gói</a>
    <a href="<?= BASE_URL ?>/seller/orders/packed" class="<?= $page == 'packed' ? 'active' : ''; ?>">Đã đóng gói</a>
    <a href="<?= BASE_URL ?>/seller/orders/shipping" class="<?= $page == 'shipping' ? 'active' : ''; ?>">Đang vận chuyển</a>
    <a href="<?= BASE_URL ?>/seller/orders/dilivered" class="<?= $page == 'dilivered' ? 'active' : ''; ?>">Đã giao hàng</a>
    <a href="<?= BASE_URL ?>/seller/orders/completed" class="<?= $page == 'completed' ? 'active' : ''; ?>">Đã hoàn thành</a>
    <a href="<?= BASE_URL ?>/seller/orders/returned" class="<?= $page == 'returned' ? 'active' : ''; ?>">Đơn hoàn trả</a>
    <a href="<?= BASE_URL ?>/seller/orders/cancelled" class="<?= $page == 'cancelled' ? 'active' : ''; ?>">Đã hủy</a>

    <h3 class="mt-2 mb-1">Quản lý sản phẩm</h3>
    <a href="<?= BASE_URL ?>/seller/products/all">Tất cả</a>
    <a href="<?= BASE_URL ?>/seller/products/all">Còn hàng</a>
    <a href="<?= BASE_URL ?>/seller/products/all">Hết hàng</a>
    <a href="<?= BASE_URL ?>/seller/products/all">Đã bị khóa</a>
    <a href="<?= BASE_URL ?>/seller/products/all">Đã ẩn</a>
    <a href="<?= BASE_URL ?>/seller/products/all">Đã xóa</a>

    <h3 class="mt-2 mb-1">Kênh marketing</h3>
    <a href="<?= BASE_URL ?>/seller/orders/all">Mã giảm giá</a>
    <a href="<?= BASE_URL ?>/seller/orders/all">Combo khuyến mãi</a>
    <a href="<?= BASE_URL ?>/seller/orders/all">Flash sale</a>

    <h3 class="mt-2 mb-1">Quản lý đánh giá</h3>
    <a href="<?= BASE_URL ?>/seller/orders/all">Tất cả</a>
    <a href="<?= BASE_URL ?>/seller/orders/all">Chưa trả lời</a>
    <a href="<?= BASE_URL ?>/seller/orders/all">Đã trả lời</a>

    <h3 class="mt-2 mb-1">Cài đặt cửa hàng</h3>
    <a href="<?= BASE_URL ?>/seller/orders/all">Thông tin cửa hàng</a>
    <a href="<?= BASE_URL ?>/seller/orders/all">Trang trí cửa hàng</a>
    <a href="<?= BASE_URL ?>/seller/orders/all">Ghim sản phẩm nổi bật</a>
</div>