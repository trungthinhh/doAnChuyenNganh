<?php

$PHP_NTH;
$PHP_MODEL;
$PHP_CONTROLLER;
$PHP_VIEW;
$PHP_BLOCK;
$PHP_BLOCKS;
$PHP_JS;
$PHP_TEMPLATE;
$PHP_GET;
$PHP_VARS;
$PHP_JSLIB;
$PHP_CSSLIB;

class Context {

    protected static $instance;
    public $nth;
    public $model;
    public $controller;
    public $view;
    public $block;
    public $blocks;
    public $js;
    public $template;
    public $get;
    public $vars;
    public $configs;
    private $javascripts;
    private $stylesheets;

    function __construct() {
        global $PHP_NTH
        , $PHP_MODEL
        , $PHP_CONTROLLER
        , $PHP_VIEW
        , $PHP_BLOCK
        , $PHP_BLOCKS
        , $PHP_JS
        , $PHP_TEMPLATE
        , $PHP_GET
        , $PHP_VARS;
        $this->nth = $PHP_NTH;
        $this->model = $PHP_MODEL;
        $this->controller = $PHP_CONTROLLER;
        $this->view = $PHP_VIEW;
        $this->block = $PHP_BLOCK;
        $this->blocks = $PHP_BLOCKS;
        $this->js = $PHP_JS;
        $this->template = $PHP_TEMPLATE;
        $this->get = $PHP_GET;
        $this->vars = $PHP_VARS;
        $this->javascripts = [];
        $this->stylesheets = [];
        $this->configs = array(
            'body-class' => NULL
        );
    }

    public function set($key, $val = null) {
        if (is_array($key)) {
            foreach ($key as $name => $value) {
                $this->set($name, $value);
            }
        } elseif (is_null($key)) {
            $this->configs[] = $val;
        } else {
            $this->configs[$key] = $val;
        }
        return $this;
    }

    public function get($key, $def = null) {
        return isset($this->configs[$key]) ? $this->configs[$key] : $def;
    }

    public static function getContext() {
        global $PHP_NTH
        , $PHP_MODEL
        , $PHP_CONTROLLER
        , $PHP_VIEW
        , $PHP_BLOCK
        , $PHP_TEMPLATE;
        if (!isset(self::$instance)) {
            self::$instance = new Context();
        }
        if (is_object(self::$instance)) {
            self::$instance->nth = $PHP_NTH;
            self::$instance->model = $PHP_MODEL;
            self::$instance->controller = $PHP_CONTROLLER;
            self::$instance->view = $PHP_VIEW;
            self::$instance->block = $PHP_BLOCK;
            self::$instance->template = $PHP_TEMPLATE;
        }
        return self::$instance;
    }

    public function setVar($key, $val = null) {
        if (is_array($key)) {
            foreach ($key as $name => $value) {
                $this->setVar($name, $value);
            }
        } elseif (is_null($key)) {
            $this->vars[] = $val;
        } else {
            $this->vars[$key] = $val;
        }
    }

    public function getVar($key) {
        return $this->vars[$key];
    }

    public static function getBlockScript() {
        $blockScript = '';
        $globalBlocks = Context::getContext()->blocks;
        if (!empty($globalBlocks)) {
            foreach ($globalBlocks as $blockName => $block) {
                $files = $block->getBlockJs();
                if (!empty($files)) {
                    $temp = "";
                    $attrs = array_merge(array(
                        'type' => 'text/javascript'
                            ), (array) @$block->getConfig('script'));
                    foreach ($files as $view => $jsPath) {
                        $f = new nthFile($jsPath);
                        if ($f->fileExists() && $f->getSize()) {
                            $content = $f->getContent();
                            $temp .= "/*View: {$view}*/\n{$content}\n";
                        }
                    }
                    if (!empty($temp)) {
                        $blockScript .= "\n<!--Block: {$blockName}-->\n" . nthHtml::script($attrs, $temp);
                    }
                }
            }
        }
        return $blockScript;
    }

