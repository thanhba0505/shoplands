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
        
    </div>
    <div class="flex justify-center mt-5">
        <a href="#" class="px-5 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Xem thêm</a>
    </div>
</div>