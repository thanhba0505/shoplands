<div class="row ">
    <div class="col-3">
        <?php include './app/views/layout/sidebar-seller.php'; ?>
    </div>

    <div class="col-9">
        <div class="bg-light p-4 rounded-2 box-shadow">
            <h2>Quản lý sản phẩm</h2>
            <div class="nav-tabs mt-3">
                <a href="<?= BASE_URL ?>/seller/products/all" class="<?= $page == 'all' ? 'active' : ''; ?>">Tất cả</a>
                <a href="<?= BASE_URL ?>/seller/products/in-stock" class="<?= $page == 'in-stock' ? 'active' : ''; ?>">Chờ xác nhận</a>
                <a href="<?= BASE_URL ?>/seller/products/out-of-stock" class="<?= $page == 'out-of-stock' ? 'active' : ''; ?>">Đang đóng gói</a>
                <a href="<?= BASE_URL ?>/seller/products/locked" class="<?= $page == 'locked' ? 'active' : ''; ?>">Đã đóng gói</a>
                <a href="<?= BASE_URL ?>/seller/products/hidden" class="<?= $page == 'hidden' ? 'active' : ''; ?>">Đang vận chuyển</a>
                <a href="<?= BASE_URL ?>/seller/products/deleted" class="<?= $page == 'deleted' ? 'active' : ''; ?>">Đã giao hàng</a>
            </div>

            <div class="text-center bg-2 py-3 mt-5">
                Lọc
            </div>

            <div class="text-center bg-2 py-3 mt-5">
                thanh công cụ các kiểu
            </div>

            <table class="table position-relative table-align-middle mt-5 font-size-1 border-color-1 table-order-all">
                <thead>
                    <tr class="table-color-1-opacity-3 text-center table-border-1 border-width-2 ">
                        <td>Sản phẩm</td>
                        <td>Thuộc tính</td>
                        <td>Giá trị thuộc tính</td>
                        <td>Giá gốc</td>
                        <td>Giá khuyến mãi</td>
                        <td>Kho</td>
                        <td>Đã bán</td>
                        <td>Thao tác</td>
                    </tr>
                </thead>
                <tbody>

                    <!-- Lặp sản phẩm
                    <?php for ($i = 0; $i < 5; $i++): ?>

                        <tr class="table-color-1-opacity-3 table-border-1 border-width-2 font-size-2">
                            <td colspan="3" style="border-right: none;" class="fw-bold">Tên người mua</td>
                            <td colspan="4" class="text-right" style="border-left: none;">Mã đơn hàng: 01203453</td>
                        </tr>

                        <tr class="text-center fw-bold table-border-1 border-width-2 ">
                            <td width="300px">

                                <?php $limit = rand(1, 3); ?>
                                <?php for ($j = 0; $j < $limit; $j++): ?>

                                    <div class="d-flex justify-content-between align-items-center <?= $j != $limit - 1 ? 'mb-3' : ''; ?>">
                                        <div class="square-40 border-color"><img class="square-40" src="<?= BASE_URL ?>/public/uploads/img/cap-sac.webp" alt=""></div>
                                        <div class="text-ellipsis-2 text-left" style=" width: 70%; height: 36px">20w Sạc Nhanh Thông Minh USB C PD US Cắm Dữ Liệu Sạc Nhanh 1Meter PD Cáp Adapter USB-C Dây Cắm</div>
                                        <div class="" style="">x<?= rand(1, 3) ?></div>
                                    </div>

                                <?php endfor; ?>

                            </td>
                            <td>
                                <span>200.000đ</span>
                            </td>
                            <td>
                                <span>180.000đ</span>
                            </td>
                            <td>
                                <span>Giao hàng nhanh</span>
                            </td>
                            <td>
                                <span>01/01/2022</span>
                            </td>
                            <td>
                                <span>Đang đóng gói</span>
                            </td>
                            <td>
                                <a href="<?= BASE_URL ?>/seller/orders/detail" class="link">Chi tiết</a>

                                <?php
                                $trang_thai = $page ?? null;

                                switch ($trang_thai) {
                                    case 'pending':
                                        echo '<a href="' . BASE_URL .  '/seller/orders/detail" class="link">Xác nhận</a>';
                                        break;
                                    case 'packing':
                                        echo '<a href="' . BASE_URL .  '/seller/orders/detail" class="link">Đã đóng gói</a>';
                                        break;
                                    case 'packed':
                                        echo '<a href="' . BASE_URL .  '/seller/orders/detail" class="link">Đã giao</a>';
                                        break;
                                    case 'returned':
                                        echo '<a href="' . BASE_URL .  '/seller/orders/detail" class="link">Chấp nhận</a>';
                                        echo '<a href="' . BASE_URL .  '/seller/orders/detail" class="link">Từ chối</a>';
                                        break;
                                    default:
                                        $a = null;
                                        break;
                                }
                                ?>
                            </td>
                        </tr>
                    <?php endfor; ?> -->

                </tbody>
            </table>

            <?php echo $users; ?>
            <?php echo BASE_URL; ?>
            <?php echo BASE_PATH; ?>

        </div>
    </div>
</div>