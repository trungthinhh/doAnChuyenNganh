<?php

if (!defined('SERVER_ROOT')) {
    exit('No direct script access allowed');
}

use Model\Entity;
use Model\Entity\System as Sys;

class Model {

    public $block;
    public $db;
    public $view;
    public $db_sms;
    public $goback_url;
    public $goforward_url;
    public $maloaicongviec;
    public $ten_file;
    public $ul;
    public $random;
    public $maquyen;
    public $phpexcel;
    public $controller;
    private $message;
    private $request;
    private $filter;

    public function __construct() {
    }

    public function getController() {
        return $this->controller;
    }

    public function getBlock() {
        return $this->block;
    }

    public function setBlock($block) {
        $this->block = $block;
    }

    public function getRequest() {
        return $this->request;
    }

    public function getFilter() {
        return $this->filter;
    }

    public function setRequest($request) {
        $this->request = $request;
    }

    public function setFilter($filter) {
        $this->filter = $filter;
    }

    /*     * **********************************************Gui SMS************************************************* */

    public function vn_to_str($str){
        $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd'=>'đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i'=>'í|ì|ỉ|ĩ|ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D'=>'Đ',
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );
        foreach ($unicode as $nonUnicode => $uni) {
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        };
        return $str;
    }

    public function is_mysql() {
        return DATABASE_TYPE == 'MYSQL';
    }

    public function isJson($string) {
       json_decode($string);
       return json_last_error() === JSON_ERROR_NONE;
    }

    public static function replace_bad_char($str) {
        $str =   stripslashes($str);
        $str = str_replace("&",'&amp;', $str);
        $str = str_replace('<','&lt;', $str);
        $str = str_replace('>','&gt;',$str);
        $str = str_replace('"','&#34;', $str);
        $str = str_replace("'",'&#39;', $str);
        $str = str_replace("`",'&#96;', $str);
        $str = str_replace("..",'', $str);
        $str = str_replace("(",'&#40;', $str);
        $str = str_replace(")",'&#41;', $str);
        return $str;
    }

    public static function get_post_var($html_object_name, $is_replace_bad_char = TRUE) {
        $var = isset($_POST[$html_object_name]) ? $_POST[$html_object_name] : NULL;

        if ($is_replace_bad_char) {
            return Model::replace_bad_char($var);
        }

        return $var;
    }

    //Ham goi den model con
    public function call($modelName) {
        $modelClass = $modelName . 'Model';
        $file = 'data/models/' . $modelClass . '.php';
		if (!file_exists($file)) {
			$file = 'data/models/' . strtolower($modelName) . 'Model.php';
		}
        try {
            include_once($file);
            $modelInstance = new $modelClass();
            $this->{$modelName} = $modelInstance;
            return $modelInstance;
        } catch (Exception $ex) {
            if (defined(DEBUG_MODE) && DEBUG_MODE == 1) {
                echo "Exception - Call Model {$modelName} failed: ", $ex->getMessage(), "\n";
            }
            return false;
        }
    }

    public function get_site() {
        return ((!empty($_SERVER['HTTPS']) || $this->isHttps()) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
    }
    
    public function filterPath($path){
        $newPath = str_replace('..', '', $path);
        $newPath  = preg_replace('/[^A-Za-z0-9_.\s\/]/', '', $newPath);
        $fileAccept = ['doc', 'docx', 'xls', 'xlsx', 'pdf', 'csv', 'pps', 'ppsx', 'ppt', 'pptx', 'txt', 'jpg', 'jpeg', 'png', 'gif', 'dgn', 'dwg','zip','rar'];
        $filePath = strtolower($newPath);
        $ext = pathinfo($filePath, PATHINFO_EXTENSION);
        if(in_array($ext, $fileAccept)){
            return $newPath;
        }
        return null;
    }

    public function filterHtml($value){
        if(!$value) return $value;
        return $this->escapeJsEvent($this->removeScriptTag($value));
    }

    public function escapeJsEvent($value){
        return preg_replace('/(<.+?)(?<=\s)on[a-z]+\s*=\s*(?:([\'"])(?!\2).+?\2|(?:\S+?\(.*?\)(?=[\s>])))(.*?>)/i', "$1 $3", $value);        
    }

    public function removeScriptTag($text){
        $search = array("'<script[^>]*?>.*?</script>'si", "'<iframe[^>]*?>.*?</iframe>'si");
        $replace = array('','');
        $text = preg_replace($search, $replace, $text);
        return preg_replace_callback("'&#(\d+);'", function ($m) {
            return chr($m[1]);
          }, $text);
    }

    public function removeAttrHtml($html){
        if(empty($html))
            return null;
        $doc = new DOMDocument('1.0', 'UTF-8');
        $doc->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
        foreach ($doc->getElementsByTagname('*') as $element) 
        {
            foreach (iterator_to_array($element->attributes) as $name => $attribute)
            {
                $element->removeAttribute($name);
            }
        }
        return $doc->saveHTML($doc->documentElement);
    }

    // database mysql connection
    public function qSelect($strQuery){
        try {
            $conn = new PDO("mysql:host=".SERVICE_NAME.";dbname=".DATABASE_NAME."", DATABASE_USER, DATABASE_PASS);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare($strQuery);
            $stmt->execute();
          
            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt->fetchAll();
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
        $conn = null;
    }

    public function qInsert($strQuery, $getLastId=false){//insert 1 dữ liệu cùng lúc thì $strQuery lưu dạng String
        try {
            $conn = new PDO("mysql:host=".SERVICE_NAME.";dbname=".DATABASE_NAME."", DATABASE_USER, DATABASE_PASS);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->beginTransaction();
            $stmt = $conn->prepare($strQuery);
            $result = $stmt->execute();
            if($getLastId){
                $conn->commit();
                return $conn->lastInsertId();
            }
            // commit the transaction
            $conn->commit();
            return 1;//true
        } catch(PDOException $e) {
            $conn->rollback();
            echo "Error: " . $e->getMessage();
            return 0;//false
        }
        $conn = null;
    }

    public function qInsertRows($strQuery, $getLastId=false){
        //insert nhiều dữ liệu cùng lúc thì $strQuery lưu dạng Array, 
        //if getLastId == true then return danh sách các Id đã insert dạng Array
        //ngược lại if getLastId == false chỉ trả về 1 (true), 0 (false)
        try {
            $arrId = [];
            $conn = new PDO("mysql:host=".SERVICE_NAME.";dbname=".DATABASE_NAME."", DATABASE_USER, DATABASE_PASS);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            foreach ($strQuery as $str){
                $stmt->exec($str);
                if($getLastId){
                    array_push($arrId, $conn->lastInsertId());
                }
            }
            // commit the transaction
            $conn->commit();
            if($getLastId) return $arrId;
            else return 1;
        } catch(PDOException $e) {
            $conn->rollback();
            echo "Error: " . $e->getMessage();
            if($getLastId) return [];
            return 0;
        }
        $conn = null;
    }

    public function qDelete($strQuery){
        try {
            $conn = new PDO("mysql:host=".SERVICE_NAME.";dbname=".DATABASE_NAME."", DATABASE_USER, DATABASE_PASS);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->beginTransaction();
            $stmt = $conn->prepare($strQuery);
            $result = $stmt->execute();
            // commit the transaction
            $conn->commit();
            return 1;
        } catch(PDOException $e) {
            $conn->rollback();
            echo "Error: " . $e->getMessage();
            return 0;
        }
        $conn = null;
    }

    public function qUpdate($strQuery){
        //return bao nhiêu dữ liệu đã được cập nhật
        try {
            $conn = new PDO("mysql:host=".SERVICE_NAME.";dbname=".DATABASE_NAME."", DATABASE_USER, DATABASE_PASS);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->beginTransaction();
            $stmt = $conn->prepare($strQuery);
            $result = $stmt->execute();
            // commit the transaction
            $conn->commit();
            // return $update->rowCount();
            return 1;
        } catch(PDOException $e) {
            $conn->rollback();
            echo "Error: " . $e->getMessage();
            return 0;
        }
        $conn = null;
    }

    public function qSelectLimit($strQuery, $limit, $offset=1){
        //return only 10 records, start on record 16 (OFFSET 15)
        //SELECT * FROM Orders LIMIT 10 OFFSET 15
        try {
            $conn = new PDO("mysql:host=".SERVICE_NAME.";dbname=".DATABASE_NAME."", DATABASE_USER, DATABASE_PASS);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare($strQuery.' LIMIT '.$limit.' OFFSET '.$offset);
            $stmt->execute();
          
            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt->fetchAll();
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
        $conn = null;
    }

}
