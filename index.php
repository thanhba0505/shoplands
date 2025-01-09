<?php

// Nạp các tệp cần thiết
require_once './config.php';
require_once './core/Session.php';
require_once './core/Cookie.php';
require_once './core/Router.php';
require_once './core/View.php';
require_once './core/Token.php';
require_once './core/Request.php';
require_once './core/CSRF.php';
require_once './core/Redirect.php';
require_once './core/Asset.php';
require_once './core/Notification.php';
require_once './core/Console.php';

// Tạo session bảo mật
Session::init();

// Tạo cookie bảo mật
Cookie::init();

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

//Tạo token csrf
if (!CSRF::getToken()) {
    CSRF::generateToken();
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="<?= Asset::url('css/output.css', true) ?>">
    <link rel="stylesheet" href="<?= Asset::url('css/global.css', true) ?>">

    <script src="<?= Asset::url('js/alpine.min.js', true) ?>" defer></script>
</head>

<body class="bg-gray-100" style="min-width: 1200px; width: 100%; overflow-x: hidden">

    <!-- // Xử lý request -->
    <?php $router->dispatch(); ?>


    <!-- Thông báo -->
    <div id="notification" class="fixed <?= Session::get('notification.type') === 'error' ? 'bg-red-400' : 'bg-blue-400' ?> text-white max-w-72 bottom-8 right-8 px-4 py-3 rounded-lg shadow-lg border opacity-0 transition-all linear duration-300">

        <span class="" id="notification-message"><?= Session::get('notification.message') ?></span>
    </div>

    <script src="<?= Asset::url('js/app.js', true) ?>"></script>
    <?php Notification::show(); ?>
    <title><?= $title ?? 'Shopee' ?></title>
</body>

</html>