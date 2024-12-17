<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>

    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/reset.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/global.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/app.css">
</head>

<body>
    <div class="container">
        <?php View::make('layout/header'); ?>

        <?= $content ?>

        <?php View::make('layout/footer'); ?>
    </div>

    <script src="<?= BASE_URL ?>/public/js/app.js"></script>
</body>

</html>