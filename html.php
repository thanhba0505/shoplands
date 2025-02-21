<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="<?= Asset::url('css/output.css', true) ?>">
    <link rel="stylesheet" href="<?= Asset::url('css/butterup.min.css', true) ?>">
    <link rel="stylesheet" href="<?= Asset::url('css/global.css', true) ?>">

    <script src="<?= Asset::url('js/jquery.min.js', true) ?>"></script>
</head>

<body class="bg-gray-100" style="min-width: 1200px; width: 100%; overflow-x: hidden">

    <!-- // Xử lý request -->
    <?= $response ?? '' ?>
    <!-- <?= Session::get('notification.type') === 'error' ? 'bg-red-400' : 'bg-blue-400' ?> -->
    <!-- Thông báo -->
    <?php Notification::show() ?>

    <script src="<?= Asset::url('js/alpine.min.js', true) ?>"></script>
    <script src="<?= Asset::url('js/butterup.min.js', true) ?>"></script>
    <script src="<?= Asset::url('js/app.js', true) ?>"></script>
    <title><?= $title ?? 'Shopee' ?></title>
</body>

</html>