<nav class="bg-blue-600 text-white py-4 sticky top-0 z-50">
    <div class="2xl:container mx-auto px-6">
        <div class="flex justify-start items-end">
            <div class="text-lg font-semibold">
                <a href="<?= Redirect::home()->getUrl() ?>" style="width: 120px">
                    <?= Other::logoSvg('fill-white', 120) ?>
                </a>
            </div>
            <div class="ml-4 pl-4 border-l border-white font-semibold text-2xl pb-px">
                <?= Util::encodeHtml($title_header) ?? '' ?>
            </div>
        </div>
    </div>
</nav>