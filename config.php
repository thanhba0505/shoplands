<?php
define('BASE_PATH', dirname($_SERVER['SCRIPT_NAME']));
define('BASE_URL', rtrim((isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . BASE_PATH, '/'));

define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DATABASE', 'shopee');
define('CHARSET', 'utf8mb4');

define('SECRET_KEY', 'day_la_cai_key');

define('ACCESS_TOKEN_EXPIRY', 60 * 60);
define('REFRESH_TOKEN_EXPIRY', 60 * 60 * 24 * 30);
