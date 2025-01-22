<form action="<?= Redirect::to('api/seller/product/tab')->getUrl() ?>" method="post">
    <input type="text" name="page" value="all">
    <button type="submit">Load Tab</button>
</form>