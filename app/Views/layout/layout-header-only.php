<?php include './app/views/layout/header-simple.php'; ?>

<main class="2xl:container mx-auto p-6">
    <!-- Main Section -->
    <section class="bg-white p-6 rounded-lg shadow-md col-span-3">
        <?= $content ?>
    </section>
</main>

<title><?= $title ?? 'Shopee' ?></title>