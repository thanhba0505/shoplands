<?php
define('BASE_PATH', dirname($_SERVER['SCRIPT_NAME']));
define('BASE_URL', rtrim((isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . BASE_PATH, '/'));

define('MAX_PRICE_PRODUCT', 100000000);
define('MAX_PRICE_ORDER', 100000000);
