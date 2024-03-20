<?php

if (!defined('SERVER_ROOT')) {
    exit('No direct script access allowed');
}

class View {

    public $nth;
    public $model;
    public $controller;
    public $block;
    public $msg;
    public $template;
    protected $xml_file_name;
    protected $app_name = '';
    protected $module_name = '';
    protected $xslt;
    protected $dom;
    protected $template_directory;
    protected $escaper;
    function __construct($app = '', $module = '') {
        $this->app_name = $app;
        $this->module_name = $module;
        $this->template_directory = SITE_ROOT . 'apps/';
        $this->image_directory = $this->template_directory . 'images/';

        //Khoi tao doi tuong template
        $this->template = new Savant3();
        $this->template->view = $this;
        $this->template->local_js = SITE_ROOT . 'apps/' . $app . '/modules/' . $module . '/' . $module . '_views/js_' . $module . '.js';
        $this->template->local_js_root = SERVER_ROOT . 'apps' . DS . $app . DS . 'modules' . DS . $module . DS . $module . '_views' . DS . 'js_' . $module . '.js';
        $this->template->controller_url = $this->get_controller_url();
        $this->template->function_url = $this->template->controller_url;
        $this->template->template_directory = 'apps/';
        $this->escaper = new Zend\Escaper\Escaper('utf-8');
        $this->csrf = new Zend\Validator\Csrf();
    }

    private function _render_error($code, $viewfile = '') {
        switch ($code) {
            case 1:
                //die('Lỗi view render, không tìm thấy file view ' . $viewfile);
				die('Lỗi view render, không tìm thấy file view!');
                break;
        }
    }

    public function check_permission($function_code) {
        $app_name = strtoupper($this->app_name);
        $function_code = $app_name . '::' . $function_code;
        return in_array($function_code, Session::get('arr_function_code'));
    }

    public function get_controller_url($module = NULL, $app = NULL) {
        if (is_null($app)) {
            $app = $this->app_name;
        }
        if (is_null($module)) {
            $module = $this->module_name;
        }
        $url = implode('/', array($app, $module, ''));
        return SITE_ROOT . $url;
    }

    public function get_active_class($app, $module = "index", $act = null, $class = "active") {
        return ($app == $this->app_name && $module == $this->module_name && (is_null($act) || $act === $this->controller->func_called)) ? $class : '';
    }

    public function render($name, $VIEW_DATA = array()) {
        $v_view_file = SERVER_ROOT . 'apps' . DS . $this->app_name . DS . 'modules' . DS . $this->module_name . DS . $this->module_name . '_views' . DS . $name . '.php';
        if (file_exists($v_view_file)) {
            if (is_array($VIEW_DATA)) {
                foreach ($VIEW_DATA as $key => $val) {
                    $$key = $val;
                }
            }
            require $v_view_file;
        } else {
            //$this->_render_error(1, $v_view_file);
            $this->err404();
        }
      
    }

    public static function hidden($name, $value = '') {
        if (strpos($value, '"') !== FALSE) {
            return '<input type="hidden" name="' . $name . '" id="' . $name . '" value=\'' . $value . '\' />';
        } else {
            return '<input type="hidden" name="' . $name . '" id="' . $name . '" value="' . $value . '" />';
        }
    }

    public static function add_empty_rows($pCurrentRow, $pTotalRow, $pTotalColumn) {
        if ($pCurrentRow >= $pTotalRow) {
            return '';
        }
        $html = '';
        for ($i = $pCurrentRow + 1; $i <= ($pTotalRow + 1); $i++) {
            $v_row_class = 'row' . ($i % 2);
            $html .= '<tr class="' . $v_row_class . '">';
            for ($j = 1; $j <= $pTotalColumn; $j++) {
                $html .= '<td>&nbsp;</td>';
            }
            $html .= '</tr>';
        }
        return $html;
    }
    public static function generate_select_option($arrData, $selected=NULL, $public_xml_file_name=''){
        $html = '';
        if ($public_xml_file_name !== '')
        {
            $f = SERVER_ROOT . 'public/xml/' . $public_xml_file_name;
            if (file_exists($f))
            {
                $xml = simplexml_load_file($f);
                $items = $xml->xpath("//item");
                foreach ($items as $item)
                {
                    $str_selected = ($item->attributes()->name == strval($selected)) ? ' selected':'';
                    $html .= '<option value="' . $item->attributes()->name . '"' . $str_selected . '>' . $item->attributes()->value . '</option>';
                }
            }
        }
        else
        {
            foreach ($arrData as $key => $val)
            {
                $str_selected = ($key == strval($selected)) ? ' selected':'';
                $html .= '<option value="' . $key .'"' .$str_selected.'>'. $val .'</option>';
            }
        }
    	return $html;
    }
    public static function paging($so_mau_tin, $reset = 0) {
        $html = '';
        $rows_per_page = isset($_POST['sel_rows_per_page']) ? replace_bad_char($_POST['sel_rows_per_page']) : Model\Entity\System\Parameter::fromId('_CONST_DEFAULT_ROWS_PER_PAGE')->getValue();
        if (isset($so_mau_tin)) {
            $page = isset($_POST['sel_goto_page']) ? replace_bad_char($_POST['sel_goto_page']) : 1;
            $total_record = $so_mau_tin;
        } else {
            $page = 1;
            $total_record = $rows_per_page;
        }
        if ($reset == 1) {
            $page = 1;
        }
        if ($total_record % $rows_per_page == 0) {
            $v_total_page = $total_record / $rows_per_page;
        } else {
            $v_total_page = intval($total_record / $rows_per_page) + 1;
        }
        $arr_page = array();
        for ($i = 1; $i <= $v_total_page; $i++) {
            $arr_page[$i] = __('page') . '&nbsp;' . $i;
        }
        if ($so_mau_tin == '') {
            $so_mau_tin = 0;
        }
        $html .= '<div class="pager" id="pager">';
        $html .= __('total') . '<span style="color: #FF0000;font-weight:bold;"> ' . $v_total_page . ' </span>' . __('page') . ' , <span style="color: #FF0000;font-weight:bold;">' . $so_mau_tin . '</span> bản ghi ';
        $html .= '. ' . __('go to') . '&nbsp;<select name="sel_goto_page" onchange="this.form.submit();" class="form-control">';
        $html .= self::generate_select_option($arr_page, $page);
        $html .= '</select>&nbsp;';
        $html .= __('display') . '&nbsp;<select name="sel_rows_per_page" onchange="this.form.sel_goto_page.value=1;this.form.submit();" class="form-control">';
        $html .= self::generate_select_option(null, $rows_per_page, 'xml_rows_per_page.xml');
        $html .= '</select> ' . __('record') . '/1 ' . __('page');
        $html .= '</div>';
        return $html;
    }
    
