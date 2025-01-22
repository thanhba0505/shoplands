<form action="<?= Redirect::to('api/seller/order/tab')->getUrl() ?>" method="post">
    <input type="text" name="page" value="order-all">
    <button type="submit">Load Tab</button>
</form>