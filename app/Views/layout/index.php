<?= $header ?? '' ?>

<main class="2xl:container mx-auto p-6">
    <section class="bg-white p-6 rounded-lg shadow-md">
        <div class="grid grid-cols-6 gap-6">
            <?php if ($sidebar) : ?>
                <div class="col-span-1">
                    <?= $sidebar ?? '' ?>
                </div>

                <div class="col-span-5">
                    <?= $content ?? '' ?>
                </div>
            <?php else : ?>
                <div class="col-span-6">
                    <?= $content ?? '' ?>
                </div>
            <?php endif ?>
        </div>
    </section>
</main>

<?= $footer ?? '' ?>

<title><?= Util::encodeHtml($title) ?? 'Shopee' ?></title>