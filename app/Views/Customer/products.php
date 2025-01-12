<h1>Product</h1>

<a href="<?= Redirect::product('detail')->withQuery(['id' => '1'])->getUrl() ?>">Sản phẩm 1</a>
<a href="<?= Redirect::product('detail')->withQuery(['id' => '2'])->getUrl() ?>">Sản phẩm 2</a>
<a href="<?= Redirect::product('detail')->withQuery(['id' => '3'])->getUrl() ?>">Sản phẩm 3</a>