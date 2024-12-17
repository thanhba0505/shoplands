<?php

// Nạp các tệp cần thiết
require_once './config.php';
require_once './core/Session.php';
require_once './core/Router.php';
require_once './core/View.php';

// Autoload các middleware
spl_autoload_register(function ($class) {
    $middlewarePath = './app/Middlewares/' . $class . '.php';
    if (file_exists($middlewarePath)) {
        require_once $middlewarePath;
    }
});

// Tạo router và nạp route
$router = new Router();
require_once './routes/web.php';
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Default Title' ?></title>

    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/global.css?v=<?= rand() ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/app.css?v=<?= rand() ?>">
</head>

<body>
    <!-- // Xử lý request -->
    <?php $router->dispatch(); ?>

    <script src="<?= BASE_URL ?>/public/js/app.js"></script>
</body>

</html>