    public static function getBlockStyle() {
        $cssText = '';
        $globalBlocks = Context::getContext()->blocks;
        if (!empty($globalBlocks)) {
            foreach ($globalBlocks as $blockName => $block) {
                $files = $block->getBlockStyle();
                if (!empty($files)) {
                    foreach ($files as $view => $cssPath) {
                        $f = new nthFile($cssPath);
                        if ($f->fileExists() && $f->getSize()) {
                            $content = $f->getContent();
                            $cssText .= "/*{$blockName} - {$view}*/\n{$content}\n";
                        }
                    }
                }
            }
            $cssText = nth::translate($cssText);
            $cssText = nth::CSSText($cssText);
        }
        return $cssText;
    }

    public static function beginJS() {
        nth::ObStart();
    }

    public static function endJS() {
        self::appendCurrentScript(nth::ObGetClean());
    }

    public static function appendCurrentScript($script) {
        $html = '<html><head><meta charset="UTF-8"/></head><body>' . $script . '</body></html>';
        $dom = new DOMDocument();
        @$dom->loadHTML($html);
        $scriptElements = $dom->getElementsByTagName('script');
        if ($scriptElements->length > 0) {
            $scriptText = '';
            foreach ($scriptElements as $item) {
                $scriptText .= trim($item->textContent);
            }
            Context::getContext()->js[] = $scriptText;
        } else {
            Context::getContext()->js[] = $script;
        }
    }

    public static function getCurrentScript() {
        $script = '';
        $js = Context::getContext()->js;
        if (!empty($js)) {
            $script .= "/*JSCurrent*/\n";
            $script .= implode("\n", $js);
        }
        return nth::JSText($script) . "\n" . Context::getContext()->template->getLocalJS();
    }

    public static function addJSModel($model) {
        if (is_string($model)) {
            $model = explode(' ', $model);
        }
        if (is_array($model)) {
            foreach ($model as $m) {
                $path = 'public/js/models/model.' . $m . '.js';
                if (file_exists($path)) {
                    $f = new nthFile($path);
                    if ($f->getSize()) {
                        self::appendCurrentScript($f->getContent() . "\n");
                    }
                }
            }
        }
    }

    //Ham lay ra thu vien CSS
    public static function getCssLib() {
        global $PHP_CSSLIB;
        $config = include(dirname(__FILE__) . "/../data/config.php");
        if (empty($config['css'])) {
            return NULL;
        }
        $css = $config['css'];
        $html = '';
        if (!empty($PHP_CSSLIB)) {
            $v = '20201908113090';
            foreach ($PHP_CSSLIB as $name => $attrs) {
                if (!empty($css[$name])) {
                    $html .= nthHtml::link(array_merge(array(
                                "href" => SITE_ROOT . $css[$name] . "?v={$v}",
                                "rel" => "stylesheet",
                                "type" => "text/css",
                                            ), $attrs));
                }
            }
        }
        return $html;
    }

    //Ham lay ra thu vien JS
    public static function getJsLib() {
        global $PHP_JSLIB;
        $config = include(dirname(__FILE__) . "/../data/config.php");
        if (empty($config['js'])) {
            return NULL;
        }
        $js = $config['js'];
        $html = '';
        if (!empty($PHP_JSLIB)) {
            $v = '20201908113090';
            foreach ($PHP_JSLIB as $name => $attrs) {
                if (!empty($js[$name])) {
                    $html .= nthHtml::script(array_merge(array(
                                "src" => SITE_ROOT . $js[$name] . "?v={$v}",
                                "type" => "text/javascript",
                                            ), $attrs));
                }
            }
        }
        return $html;
    }

    public static function addCSS($name, $attrs = array()) {
        global $PHP_CSSLIB;
        if (is_array($name)) {
            foreach ($name as $n => $attr) {
                if (is_array($attr)) {
                    $attr = array_merge($attr, $attrs);
                    self::addCSS($n, $attr);
                } elseif (is_string($attr)) {
                    self::addCSS($attr, $attrs);
                }
            }
        } else {
            $PHP_CSSLIB[$name] = $attrs;
        }
    }

    public static function addJS($name, $attrs = array()) {
        global $PHP_JSLIB;
        if (is_array($name)) {
            foreach ($name as $n => $attr) {
                if (is_array($attr)) {
                    $attr = array_merge($attr, $attrs);
                    self::addJS($n, $attr);
                } elseif (is_string($attr)) {
                    self::addJS($attr, $attrs);
                }
            }
        } else {
            $PHP_JSLIB[$name] = $attrs;
        }
    }

