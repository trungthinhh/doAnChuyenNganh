<?php

if (!defined('SERVER_ROOT')) {
    exit('No direct script access allowed');
}
use Model\Entity\System\AccessLog;
use Model\Entity\System\Parameter;
class Bootstrap {

    /**
     * Bootstrap chỉ load file controler thôi còn các file khác(view, model) thì sẽ do controler load
     * $url[0] = $app(các ứng dụng: hethong, hoso)
     * $url[1] = $module(các module: tiepnhan, bangiao)
     * $url[2] = $function(tên các hàm: do_logout)
     * $url[3], $url[4], ... = $function_args(các tham số của hàm duoc truyen theo vi tri tuong ung)
     * file controller: có 4 biến:$view,$model,$app_name,$module_name
     */
    public $db;

    public function __construct() {       
        header('Content-Type: text/html;charset=utf-8');
        $url = $this->getUrlRequest();
        $app = $url['app'];
        $module = $url['module'];
        $function = $url['function'];
        $function_args = $url['function_args'];
        // $uri = nthRequest::getCurrentURI(true);
        if ($app == 'model') {
            $controller = new Controller($app, $module);
            $model = $controller->model->call($module);
            $model->setCaller('REQUEST_HEADER');
            if (is_callable([$model, $function])) {
                call_user_func_array(array($model, $function), $function_args);
            } else {
                $this->_error(1, $uri);
            }
        } elseif ($app == 'block') {
            $controller = new Controller($app, $module);
            $block = $controller->block->call($module);
            $block->setCaller('REQUEST_HEADER');
            if (is_callable([$block, $function])) {
                call_user_func_array(array($block, $function), $function_args);
            } else {
                $this->_error(1, $uri);
            }
        } else {
            $file = SERVER_ROOT . 'apps' . DS . $app . DS . 'modules' . DS . $module . DS . $module . '_Controller.php';
            if (file_exists($file)) {
                require $file;
                $controller_class = $module . '_Controller';
                $controller = new $controller_class($app, $module);
                if (is_callable([$controller, $function])) {
                    $controller->func_called = $function;
                    call_user_func_array(array($controller, $function), $function_args);
                } else {
                    $this->_error(1, $uri);
                }
            } else {
                $this->_error(2, $uri);
            }
        }
    }

    public static function cleanRouter($uri) {
        return nth::cleanSpecialChars(trim($uri));
    }

    public function getUrlRequest() {
        $request = new Zend\Http\PhpEnvironment\Request();
        $defaultApp = 'home';
        $defaultModule = 'index';//hien index dau tien se thanh home/index
        $defaultFunction = 'main';
        $link = str_replace(substr(SITE_ROOT,1, -1), '', $this->updateUrl($request->getQuery('url')));
        $link = ltrim($link, '/');
        $link = rtrim($link, '/');
        $url = $request->getQuery()->offsetExists('url') ? explode('/', $link) : [];
        $app = isset($url[0]) && !empty($url[0]) ? self::cleanRouter($url[0]) : $defaultApp;
        $module = isset($url[1]) ? self::cleanRouter($url[1]) : $defaultModule;
        $function = isset($url[2]) ? self::cleanRouter($url[2]) : 'main';
        
        if ($app === $defaultApp && $module === $defaultModule && $function === 'main' && $defaultFunction) {
            $function = $defaultFunction;
        }
        $function_args = array();
        if (count($url) > 3) {
            for ($i = 3; $i < count($url); $i++) {
                $function_args[] = Model::replace_bad_char(trim($url[$i]));
            }
        }
        return array(
            'app' => $app,
            'module' => $module,
            'function' => $function,
            'function_args' => $function_args
        );
    }

    private function _error($code, $url = '') {
        http_response_code(404); //page not found
        require_once 'libs/err404.php';
        exit;
        //exit(sprintf('[%s] Khong ton tai chuc nang %s', $code, $url));
    }

    public function updateUrl($url){
        $strpos = strpos($url, "?");
        if($strpos){
            return trim(substr($url, 0, strpos($url, "?")),'/');
        }else{
            return trim($url,'/');
        }
    }
    
}
