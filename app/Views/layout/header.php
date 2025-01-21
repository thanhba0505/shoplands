<nav class="bg-blue-600 text-white py-4 sticky top-0 z-50">
    <div class="2xl:container mx-auto px-6">
        <div class="flex justify-between items-center">
            <div class="text-lg font-semibold">
                <a href="<?= Redirect::home()->getUrl() ?>" style="width: 120px">
                    <?= Asset::logoSvg('fill-white', 120) ?>
                </a>
            </div>
            <div>
                <a href="<?= Redirect::product()->getUrl() ?>" class="px-4 py-2 hover:bg-blue-700">Sản phẩm</a>
                <a href="<?= Redirect::post()->getUrl() ?>" class="px-4 py-2 hover:bg-blue-700">Bài viết</a>
                <?php if (Auth::checkAuth()) : ?>
                    <a href="<?= Redirect::cart()->getUrl() ?>" class="px-4 py-2 hover:bg-blue-700">Giỏ hàng</a>
                    <a href="<?= Redirect::order()->getUrl() ?>" class="px-4 py-2 hover:bg-blue-700">Lịch sử đơn hàng</a>
                <?php else : ?>
                    <a href="<?= Redirect::login()->getUrl() ?>" class="px-4 py-2 hover:bg-blue-700">Đăng nhập</a>
                    <a href="<?= Redirect::register()->getUrl() ?>" class="px-4 py-2 hover:bg-blue-700">Đăng ký</a>
                <?php endif ?>
            </div>
            <div class="flex justify-between items-center">
                <div class="relative w-80 max-w-md">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                        <i class="fas fa-search"></i>
                    </span>
                    <input
                        type="text"
                        placeholder="Tìm kiếm..."
                        class="w-full pl-10 pr-4 py-2 h-10 text-base text-gray-900 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <?php if (Auth::checkAuth()) : ?>
                    <div x-data="{ open: false }" class="relative w-10 h-10 ml-5">
                        <!-- Button with Circle Icon -->
                        <button
                            @click="open = !open"
                            class="w-10 h-10 flex items-center justify-center rounded-full overflow-hidden border-2 border-gray-300 bg-gray-100 text-gray-600 hover:bg-gray-200">
                            <i class="fa-regular fa-bell text-xl"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div
                            x-show="open"
                            @click.away="open = false"
                            x-transition
                            class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-md overflow-hidden">
                            <a href="#" @click="open = false" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Kênh người bán</a>
                            <a href="<?= Redirect::accountSettings()->getUrl() ?>" @click="open = false" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Thiết lập thông tin</a>
                            <a href="#" @click="open = false" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Đăng xuất</a>
                        </div>
                    </div>
                <?php endif ?>

                <!-- Dropdown Menu Button -->
                <div x-data="{ open: false }" class="relative w-10 h-10 ml-5">
                    <!-- Button with Circle Image -->

                    <?php if (Auth::checkAuth()) : ?>
                        <button @click="open = !open" class="w-10 h-10 rounded-full overflow-hidden border-2 border-gray-300">
                            <img src="https://ih1.redbubble.net/image.5331360186.6213/st,small,845x845-pad,1000x1000,f8f8f8.jpg" alt="Profile" class="w-full h-full object-cover">
                        </button>
                    <?php else : ?>
                        <button
                            @click="open = !open"
                            class="w-10 h-10 flex items-center justify-center rounded-full overflow-hidden border-2 border-gray-300 bg-gray-100 text-gray-600 hover:bg-gray-200">
                            <i class="fa-regular fa-user text-xl"></i>
                        </button>
                    <?php endif ?>
                    <!-- Dropdown Menu -->
                    <div
                        x-show="open"
                        @click.away="open = false"
                        x-transition
                        class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-md overflow-hidden">
                        <?php if (Auth::checkAuth()) : ?>
                            <a href="<?= Redirect::seller('order')->getUrl() ?>" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Kênh người bán</a>
                            <a href="<?= Redirect::accountSettings()->getUrl() ?>" @click="open = false" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Thiết lập thông tin</a>
                            <a href="<?= Redirect::logout()->getUrl() ?>" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Đăng xuất</a>
                        <?php else : ?>
                            <a href="<?= Redirect::login()->getUrl() ?>" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Đăng nhập</a>
                            <a href="<?= Redirect::register()->getUrl() ?>" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Đăng ký</a>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>