    public static function actionResult($result, $message = NULL, $sessionKey = 'CURRENT_EDIT_MESSAGE') {
        $iconRule = array(
            'danger' => 'fa fa-ban',
            'success' => 'fa fa-check',
            'warning' => 'fa fa-warning',
            'info' => 'fa fa-info'
        );
        if (is_null($message)) {
            $message = $result ? 'Cập nhật thành công' : 'Cập nhật thất bại';
        }
        if (is_bool($result)) {
            $result = $result ? 'success' : 'danger';
        }
        if (!isset($iconRule[$result])) {
            trigger_error('Error class: <strong>Context</strong>, Error function: <strong>actionResult</strong>. The action type is invalid. The value must be in <strong>danger</strong>, <strong>success</strong>, <strong>warning</strong>, <strong>info</strong>.', E_USER_ERROR);
        }
        $html = '<div class="alert alert-' . $result . ' alert-dismissable">
            <i class="' . $iconRule[$result] . '"></i>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <b>' . $message . '</b>
        </div>';
        Session::set(TIEP_DAU_NGU_SESSION . $sessionKey, $html);
    }

    public static function actionMessage($sessionKey = 'CURRENT_EDIT_MESSAGE') {
        if (Session::_isset(TIEP_DAU_NGU_SESSION . $sessionKey)) {
            echo Session::get(TIEP_DAU_NGU_SESSION . $sessionKey);
            Session::_unset(TIEP_DAU_NGU_SESSION . $sessionKey);
        }
    }

    public function prependStylesheet($src, $options = []) {
        if (is_array($src)) {
            foreach ($src as $key => $value) {
                if (is_numeric($key)) {
                    $this->prependStylesheet($value);
                } else {
                    $this->prependStylesheet($key, $value);
                }
            }
        } else {
            array_unshift($this->stylesheets, array_merge(['href' => $src], $options));
        }
        return $this;
    }
    
    public function appendStylesheet($src, $options = []) {
        if (is_array($src)) {
            foreach ($src as $key => $value) {
                if (is_numeric($key)) {
                    $this->appendStylesheet($value);
                } else {
                    $this->appendStylesheet($key, $value);
                }
            }
        } else {
            array_push($this->stylesheets, array_merge(['href' => $src], $options));
        }
        return $this;
    }
    
    public function getEmbedStylesheet() {
        $v = '20201908113090';
        $html = '';
        foreach ($this->stylesheets as $options) {
            $href = SITE_ROOT_IMG. $options['href'] . '.css';
            if (empty($options['cache'])) {
                $href .= '?v=' . $v;
            }
            $link = new \libs\Html\Node('link', false, [
                'href' => $href,
                'rel' => 'stylesheet',
                'type' => 'text/css'
            ]);
            if (isset($options['attributes'])) {
                $link->mergeAttrs($options['attributes']);
            }
            if (isset($options['cond'])) {
                $html .= sprintf('<!--[%s]>%s<![endif]-->', $options['cond'], $link->toString());
            } else {
                $html .= $link->toString();
            }
        }
        return $html;
    }
    
    public function prependJavascript($src, $options = []) {
        if (is_array($src)) {
            foreach ($src as $key => $value) {
                if (is_numeric($key)) {
                    $this->prependJavascript($value);
                } else {
                    $this->prependJavascript($key, $value);
                }
            }
        } else {
            array_unshift($this->javascripts, array_merge(['src' => $src], $options));
        }
        return $this;
    }
    
    public function appendJavascript($src, $options = []) {
        if (is_array($src)) {
            foreach ($src as $key => $value) {
                if (is_numeric($key)) {
                    $this->appendJavascript($value);
                } else {
                    $this->appendJavascript($key, $value);
                }
            }
        } else {
            array_push($this->javascripts, array_merge(['src' => $src], $options));
        }
        return $this;
    }
    
