<div class="row">
    <div class="col-12">
        <span class="text-center font-size-6 fw-bold">Login</span>
    </div>
    <div class="col-12">
        <form autocomplete="off" action="<?= BASE_URL ?>/login" method="post">
            <div class="form-group">
                <label for="phone">Số điện thoại</label>
                <input type="text" name="phone" class="form-control" id="phone" placeholder="Nhập số điện thoại">
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Nhập mật khẩu">
            </div>
            <div class="mt-3">
                <div class="form-group-checkbox">
                    <input type="checkbox" id="checkbox" class="input-checkbox">
                    <label for="checkbox" class="label-checkbox"></label>
                </div>
                <label for="save_login">Lưu thông tin đăng nhập</label>
            </div>
            <div class="mt-3">
                <button class="btn w-100" type="submit">Đăng nhập</button>
            </div>
        </form>
    </div>
</div>