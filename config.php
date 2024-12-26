<?php
define('BASE_PATH', dirname($_SERVER['SCRIPT_NAME']));
define('BASE_URL', rtrim((isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . BASE_PATH, '/'));

define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DATABASE', 'shopee');
define('CHARSET', 'utf8mb4');

define('BCRYPT_COST', 12);