    public function getEmbedJavascript() {
        $v = '20201908113090';
        $html = '';
        foreach ($this->javascripts as $options) {
            $src = SITE_ROOT_IMG . $options['src'] . '.js';
            if (empty($options['cache'])) {
                $src .= '?v=' . $v;
            }
            $script = new \libs\Html\Node('script', null, [
                'src' => $src,
                'language' => 'javascript',
                'type' => 'text/javascript'
            ]);
            if (isset($options['attributes'])) {
                $script->mergeAttrs($options['attributes']);
            }
            if (isset($options['cond'])) {
                $html .= sprintf('<!--[%s]>%s<![endif]-->', $options['cond'], $script->toString());
            } else {
                $html .= $script->toString();
            }
        }
        return $html;
    }
}

class baseObject {

    public $nth;
    public $model;
    public $controller;
    public $view;
    public $block;
    public $template;
    public $db;
    public $origin;

    function __construct() {
        $context = Context::getContext();
        $this->nth = $context->nth;
        $this->model = $context->model;
        $this->controller = $context->controller;
        $this->view = $context->view;
        $this->block = $context->block;
        $this->template = $context->template;
        $this->setCaller('USER_CALL');
        if (is_object($context->model) && is_object($context->model->db)) {
            $this->db = $context->model->db;
        }   
    }

    public function setCaller($origin) {//USER_CALL, REQUEST_HEADER
        $this->origin = $origin;
    }

    public function isRequestHeader() {
        return $this->origin == 'REQUEST_HEADER';
    }

    public function isUserCall() {
        return $this->origin == 'USER_CALL';
    }

    public function analyzeResult($result) {
        if ($this->isRequestHeader()) {
            echo $result;
        } else {
            return $result;
        }
    }

    public function getModel() {
        return $this->model;
    }

    public function getController() {
        return $this->controller;
    }

    public function getView() {
        return $this->view;
    }

    public function setModel($model) {
        $this->model = $model;
    }

    public function setController($controller) {
        $this->controller = $controller;
    }

    public function setView($view) {
        $this->view = $view;
    }

}

class packageObject {

    public function call($pck) {
        $pckClass = $pck . 'Package';
        $file = 'data/db/packages/' . $pck . '.php';
        try {
            include_once($file);
            $this->{$pck} = new $pckClass();
            $this->{$pck}->packageName = $pck;
            $this->{$pck}->packagePath = $file;
            return $this->{$pck};
        } catch (Exception $ex) {
            if (defined(DEBUG_MODE) && DEBUG_MODE == 1) {
                echo "Exception - Call Package {$pck} failed: ", $ex->getMessage(), "\n";
            }
            return false;
        }
    }

}

class package extends baseObject {
    
}

class objectModel extends baseObject {

    public function call($model) {
        $mcalled = $this->model->call($model);
        if (!$mcalled) {
            return false;
        }
        $this->{$model} = $mcalled;
        return $mcalled;
    }

}

class objectBlock extends baseObject {

    protected $config;
    protected $blockRoot;
    protected $blockName;
    protected $blockClass;
    protected $blockPath;
    protected $blockView = array();
    protected $blockJs = array();
    protected $blockStyle = array();
    protected $twig = null;
    protected $twigLoader;
            
    function __construct($blockName = NULL) {
        parent::__construct();
        if (!empty($blockName)) {
            $this->init($blockName);
            $this->globalBlock();
            $this->{$blockName} = $this->_get($blockName);
        }
    }

    public function init($blockName) {
        $this->setBlockName($blockName);
        $config = include('data/config.php');
        if (!isset($config['blocks'][$this->blockName])) {
            if (DEBUG_MODE == 1) {
                exit("Block <strong>" . $this->blockName . "</strong> is not declared!");
            }
            return false;
        }
        $this->setConfig($config['blocks'][$this->blockName]);
        $this->setBlockClass("block" . ucfirst($this->blockName));
        $this->setBlockRoot("data/blocks/" . $this->config["position"] . '/' . $this->blockName . '/');
        $this->setBlockPath($this->blockRoot . "main.php");
        $this->setBlockView("main");
        $this->setBlockStyle("style");
        $this->setBlockJs("script");
        include_once($this->blockPath);
    }

    public function setConfig($v) {
        $this->config = $v;
    }

    public function setBlockName($v) {
        $this->blockName = $v;
    }

