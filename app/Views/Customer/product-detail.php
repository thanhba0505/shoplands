<!-- Breadcrumb -->
<nav class="text-sm text-gray-600 mb-4">
    <a href="#" class="text-blue-500 hover:underline">Shopee</a> &gt;
    <a href="#" class="text-blue-500 hover:underline">Mẹ & Bé</a> &gt;
    <a href="#" class="text-blue-500 hover:underline">Đồ chơi</a> &gt;
    <a href="#" class="text-blue-500 hover:underline">Đồ chơi cho trẻ sơ sinh & trẻ nhỏ</a> &gt;
    <span>Đồ chơi thảm đàn Piano nằm phát nhạc Choice 9BB9 hình thú ngộ nghĩnh cho bé</span>
</nav>


<div class=" mx-auto bg-white  rounded-lg p-6">
    <!-- Product Images and Details -->
    <div class="grid grid-cols-5 gap-6">
        <!-- Images -->
        <div class="col-span-2">
            <img class="w-full h-full object-cover max-w-[550px] max-h-[550px] rounded-md" src="product-image.jpg" alt="Product Image">
            <div class="relative mt-4">
                <button class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-gray-300 rounded-full w-8 h-8 flex items-center justify-center">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
                <div class="grid grid-cols-5 gap-2">
                    <img class="w-full h-16 rounded-md cursor-pointer" src="product-thumbnail1.jpg" alt="Thumbnail">
                    <img class="w-full h-16 rounded-md cursor-pointer" src="product-thumbnail2.jpg" alt="Thumbnail">
                    <img class="w-full h-16 rounded-md cursor-pointer" src="product-thumbnail3.jpg" alt="Thumbnail">
                    <img class="w-full h-16 rounded-md cursor-pointer" src="product-thumbnail4.jpg" alt="Thumbnail">
                    <img class="w-full h-16 rounded-md cursor-pointer" src="product-thumbnail5.jpg" alt="Thumbnail">
                </div>
                <button class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-gray-300 rounded-full w-8 h-8 flex items-center justify-center">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            </div>
        </div>

        <!-- Product Details -->
        <div class="col-span-3">
            <h1 class="text-2xl mb-2"><?= Util::encodeHtml($product['product_name']) ?></h1>

            <!-- Đánh giá -->
            <div class="flex items-center justify-between text-gray-700 text-sm mb-4">
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-1">
                        <span class="text-lg font-semibold">4.8</span>
                        <div class="flex text-yellow-500">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>
                    </div>
                    <div>2k Đánh Giá</div>
                    <div>6,5k Sold</div>
                </div>
            </div>

            <div class="bg-gray-100 p-4 rounded-lg mb-4 flex items-center gap-4 w-full">
                <span id="price" class="text-2xl font-semibold text-red-500"></span>
                <span id="old-price" class="text-gray-500 line-through"></span>
                <span id="discount" class="bg-red-100 text-red-500 text-sm font-medium px-2 py-1 rounded"></span>
            </div>

            <div class="mt-4 grid grid-cols-12 gap-4 items-start">
                <!-- Combo Khuyến Mãi -->
                <div class="col-span-3 text-gray-600 font-medium">Combo Khuyến <br> Mãi</div>
                <div class="col-span-9">
                    <button class="text-red-500 border border-red-500 px-3 py-1 rounded-md hover:bg-red-100">
                        Mua 2 & giảm 5%
                    </button>
                </div>

                <!-- Vận Chuyển -->
                <div class="col-span-3 text-gray-600 font-medium">Vận Chuyển</div>
                <div class="col-span-9 flex items-center gap-2">
                    <i class="fa-solid fa-truck-fast text-green-600"></i>
                    <p class="text-gray-800">
                        Nhận hàng vào ngày mai, phí giao <span class="text-green-600 font-semibold">0₫</span>
                    </p>
                </div>

                <!-- An Tâm Mua Sắm -->
                <div class="col-span-3 text-gray-600 font-medium leading-6">An Tâm Mua<br>Sắm Cùng<br>Shopee</div>
                <div class="col-span-9 flex items-center gap-2">
                    <i class="fa-solid fa-location-pin text-red-600"></i>
                    <p class="text-gray-800">
                        Trả hàng miễn phí 15 ngày · <span class="hover:underline cursor-pointer">Bảo hiểm Thời trang</span>
                    </p>
                    <span class="text-gray-400 ml-2 cursor-pointer">▼</span>
                </div>

                <?php foreach ($attributes as $attributeId => $attribute): ?>
                    <div class="col-span-3 text-gray-600 font-medium"><?= $attribute['name'] ?></div>
                    <div class="col-span-9 flex flex-wrap gap-4">
                        <?php foreach ($attribute['values'] as $valueId => $value): ?>
                            <button
                                data-attribute-id="<?= $attributeId ?>"
                                data-value-id="<?= $valueId ?>"
                                class="attribute-option flex flex-col text-gray-800 items-center border px-4 py-2 rounded-md text-center hover:border-blue-500">
                                <?= $value ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>

                <script>
                    var productVariants = <?= json_encode($productVariant) ?>;

                    $(document).ready(function() {
                        showPriceProductDeatil(productVariants);
                    });
                </script>

                <!-- Số lượng -->
                <div class="col-span-3 text-gray-600 font-medium">Số lượng</div>
                <div class="col-span-6 flex items-center gap-2">
                    <div class="flex items-center border rounded-md">
                        <button class="w-10 h-10 flex items-center justify-center text-gray-500 hover:text-gray-800 border-r">
                            -
                        </button>
                        <input
                            type="text"
                            value="1"
                            class="w-12 h-10 text-center focus:outline-none text-gray-800"
                            readonly />
                        <button class="w-10 h-10 flex items-center justify-center text-gray-500 hover:text-gray-800 border-l">
                            +
                        </button>
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="mt-6 flex gap-4">
                <button class="flex items-center justify-center gap-2 border border-blue-500 text-gray-500 bg-blue-50 px-4 py-2 rounded hover:bg-blue-100 w-52">
                    <i class="fa-solid fa-cart-plus"></i>
                    <span class="text-sm">Thêm Vào Giỏ Hàng</span>
                </button>

                <button class="flex flex-col justify-center items-center bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 w-52">
                    <span class="text-sm">Mua Với Voucher</span>
                    <span class="text-lg font-bold">₫204.000</span>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="mt-10">
    <div class="text-center text-xl font-bold py-3 bg-gray-100 text-gray-800">Gợi ý cho bạn</div>
    <div class="grid grid-cols-12 gap-4 mt-4">

        <!-- Product Item -->
        <?php if (!empty($similarProducts)): ?>
            <?php foreach ($similarProducts as $product): ?>
                <div class="col-span-2">
                    <a href="<?= Redirect::product('detail')->withQuery(['id' => $product['id']])->getUrl() ?>" class="flex flex-col items-start p-4 border rounded-lg hover:shadow-md">
                        <img class="mb-3 w-full h-48 object-cover" src="<?= Asset::getProduct($product['image_path']) ?>" alt="<?= Util::encodeHtml($product['name']) ?>">
                        <span class="line-clamp-2 h-10 w-full font-bold leading-tight"><?= Util::encodeHtml($product['name']) ?></span>
                        <div class="flex items-center mt-2">
                            <?php
                            $rating = round($product['rating'] ?? 0);
                            for ($star = 1; $star <= 5; $star++):
                            ?>
                                <?php if ($star <= $rating): ?>
                                    <i class="fa-solid fa-star text-yellow-400"></i>
                                <?php else: ?>
                                    <i class="fa-regular fa-star text-gray-400"></i>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </div>
                        <div class="mt-2 flex items-center justify-between w-full">
                            <?php if ($product['promotion_price']): ?>
                                <span class="line-through text-sm text-gray-500"><?= Util::formatCurrency($product['price']) ?></span>
                                <span class="text-red-500 font-bold text-lg"><?= Util::formatCurrency($product['promotion_price']) ?></span>
                            <?php else: ?>
                                <span class="text-red-500 font-bold text-lg text-end w-full"><?= Util::formatCurrency($product['price']) ?></span>
                            <?php endif; ?>
                        </div>
                        <span class="text-sm w-full text-gray-600 text-end">Đã bán <?= Util::encodeHtml($product['sold_quantity']) ?? 0 ?></span>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>


        <!-- Thêm các sản phẩm khác tương tự -->
    </div>
    <div class="flex justify-center mt-5">
        <a href="#" class="px-5 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Xem thêm</a>
    </div>
