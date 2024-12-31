<div class="row">
    <div class="col-12">
        <span class="text-center font-size-6 fw-bold">Login</span>
    </div>
    <div class="col-12">
        <form action="<?= BASE_URL ?>/login" method="post">
            <input type="hidden" name="csrf" value="<?= CSRF::getToken() ?>">
            <div class="form-group">
                <label for="phone">Số điện thoại</label>
                <input type="text" name="phone" class="form-control" id="phone" placeholder="Nhập số điện thoại">
            </div>
            <div class="form-group mt-3">
                <label for="password">Mật khẩu</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Nhập mật khẩu">
            </div>
            <div class="mt-5 pt-3">
                <button class="btn w-100" type="submit">Đăng nhập</button>
            </div>
        </form>
    </div>
</div>