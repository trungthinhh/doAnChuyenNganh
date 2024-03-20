<?php
if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}
if (!defined('SERVER_ROOT')) {
    define('SERVER_ROOT', __DIR__ . DS);
}
define('CONST_APPS_DIR', SERVER_ROOT . 'apps' . DS);
define('SITE_ROOT', '/');
define('SITE_ROOT_IMG', '/');
define('BLOCK_ROOT', SITE_ROOT . 'data/blocks/');
define('BLOCK_BACKEND_ROOT', BLOCK_ROOT . 'backend/');
define('BLOCK_FRONTEND_ROOT', BLOCK_ROOT . 'frontend/');
define('DANG_BAO_TRI', 0);
define('DEBUG_MODE', 1, true);
define('DATABASE_NAME_DECRYPT', 0);
define('ADODB_MESSAGE', 0);
define('SESSION_PREFIX', 'WebSession');

//Database
define('DATABASE_USER', 'root');
define('DATABASE_PASS', 'thinh1234');
define('DATABASE_NAME', 'ql_banhang');
define('SERVICE_NAME', 'localhost:3307');
define('DATABASE_TYPE', 'MYSQL'); // MSSQL or MYSQL