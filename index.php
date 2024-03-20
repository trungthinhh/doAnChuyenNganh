<?php
// phpinfo();
// die();
//test connect database
    //    $servername = "localhost:3307";
    //     $username = "root";
    //     $password = "thinh1234";
        
    //     try {
    //       $conn = new PDO("mysql:host=$servername;dbname=QL_BANHANG", $username, $password);
    //       // set the PDO error mode to exception
    //       $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //       echo "Connected successfully";
    //     } catch(PDOException $e) {
    //       echo "Connection failed: " . $e->getMessage();
    //     }

    //     die();

ini_set('date.timezone','Asia/Ho_Chi_Minh');
require_once (__DIR__ . '/config.php');
// require_once(__DIR__. '/libs/dbconfig.php');
//library
require_once (SERVER_ROOT . 'libs' . DS . 'functions.php');

//MVC
require_once (SERVER_ROOT . 'libs' . DS . 'context.php');
require_once (SERVER_ROOT . 'libs' . DS . 'model.php');
require_once (SERVER_ROOT . 'libs' . DS . 'view.php');
require_once (SERVER_ROOT . 'libs' . DS . 'controller.php');
require_once (SERVER_ROOT . 'libs' . DS . 'bootstrap.php');
if ($LIB_DIR = getenv ('PHP_LIBRARIES')) {
    require_once ($LIB_DIR . DS . 'adodb5' . DS . 'adodb.inc.php');
    require_once ($LIB_DIR . DS . 'PEAR' . DS . 'PEAR.php');
    require_once ($LIB_DIR . DS . 'PEAR' . DS . 'Savant3.php');
    require_once ($LIB_DIR . DS . 'nth' . DS . 'nth.inc.php');
}
// Load Zend Framework
$zf2Path = false;
$libsPath = false;
if (getenv('ZF2_PATH')) {            // Support for ZF2_PATH environment variable 
    $zf2Path = getenv('ZF2_PATH');
} elseif (get_cfg_var('zf2_path')) { // Support for zf2_path directive value
    $zf2Path = get_cfg_var('zf2_path');
}

if (is_dir(SERVER_ROOT . '/libs')) {
    $libsPath = SERVER_ROOT . '/libs';
}

if ($zf2Path) {
    $namespaces = array(
        'Model' => __DIR__ . '/data/model'
    );
    if ($libsPath) {
        $namespaces['libs'] = $libsPath;
    }
    include $zf2Path . '/Zend/Loader/AutoloaderFactory.php';
    include $zf2Path . '/Zend/Loader/ClassMapAutoloader.php';
    Zend\Loader\AutoloaderFactory::factory(array(
        'Zend\Loader\StandardAutoloader' => array(
            'autoregister_zf' => true,
            'namespaces' => $namespaces
        )
    ));
}
if (!class_exists('Zend\Loader\AutoloaderFactory')) {
    throw new RuntimeException('Unable to load ZF2. Run `php composer.phar install` or define a ZF2_PATH environment variable.');
} 
//end load Zend Framework


ini_set('session.cookie_httponly ', true);
chdir(SERVER_ROOT);
//Start thêm cấu hình
define('DEBUG_MODE', 1);
//End thêm cấu hình
error_reporting(DEBUG_MODE > 0 ? E_ALL : 0);
//off phar stream
stream_wrapper_unregister('phar');

// Session::init();
$bootstrap = new Bootstrap();


   //get_client_ip() {//lấy ip từ máy
$ipaddress = '';
if (isset($_SERVER['HTTP_CLIENT_IP']))
    $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
    $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
else if(isset($_SERVER['HTTP_X_FORWARDED']))
    $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
    $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
else if(isset($_SERVER['HTTP_FORWARDED']))
    $ipaddress = $_SERVER['HTTP_FORWARDED'];
else if(isset($_SERVER['REMOTE_ADDR']))
    $ipaddress = $_SERVER['REMOTE_ADDR'];
else
    $ipaddress = 'UNKNOWN';

$_SESSION['IPAddress'] = $ipaddress;

