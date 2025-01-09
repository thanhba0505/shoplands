<div class="bg-white p-6 rounded-lg border shadow mx-auto w-full max-w-sm my-14">
    <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">
        Đăng Ký
    </h2>
    <form action="#" method="POST">
        <?= CSRF::input() ?>
        <!-- Số điện thoại -->
        <div class="mb-4">
            <label
                for="phone"
                class="block text-sm font-medium text-gray-600">Số điện thoại</label>
            <input
                type="text"
                id="phone"
                name="phone"
                required
                class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
        </div>

        <!-- Mật khẩu -->
        <div class="mb-4">
            <label
                for="password"
                class="block text-sm font-medium text-gray-600">Mật khẩu</label>
            <input
                type="password"
                id="password"
                name="password"
                required
                class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
        </div>

        <!-- Nhập lại mật khẩu -->
        <div class="mb-4">
            <label
                for="password"
                class="block text-sm font-medium text-gray-600">Nhập lại mật khẩu</label>
            <input
                type="password"
                id="password"
                name="password"
                required
                class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
        </div>

        <div class="mb-4 grid grid-cols-3 gap-2 items-center">
            <div class="col-span-3">

                <label
                    for="verification-code"
                    class="block text-sm font-medium text-gray-600">Nhập mã xác thực</label>
            </div>

            <!-- Ô nhập mã xác thực -->
            <div class="col-span-2">
                <input
                    type="text"
                    id="verification-code"
                    name="verification-code"
                    required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
            </div>

            <!-- Nút xác thực -->
            <div>
                <button
                    type="button"
                    id="verify-button"
                    class="w-full px-4 py-2 font-medium text-white bg-gray-500 rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                    Gửi mã
                </button>
            </div>
        </div>

        <!-- Nút đồng ý điều khoản và chính sách bảo mật -->
        <div class="mb-4">
            <label class="flex items-center">
                <input
                    type="checkbox"
                    id="terms-and-privacy"
                    name="terms-and-privacy"
                    required
                    class="w-4 h-4 text-blue-500 border-gray-300 rounded focus:ring-blue-500">
                <span class="ml-2 text-sm text-gray-600">
                    Tôi đồng ý với
                    <a href="/terms" target="_blank" class="text-blue-500 hover:underline">
                        Điều khoản
                    </a> và
                    <a href="/privacy" target="_blank" class="text-blue-500 hover:underline">
                        Chính sách bảo mật
                    </a>
                </span>
            </label>
        </div>


        <!-- Nút đăng ký -->
        <button
            type="submit"
            class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            Đăng ký
        </button>
    </form>
    <p class="text-sm text-gray-600 mt-4 text-center">
        Bạn đã có tài khoản?
        <a href="<?= Redirect::login() ?>" class="text-blue-500 hover:underline">Đăng nhập</a>
    </p>
</div>