    //Phân trang đa ngôn ngữ
    public static function pagingEng($so_mau_tin, $reset = 0) {
        $html = '';
        $rows_per_page = isset($_POST['sel_rows_per_page']) ? replace_bad_char($_POST['sel_rows_per_page']) : Model\Entity\System\Parameter::fromId('_CONST_DEFAULT_ROWS_PER_PAGE')->getValue();
        if (isset($so_mau_tin)) {
            $page = isset($_POST['sel_goto_page']) ? replace_bad_char($_POST['sel_goto_page']) : 1;
            $total_record = $so_mau_tin;
        } else {
            $page = 1;
            $total_record = $rows_per_page;
        }
        if ($reset == 1) {
            $page = 1;
        }
        if ($total_record % $rows_per_page == 0) {
            $v_total_page = $total_record / $rows_per_page;
        } else {
            $v_total_page = intval($total_record / $rows_per_page) + 1;
        }
        $arr_page = array();
        for ($i = 1; $i <= $v_total_page; $i++) {
            $arr_page[$i] = 'Page&nbsp;' . $i;
        }
        if ($so_mau_tin == '') {
            $so_mau_tin = 0;
        }
        $html .= '<div class="pager" id="pager">';
        $html .= 'Total <span style="color: #FF0000;font-weight:bold;"> ' . $v_total_page . ' </span> Pages , <span style="color: #FF0000;font-weight:bold;">' . $so_mau_tin . '</span> records ';
        $html .= '. Move to&nbsp;<select name="sel_goto_page" onchange="this.form.submit();" class="form-control">';
        $html .= self::generate_select_option($arr_page, $page);
        $html .= '</select>&nbsp;';
        $html .= 'Display&nbsp;<select name="sel_rows_per_page" onchange="this.form.sel_goto_page.value=1;this.form.submit();" class="form-control">';
        $html .= self::generate_select_option(null, $rows_per_page, 'xml_rows_per_page.xml');
        $html .= '</select> Records/1 Page';
        $html .= '</div>';
        return $html;
    }
    
    public static function setName($phpExcel, $name) {
        $phpExcel->setActiveSheetIndex(0);
        ob_end_clean();
        ob_start();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . date('d_m') . '_' . $name . '.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($phpExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }

    public function loadjs($app, $module) {
        $jse = SERVER_ROOT . 'apps/' . $app . '/modules/' . $module . '/' . $module . '_views/js_' . $module . '.js';
        $js = SITE_ROOT . 'apps/' . $app . '/modules/' . $module . '/' . $module . '_views/js_' . $module . '.js';
        if (file_exists($jse)) {
            echo "<script src='" . $js . "' type='text/javascript'></script>";
        }
    }

    public function metro_header() {
        $head = SERVER_ROOT . 'libs' . DS . 'Metro' . DS . 'header.php';
        if (file_exists($head)) {
            include ($head);
        }
    }

    public static function save_pdf($name) {
        header("Content-Type: application/pdf");
        header("Cache-Control: max-age=0");
        header("Content-Disposition: attachment; filename='" . $name . "'");
    }
    
    public function escapeHtml($input){
        echo $this->escaper->escapeHtml($input);
    }
    
    public function err404(){
        require_once 'libs/err404.php';
        exit;
    }
}
