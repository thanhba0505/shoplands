<!-- Quản lý đơn hàng -->
<div x-data="accordionState('orderNavState', true)" class="transition-all duration-500" :class="isOpen ? 'pb-6' : 'pb-2'">
    <div class="flex justify-start gap-3 items-center pb-2 select-none cursor-pointer"
        @click="toggle()">
        <div class="text-lg font-semibold">Quản lý đơn hàng</div>
        <div>
            <i class="fa-solid fa-angle-right transition-all duration-500" :class="isOpen ? 'rotate-90' : ''"></i>
        </div>
    </div>
    <nav
        id="tab-order-sidebar"
        class="space-y-1 overflow-hidden transition-all duration-500"
        :class="isOpen ? 'max-h-screen' : 'max-h-0'">
        <?php $listOrderStatus = Other::listOrderStatus(); ?>
        <?php foreach ($listOrderStatus as $key => $label): ?>
            <div
                data-tab-order="<?= Util::encodeHtml($key) ?>"
                class="px-4 py-2 select-none cursor-pointer rounded-md linear duration-200 hover:bg-blue-400 hover:text-white">
                <?= Util::encodeHtml($label) ?>
            </div>
        <?php endforeach; ?>
    </nav>
</div>

<!-- Quản lý sản phẩm -->
<div x-data="accordionState('productNavState', true)" class="transition-all duration-500" :class="isOpen ? 'pb-6' : 'pb-2'">
    <div class="flex justify-start gap-3 items-center pb-2 select-none cursor-pointer"
        @click="toggle()">
        <div class="text-lg font-semibold">Quản lý sản phẩm</div>
        <div>
            <i class="fa-solid fa-angle-right transition-all duration-500" :class="isOpen ? 'rotate-90' : ''"></i>
        </div>
    </div>
    <nav
        id="tab-product-sidebar"
        class="space-y-1 overflow-hidden transition-all duration-500"
        :class="isOpen ? 'max-h-screen' : 'max-h-0'">
        <?php $listProductStatus = Other::listProductStatus(); ?>
        <?php foreach ($listProductStatus as $key => $label): ?>
            <div
                data-tab-product="<?= Util::encodeHtml($key) ?>"
                class="px-4 py-2 select-none cursor-pointer rounded-md linear duration-200 hover:bg-blue-400 hover:text-white">
                <?= Util::encodeHtml($label) ?>
            </div>
        <?php endforeach; ?>
    </nav>
</div>


<script>
    function accordionState(key, defaultState) {
        return {
            isOpen: JSON.parse(localStorage.getItem(key)) ?? defaultState, // Lấy trạng thái từ Local Storage hoặc sử dụng mặc định
            toggle() {
                this.isOpen = !this.isOpen; // Thay đổi trạng thái
                localStorage.setItem(key, JSON.stringify(this.isOpen)); // Lưu trạng thái vào Local Storage
            },
        };
    }

    $(document).ready(function() {
        loadTabAjax('<?= Redirect::to('api/seller/order/tab')->getUrl() ?>', {
            contentId: 'tab-content',
            dataName: 'tab-order',
            loadingId: 'loadingId',
            noContentId: 'noContentId',
            errorId: 'errorId',
            urlActive: '<?= Redirect::seller('order')->getUrl() ?>',
            tabContainers: [{
                selectorId: 'tab-order-sidebar',
                activeClass: 'bg-blue-400 font-semibold text-white'
            }, {
                selectorId: 'tab-order-content',
                activeClass: 'border-b-2 border-blue-500 font-semibold text-blue-500'
            }]
        });


        loadTabAjax('<?= Redirect::to('api/seller/product/tab')->getUrl() ?>', {
            contentId: 'tab-content',
            dataName: 'tab-product',
            loadingId: 'loadingId',
            noContentId: 'noContentId',
            errorId: 'errorId',
            urlActive: '<?= Redirect::seller('product')->getUrl() ?>',
            tabContainers: [{
                selectorId: 'tab-product-sidebar',
                activeClass: 'bg-blue-400 font-semibold text-white'
            }, {
                selectorId: 'tab-product-content',
                activeClass: 'border-b-2 border-blue-500 font-semibold text-blue-500'
            }]
        });
    });
</script>