</div>

<div class="p-4 bg-white rounded-md flex items-center justify-between mt-6 grid-cols-12">
    <!-- Thông tin cửa hàng -->
    <div class="flex items-center gap-4 grid-cols-4">
        <!-- Logo -->
        <img src="store-logo.jpg" alt="Store Logo" class="w-16 h-16 rounded-full object-cover">
        <!-- Chi tiết cửa hàng -->
        <div>
            <h2 class="text-lg font-semibold">MOOVER STORE</h2>
            <p class="text-sm text-gray-500">Online 9 Phút Trước</p>
            <div class="flex gap-2 mt-2">
                <!-- Nút Chat -->
                <button class="flex items-center gap-1 px-4 py-1 text-blue-500 border border-blue-500 rounded-md text-sm hover:bg-red-100">
                    <i class="fa-brands fa-rocketchat text-blue-600"></i>
                    Chat Ngay
                </button>
                <!-- Nút Xem Shop -->
                <button class="flex items-center gap-1 px-4 py-1 text-gray-500 border border-gray-300 rounded-md text-sm hover:bg-gray-100">
                    <i class="fa-solid fa-store text-blue-600"></i>
                    Xem Shop
                </button>
            </div>
        </div>

        <div class="grid grid-cols-9 gap-y-4 gap-x-4 text-sm text-gray-500">
            <!-- Hàng 1 -->
            <div class="flex justify-between items-center col-span-3 mr-12">
                <p>Đánh Giá</p>
                <p class="text-red-500 font-semibold">8,3k</p>
            </div>
            <div class="flex justify-between items-center col-span-3 mr-12">
                <p>Tỉ Lệ Phản Hồi</p>
                <p class="text-red-500 font-semibold">100%</p>
            </div>
            <div class="flex justify-between items-center col-span-3">
                <p>Tham Gia</p>
                <p class="text-red-500 font-semibold">5 năm trước</p>
            </div>
            <!-- Hàng 2 -->
            <div class="flex justify-between items-center col-span-3 mr-12">
                <p>Sản Phẩm</p>
                <p class="text-red-500 font-semibold">179</p>
            </div>
            <div class="flex justify-between items-center col-span-3 mr-12">
                <p>Thời Gian Phản Hồi</p>
                <p class="text-red-500 font-semibold ml-12">trong vài giờ</p>
            </div>
            <div class="flex justify-between items-center col-span-3">
                <p>Người Theo Dõi</p>
                <p class="text-red-500 font-semibold">38,7k</p>
            </div>
        </div>
    </div>
