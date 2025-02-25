<div class="">
    Địa chỉ nhận hàng:
    <?php if (empty($addresses)): ?>
        Chưa có địa chỉ
    <?php else: ?>
        <?php foreach ($addresses as $address): ?>
            <?= Other::radio($address['a_province'] . ' - ' . $address['a_line'] , ['name' => 'address', 'value' => $address['a_id'], 'checked' => $address['a_default'] == 1]) ?>
          
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<div class="mt-6">
    Sản phẩm:


</div>

<div class="mt-6">
    Phương thức vận chuyển:

</div>

<div class="mt-6">
    Voucher

</div>

<div class="mt-6">
    Phương thức thanh toán:


</div>