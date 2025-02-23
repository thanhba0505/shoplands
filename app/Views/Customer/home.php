<!-- Banner Header -->
<div class="flex flex-col items-center">
    <div class="w-full">
        <div class="text-center text-2xl font-bold mb-3">Banner</div>
    </div>
</div>

<!-- Danh mục -->
<div class="grid grid-cols-12 gap-4">
    <div class="col-span-12 text-center text-xl font-bold pt-3">Danh mục</div>

    <!-- Category Item -->
    <?php if (!empty($categories)): ?>
        <?php foreach ($categories as $category): ?>
            <div class="col-span-2">
                <a href="<?= Redirect::product()->withQuery(['categories[]' => $category['id']])->getUrl() ?>" class="flex flex-col items-center">
                    <div class="w-full h-32">
                        <img class="object-cover w-full h-full" src="<?= Asset::getImgApp($category['slug'] . '.webp') ?>" alt="">
                    </div>
                    <span class="text-center text-sm truncate w-full max-w-[150px] mt-2"><?= Util::encodeHtml($category['name']) ?></span>
                </a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<!-- Gợi ý sản phẩm -->
<div class="mt-12">
    <?= Other::renderProducts($products,'Gợi ý cho bạn', 6, 'Xem ngay', Redirect::product()->getUrl()); ?>
</div>

<!-- Đăng ký bán hàng -->
<div class="mt-10 flex flex-col items-center">
    <div class="text-center text-xl font-bold mb-3">Bán hàng cùng chúng tôi</div>
    <a href="#" class="px-5 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">Tham gia ngay</a>
</div>

<!-- Bài viết -->
<div class="mt-10">
    <div class="text-center text-xl font-bold py-3 bg-gray-100">Bài viết mới nhất</div>
    <div class="grid grid-cols-12 gap-4 mt-4">
        <div class="col-span-3">
            <a href="#" class="flex flex-col items-start p-4 border rounded-lg hover:shadow-md">
                <img class="mb-3 w-full h-32 object-cover" src="<?= Asset::getImgUpload('cap-sac.webp') ?>" alt="">
                <span class="line-clamp-2 w-full font-bold text-sm leading-tight">20w Sạc Nhanh Thông Minh USB C PD US Cắm Dữ Liệu Sạc Nhanh 1Meter PD Cáp Adapter USB-C Dây Cắm</span>
                <div class="flex items-center mt-2">
                    <i class="fa-solid fa-star text-yellow-400"></i>
                    <i class="fa-solid fa-star text-yellow-400"></i>
                    <i class="fa-solid fa-star text-yellow-400"></i>
                    <i class="fa-regular fa-star text-gray-400"></i>
                    <i class="fa-regular fa-star text-gray-400"></i>
                </div>
                <div class="mt-2 flex items-center justify-between w-full">
                    <span class="line-through text-sm text-gray-500">3.000.000đ</span>
                    <span class="text-red-500 font-bold">200.000đ</span>
                </div>
                <span class="text-sm text-gray-600">Đã bán 10k</span>
            </a>
        </div>
    </div>
    <div class="flex justify-center mt-5">
        <a href="#" class="px-5 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Xem thêm</a>
    </div>
</div>