    public function setBlockClass($v) {
        $this->blockClass = $v;
    }

    public function setBlockRoot($v) {
        $this->blockRoot = $v;
    }

    public function setBlockPath($v) {
        $this->blockPath = $v;
    }

    public function setBlockJs($v) {
        $this->blockJs[$v] = $this->blockRoot . "js/block.{$v}.js";
    }

    public function setBlockStyle($v) {
        $this->blockStyle[$v] = $this->blockRoot . "css/block.{$v}.css";
    }

    public function setBlockView($v,$twigTemplate = false) {
        if(!$twigTemplate){
            $this->blockView[$v] = $this->blockRoot . "views/block.{$v}.php";}
        else{
            $this->blockView[$v] = $this->blockRoot . "views/block.{$v}.twig";
        }
    }
    
    public function setTwig($twig) {
        $this->twig = $twig;
    }

    public function setTwigLoader($twigLoader) {
        $this->twigLoader = $twigLoader;
    }

    public function getConfig($opt = NULL) {
        return is_null($opt) ? $this->config : $this->config[$opt];
    }

    public function getBlockRoot() {
        return $this->blockRoot;
    }

    public function getBlockPath() {
        return $this->blockPath;
    }

    public function getBlockName() {
        return $this->blockName;
    }

    public function getBlockClass() {
        return $this->blockClass;
    }

    public function getBlockView($v = NULL) {
        return is_null($v) ? $this->blockView : $this->blockView[$v];
    }

    public function getBlockStyle($v = NULL) {
        return is_null($v) ? $this->blockStyle : $this->blockStyle[$v];
    }

    public function getBlockJs($v = NULL) {
        return is_null($v) ? $this->blockJs : $this->blockJs[$v];
    }
    
    public function getTwig() {
        return $this->twig;
    }

    public function getTwigLoader() {
        return $this->twigLoader;
    }

    public function isReady($blockName) {
        return isset(Context::getContext()->blocks[$blockName]);
    }

    public function exec($func = "main", $blockName = NULL, $args = NULL) {
        return $this->view($blockName, $func, $args);
    }

    public function _get($blockName) {
        return Context::getContext()->blocks[$blockName];
    }

    public function globalBlock($block = NULL) {
        Context::getContext()->blocks[$this->blockName] = is_object($block) ? $block : $this;
    }

    public function viewExists($viewName) {
        $this->setBlockView($viewName);
        return file_exists($this->getBlockView($viewName));
    }

    public function view($blockName = NULL, $func = "main", $args = NULL) {
        if (empty($blockName)) {
            $blockName = $this->blockName;
        }
        $func = preg_replace('/[-]+/', '', $func);
        $blockObj = $this->call($blockName);
        if (method_exists($blockObj, $func)) {
            $blockObj->{$func}($args);
        } elseif ($blockObj->viewExists($func)) {
            $blockObj->renderView($func, $args);
        }
    }

    public function renderPartal($data = NULL, $view = "main") {
        $this->renderView($data, $view, true);
    }
    
    public function call($blockName) {
        try {
            if (!$this->isReady($blockName)) {
                $this->init($blockName);
                $block = new $this->blockClass;
                $block->setConfig($this->config);
                $block->setBlockName($this->blockName);
                $block->setBlockClass($this->blockClass);
                $block->setBlockRoot($this->blockRoot);
                $block->setBlockPath($this->blockPath);
                $block->setTwig($this->twig);
                $block->setTwigLoader($this->twigLoader);
                $block->setBlockView("main");
                $block->setBlockStyle("style");
                $block->setBlockJs("script");
                $this->globalBlock($block);
            }
            $this->{$blockName} = $this->_get($blockName);
            return $this->{$blockName};
        } catch (Exception $ex) {
            if (DEBUG_MODE == 1) {
                echo "Exception: " . $ex->getMessage();
            }
        }
    }

    public function addLib($path) {
        $path = ltrim($path, '\\/');
        if (!preg_match('/.\.php$/', $path)) {
            $path .= '.php';
        }
        require_once($this->blockRoot . $path);
    }

    public function exists($name) {
        $config = include_once 'data/config.php';
        return isset($config['blocks'][$name]);
    }

}