</div>

<!-- Chi tiết sản phẩm -->
<div class="mx-auto bg-white  rounded-lg p-6 mt-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold">CHI TIẾT SẢN PHẨM</h2>
    </div>

    <div class="mt-4 grid grid-cols-12 gap-4 items-start">
        <div class="col-span-3 text-gray-600 font-medium leading-6">Danh Mục</div>
        <div class="col-span-9 flex items-center gap-2">
            <nav class="text-sm text-gray-600 mb-4">
                <a href="#" class="text-blue-500 hover:underline">Shopee</a> &gt;
                <a href="#" class="text-blue-500 hover:underline">Mẹ & Bé</a> &gt;
                <a href="#" class="text-blue-500 hover:underline">Đồ chơi</a> &gt;
                <a href="#" class="text-blue-500 hover:underline">Đồ chơi cho trẻ sơ sinh & trẻ nhỏ</a>
            </nav>
        </div>
    </div>

    <div class="mt-4 grid grid-cols-12 gap-4 items-start">
        <div class="col-span-3 text-gray-600 font-medium leading-6">Kho</div>
        <div class="col-span-9 flex items-center gap-2">
            <p class="text-gray-800">
                33072
            </p>
        </div>
    </div>

    <div class="mt-4 grid grid-cols-12 gap-4 items-start">
        <div class="col-span-3 text-gray-600 font-medium leading-6">Xuất xứ</div>
        <div class="col-span-9 flex items-center gap-2">
            <p class="text-gray-800">
                Việt Nam
            </p>
        </div>
    </div>

    <div class="mt-4 grid grid-cols-12 gap-4 items-start">
        <div class="col-span-3 text-gray-600 font-medium leading-6">Tên tổ chức chịu trách nhiệm sản xuất</div>
        <div class="col-span-9 flex items-center gap-2">
            <p class="text-gray-800">
                BGHOUSE
            </p>
        </div>
    </div>

    <div class="mt-4 grid grid-cols-12 gap-4 items-start">
        <div class="col-span-3 text-gray-600 font-medium leading-6">Địa chỉ tổ chức chịu trách nhiệm sản xuất</div>
        <div class="col-span-9 flex items-center gap-2">
            <p class="text-gray-800">
                QUẬN 11, TPHCM
            </p>
        </div>
    </div>

    <div class="mt-4 grid grid-cols-12 gap-4 items-start">
        <div class="col-span-3 text-gray-600 font-medium leading-6">Gửi từ</div>
        <div class="col-span-9 flex items-center gap-2">
            <p class="text-gray-800">
                TP. Hồ Chí Minh
            </p>
        </div>
    </div>
