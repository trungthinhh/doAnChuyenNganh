<?php

if (!defined('SERVER_ROOT')) {
    exit('No direct script access allowed');
}

// require_once (SERVER_ROOT . 'libs' . DS . 'php-i18n-master' . DS . 'i18n.class.php');

use Model\Entity;

class Controller {

    const SSO_ACTIVE_FLAG_ON = 1;

    public $block;
    public $view;
    public $model;
    public $form;
    public $app_name = '';
    public $module_name = '';
    public $func_called = 'main';
    private $request;
    private $filter;

    function __construct($app = '', $module = '', $checkQuyen = 0) {
        global $demo_NTH
        , $demo_MODEL
        , $demo_CONTROLLER
        , $demo_VIEW
        , $demo_BLOCK
        , $demo_TEMPLATE;

        $this->app_name = $app;
        $this->module_name = $module;

        $this->request = new \Zend\Http\PhpEnvironment\Request();
        //Load model

        $this->_load_model($app, $module);

        $v = $app . '_View';
        $this->view = (class_exists($v)) ? new $v($app, $module) : new View($app, $module); //tạo View cụ thể (View con) nếu có cài đặt (nó thừa kế từ View cha ở trong thư mục libs) ngược lại chỉ tạo View cha trong thư mục lib

        $this->model->view = $this->view;
        $this->view->model = $this->model;

        $this->model->app_name = $app;
        $this->model->module_name = $module;
        $this->model->controller = $this;

        // $this->getModel()->setRequest($this->request);
        // $this->getModel()->setFilter($this->filter);

        //Trien khai doi tuong libs cho view and controller
        // $this->view->libs = $this->model->libs;
        // $this->libs = $this->model->libs;

        //Assign object for all global variables
        $demo_VIEW = $this->view;
        $demo_TEMPLATE = $this->view->template;
        $demo_CONTROLLER = $this;
        $demo_MODEL = $this->model;
        // $demo_NTH = $this->model->libs;
        //Khoi tao doi tuong Block
        $demo_BLOCK = new objectBlock();
        $this->view->block = $demo_BLOCK;
        $this->view->template->block = $demo_BLOCK;
        $this->view->template->libs = $demo_NTH;
        $this->model->block = $demo_BLOCK;
        $this->block = $demo_BLOCK;
        $this->view->controller = $this;
        
    }

    public function isActiveUri($uri) {
        $arr = explode('/', trim($uri, ' /'));
        $app = isset($arr[0]) ? Bootstrap::cleanRouter($arr[0]) : NULL;
        $module = isset($arr[1]) ? Bootstrap::cleanRouter($arr[1]) : NULL;
        $method = isset($arr[2]) ? Bootstrap::cleanRouter($arr[2]) : NULL;
        $prerequisite = $this->app_name === $app && $this->module_name === $module;
        return is_null($method) ? $prerequisite : $prerequisite && $this->func_called === $method;
    }

    public function getRequest() {
        return $this->request;
    }

    public function setRequest($request) {
        $this->request = $request;
    }

    public function getFilter() {
        return $this->filter;
    }

    public function setFilter($filter) {
        $this->filter = $filter;
    }

    public function getView() {
        return $this->view;
    }

    public function getModel() {
        return $this->model;
    }

    public function setView($view) {
        $this->view = $view;
    }

    public function setModel($model) {
        $this->model = $model;
    }

    // public function getNth() {
    //     return $this->nth;
    // }

    public function getBlock() {
        return $this->block;
    }

    // public function setNth($nth) {
    //     $this->nth = $nth;
    // }

    public function setBlock($block) {
        $this->block = $block;
    }
    /*     * ********************************************Hệ thống***************************************************** */

    private function _load_model($app = '', $module = '') {
        $model = 'Model';
        if(strpos($app, '.') !== false || strpos($module, '.') !== false){
            $this->error(1);
            return false;
        }
        if (!empty($app) && !empty($module) && !in_array($app, array('block', 'model'))) {
            $path = 'apps' . DS . $app . DS . 'modules' . DS . $module . DS . $module . '_Model.php';
            if (file_exists($path)) {
                require_once $path;
                $model = $module . '_Model';
            } else {
                echo $path . '<br>';
                $this->error(1);
                return false;
            }
        }
        $this->model = new $model;
        // $this->model->db->debug = DEBUG_MODE;
        // $this->model->view = $this->view;
        // $this->view->model = $this->model;
    }

    public static function get_post_var($html_object_name, $defaul = '', $is_replace_bad_char = TRUE) {
        $var = isset($_POST[$html_object_name]) ? $_POST[$html_object_name] : $defaul;

        if ($is_replace_bad_char) {
            return replace_bad_char($var);
        }

        return $var;
    }

    public function error($error_code) {
        switch ($error_code) {
            case 1:
                die('Không thấy file Model!');
                break;
            case 2:
                die('xxx');
                break;
        }
    }

    public function access_denied() {
        die('Bạn không có quyền thực hiện chức năng này!');
    }

    public function setGoBackUrl($url) {
        $this->model->setGoBackUrl($url);
    }

    public function getGoBackUrl() {
        return $this->model->getGoBackUrl();
    }

    public function getControllerUrl($module = NULL, $app = NULL) {
        return $this->view->get_controller_url($module, $app);
    }

    public function redirectReturnUrl($url) {
        $urlReturn = parse_url($url);
        if ($urlReturn['query']) { 
            $newUrl = SITE_ROOT . $urlReturn['path'] . '?' . $urlReturn['query'];
        }else{
            $newUrl = SITE_ROOT . $urlReturn['path'];
        }
        $newUrl = preg_replace("#/{2,}#", "/", $newUrl);
        header("Location: " . $newUrl);
        exit;
    }

    public function addCSS($name, $attrs = array()) {
        Context::addCSS($name, $attrs);
    }

    public function addJS($name, $attrs = array()) {
        Context::addJS($name, $attrs);
    }

    public function prependStylesheet() {
        $context = Context::getContext();
        return call_user_func_array([$context, __FUNCTION__], func_get_args());
    }

    public function appendStylesheet() {
        $context = Context::getContext();
        return call_user_func_array([$context, __FUNCTION__], func_get_args());
    }

    public function prependJavascript() {
        $context = Context::getContext();
        return call_user_func_array([$context, __FUNCTION__], func_get_args());
    }

    public function appendJavascript() {
        $context = Context::getContext();
        return call_user_func_array([$context, __FUNCTION__], func_get_args());
    }
}

