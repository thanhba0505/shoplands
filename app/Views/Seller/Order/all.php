<div class="row ">
    <div class="col-3">
        <?php include './app/views/layout/sidebar-seller.php'; ?>
    </div>

    <div class="col-9">
        <div class="bg-light p-3 rounded-2 box-shadow">
            <h2>Quản lý đơn hàng</h2>
            <div class="d-flex nav-tabs mt-3">
                <a href="<?= BASE_URL ?>/seller/orders/all" class="<?= $page == 'all' ? 'active' : ''; ?>">Tất cả</a>
                <a href="<?= BASE_URL ?>/seller/orders/pending" class="<?= $page == 'pending' ? 'active' : ''; ?>">Chờ xác nhận</a>
                <a href="<?= BASE_URL ?>/seller/orders/packing" class="<?= $page == 'packing' ? 'active' : ''; ?>">Đang đóng gói</a>
                <a href="<?= BASE_URL ?>/seller/orders/packed" class="<?= $page == 'packed' ? 'active' : ''; ?>">Đã đóng gói</a>
                <a href="<?= BASE_URL ?>/seller/orders/shipping" class="<?= $page == 'shipping' ? 'active' : ''; ?>">Đang vận chuyển</a>
                <a href="<?= BASE_URL ?>/seller/orders/dilivered" class="<?= $page == 'dilivered' ? 'active' : ''; ?>">Đã giao hàng</a>
                <a href="<?= BASE_URL ?>/seller/orders/completed" class="<?= $page == 'completed' ? 'active' : ''; ?>">Đã hoàn thành</a>
                <a href="<?= BASE_URL ?>/seller/orders/returned" class="<?= $page == 'returned' ? 'active' : ''; ?>">Đơn hoàn trả</a>
                <a href="<?= BASE_URL ?>/seller/orders/cancelled" class="<?= $page == 'cancelled' ? 'active' : ''; ?>">Đã hủy</a>
            </div>

            <div class="filter mt-3">
                Lọc
            </div>

            <table class="table table-borderless table-light table-align-middle table-order-all">
                <thead>
                    <tr>
                        <td>Sản phẩm</td>
                        <td>Tổng tiền đơn hàng</td>
                        <td>Doanh thu đơn hàng</td>
                        <td>Đơn vị vận chuyển</td>
                        <td>Thời gian tạo đơn</td>
                        <td>Trạng thái</td>
                        <td>Thao tác</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="7"></td>
                    </tr>
                    <tr>
                        <td colspan="3">Tên người mua</td>
                        <td colspan="4">Mã đơn hàng: 01203453</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex justify-content-between">
                                <div class="order-all-img"><img src="<?= BASE_URL ?>/public/uploads/img/cap-sac.webp" alt=""></div>
                                <div class="text-ellipsis-4 fs-5" style="width: 80%;">20w Sạc Nhanh Thông Minh USB C PD US Cắm Dữ Liệu Sạc Nhanh 1Meter PD Cáp Adapter USB-C Dây Cắm</div>
                            </div>
                        </td>
                        <td>
                            <h5>200.000đ</h5>
                        </td>
                        <td>
                            <h5>180.000đ</h5>
                        </td>
                        <td>
                            <div>Giao hàng nhanh</div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>