<div class="bg-white p-6 rounded-lg border shadow mx-auto w-full max-w-sm my-20">
    <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">
        Đăng Nhập
    </h2>
    <form action="#" method="POST">
        <?= CSRF::input() ?>
        <!-- Ho_ten -->
        <div class="mb-4">
            <label
                for="name"
                class="block text-sm font-medium text-gray-600">Họ và Tên</label>
            <input
                type="text"
                id="name"
                name="name"
                required
                class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
        </div>
        <!-- Email -->
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
        <!-- Ghi nhớ -->
        <div class="flex items-center justify-end mb-4">
            <a href="#" class="text-sm text-blue-500 hover:underline">Quên mật khẩu?</a>
        </div>
        <!-- Nút đăng nhập -->
        <button
            type="submit"
            class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            Đăng Nhập
        </button>
    </form>
    <p class="text-sm text-gray-600 mt-4 text-center">
        Bạn chưa có tài khoản?
        <a href="#" class="text-blue-500 hover:underline">Đăng ký</a>
    </p>
</div>