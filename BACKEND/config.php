<?php
define('BASE_PATH', dirname($_SERVER['SCRIPT_NAME']));
define('BASE_URL', rtrim((isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . BASE_PATH, '/'));

define('ACCESS_TOKEN_EXPIRY', 60 * 60 * 24);
define('REFRESH_TOKEN_EXPIRY', 60 * 60 * 24 * 30);
