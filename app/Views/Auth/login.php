<div class="row">
    <div class="col-12">
        <a href="<?= Redirect::url('/') ?>" style="width: 180px" class="m-auto py-1 px-2">
            <?= Asset::logoSvg('var(--light-color)') ?>
        </a>
        <!-- <span class="text-center font-size-4 fw-bold">Login</span> -->
    </div>
    <div class="col-12">
        <form action="<?= BASE_URL ?>/login" method="post" class="pb-4 px-5">
            <input type="hidden" name="csrf" value="<?= CSRF::getToken() ?>">
            <div class="form-group">
                <label class="font-size-3 pb-2" for="phone">Số điện thoại</label>
                <input type="text" name="phone" class="form-control" id="phone" placeholder="Nhập số điện thoại">
            </div>
            <div class="form-group mt-4">
                <label class="font-size-3 pb-2" for="password">Mật khẩu</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Nhập mật khẩu">
            </div>
            <div class="mt-5 pt-3">
                <button class="btn w-100" type="submit">Đăng nhập</button>
            </div>
        </form>
    </div>
</div>