</div>

<!-- Mô tả sản phẩm -->
<div class="mx-auto bg-white  rounded-lg p-6 mt-6">
    <h2 class="text-xl font-bold mb-4">MÔ TẢ SẢN PHẨM</h2>
    <div>
        <?= Util::nl2br($product['product_description']) ?>
    </div>
</div>

<!-- Đánh giá sản phẩm -->
<div class="mx-auto bg-white  rounded-lg p-6 mt-6">
    <!-- Header -->
    <h2 class="text-2xl font-bold mb-4">ĐÁNH GIÁ SẢN PHẨM</h2>

    <!-- Rating Overview -->
    <div class="grid grid-cols-6 gap-4 items-center border border-blue-500 text-gray-500 bg-blue-50 rounded-lg py-10">
        <div class="col-span-1 text-center">
            <p class="text-4xl font-bold text-red-500">4.8/5</p>
            <div class="flex justify-center mt-2">
                <span class="text-yellow-400 text-xl">★★★★★</span>
            </div>
        </div>
        <div class="col-span-5 flex flex-wrap gap-2">
            <button class="px-4 py-2 bg-red-100 text-red-500 rounded-md hover:bg-red-100">Tất Cả</button>
            <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-red-100">5 Sao (1,8k)</button>
            <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-red-100">4 Sao (104)</button>
            <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-red-100">3 Sao (62)</button>
            <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-red-100">2 Sao (21)</button>
            <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-red-100">1 Sao (26)</button>
            <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-red-100">Có Bình Luận (1,2k)</button>
        </div>
    </div>

    <!-- Review List -->
    <div class="mt-6 space-y-6">
        <!-- Single Review -->
        <div class="border-t pt-4">
            <div class="flex items-center space-x-4">
                <img src="https://via.placeholder.com/50" alt="User avatar" class="w-12 h-12 rounded-full">
                <div>
                    <p class="font-bold">nhungnguyen121017070919</p>
                    <div class="flex items-center text-yellow-400">★★★★★</div>
                    <p class="text-sm text-gray-500">2024-06-27 20:04 | Phân loại hàng: THẢM VOI XANH</p>
                </div>
            </div>
            <div class="mt-2 text-gray-700">
                <p>Sp ưng ý nhất sau khi đặt 4 đơn hàng 10đ cho shop</p>
            </div>
            <div class="mt-2 flex justify-start gap-2">
                <img src="https://via.placeholder.com/100" alt="Image 1" class="rounded-md size-40">
                <img src="https://via.placeholder.com/100" alt="Image 2" class="rounded-md size-40">

            </div>
            <div class="mt-2 text-sm text-gray-500">58 lượt thích</div>
        </div>

        <!-- Another Review -->
        <div class="border-t pt-4">
            <div class="flex items-center space-x-4">
                <img src="https://via.placeholder.com/50" alt="User avatar" class="w-12 h-12 rounded-full">
                <div>
                    <p class="font-bold">duongthuy140714</p>
                    <div class="flex items-center text-yellow-400">★★★★★</div>
                    <p class="text-sm text-gray-500">2024-07-05 10:35 | Phân loại hàng: THẢM VOI XANH</p>
                </div>
            </div>
            <div class="mt-2 text-gray-700">
                <p>Đóng gói cẩn thận. Mua Shopee Choice 3 món tính ra món này có 50k. Chưa mua pin lắp thử nên k biết phát nhạc ổn k.</p>
            </div>
            <div class="mt-2 flex justify-start gap-2">
                <img src="https://via.placeholder.com/100" alt="Image 1" class="rounded-md size-40">
                <img src="https://via.placeholder.com/100" alt="Image 2" class="rounded-md size-40">
            </div>
            <div class="mt-2 text-sm text-gray-500">18 lượt thích</div>
        </div>
    </div>
    <!-- Pagination -->
    <div class="mt-6 flex justify-center items-center space-x-2">
        <button class="px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">&lt;</button>
        <button class="px-3 py-1 bg-red-500 text-white rounded">1</button>
        <button class="px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">2</button>
        <button class="px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">3</button>
        <button class="px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">4</button>
        <button class="px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">5</button>
        <button class="px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">...</button>
        <button class="px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">&gt;</button>
    </div>
</div>