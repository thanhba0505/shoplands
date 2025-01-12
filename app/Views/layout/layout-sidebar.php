<?php include './app/views/layout/header.php'; ?>

<main class="2xl:container mx-auto p-6">
    <!-- Main Section -->
    <section class="bg-white p-6 rounded-lg shadow-md col-span-3">
        <div class="grid grid-cols-6 gap-6">
            <!-- Sidebar -->
            <div class="col-span-1">
                <?php 
                if (isset($sidebar) && $sidebar=='products') {
                    include './app/views/Customer/products-sidebar.php'; 
                } else if (isset($sidebar) && $sidebar=='info') {
                    include './app/views/Customer/info-sidebar.php'; 
                } else  {
                    include './app/views/Seller/seller-sidebar.php'; 
                }
                
                ?>
            </div>

            <!-- Content -->
            <div class="<?= isset($sidebar) && $sidebar=='info' ? 'col-span-4' : 'col-span-5' ?>">
                <?= $content ?>
            </div>
        </div>
    </section>
</main>

<?php if (isset($footer) && $footer == true) {
    include './app/views/layout/footer.php';
}?>

<title><?= Util::encodeHtml($title) ?? 'Shopee' ?></title>