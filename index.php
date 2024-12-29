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

    <link rel="stylesheet" href="<?= Asset::url('css/root.css', true) ?>">
    <link rel="stylesheet" href="<?= Asset::url('css/global.css', true) ?>">
    <link rel="stylesheet" href="<?= Asset::url('css/app.css', true) ?>">
    <link rel="stylesheet" href="<?= Asset::url('css/bootstrap.css', true) ?>">
</head>

<body>
    <!-- // Xử lý request -->
    <?php $router->dispatch(); ?>

    <div id="notification" class="notification" hidden>
        <span id="notification-type"></span>
        <span id="notification-message"></span>
    </div>

    <script src="<?= Asset::url('js/app.js', true) ?>"></script>
    <?php Notification::show(); ?>
</body>

</html>