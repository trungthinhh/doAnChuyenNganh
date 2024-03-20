<?php
function vn_str_filter ($str){
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
      foreach($unicode as $nonUnicode=>$uni){
           $str = preg_replace("/($uni)/i", $nonUnicode, $str);
      }
       return $str;
   }
    function sms_str_filter($str, $contractID){
      $arr = explode(',',Model\Entity\System\Parameter::fromId('DS_BRANDNAME_SMS_CO_DAU')->getValue());
      foreach ($arr as $key => $value) {
        if($contractID == $value){
          return $str;
        }
      }
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
      foreach($unicode as $nonUnicode=>$uni){
           $str = preg_replace("/($uni)/i", $nonUnicode, $str);
      }
       return $str;
   }   
function replace_bad_char($str)
{
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
}//end func replace_bad_char
function arr_nam(){
		return array(2014=>'2014',2015=>'2015',2016=>'2016', 2017=>'2017');
		}
function arr_thang(){
		return array(1=>'01',2=>'02',3=>'03',4=>'04',5=>'05',6=>'06',7=>'07',8=>'08',9=>'09',10=>'10',11=>'11',12=>'12');
		}
function create_single_xml_node($name, $value, $cdata=FALSE)
{
    $node =  '<' .  $name . '>';
    $node .=  ($cdata) ? '<![CDATA[' . $value . ']]>' : $value;
    $node .=  '</' .  $name . '>';

    return $node;
} //end func create_single_xml_node

function hidden($name, $value='')
{
    if (strpos($value, '"') !== FALSE)
    {
        return '<input type="hidden" name="' . $name . '" id="' . $name . '" value=\'' . $value . '\' />';
    }
    else
    {
        return '<input type="hidden" name="' . $name . '" id="' . $name . '" value="' . $value . '" />';
    }
}

function page_calc(&$v_start, &$v_end, $reset=0, $per_page=0)
{
    //Luu dieu kien loc
    if($reset==1){
      $v_rows_per_page = isset($_POST['sel_rows_per_page']) ? replace_bad_char($_POST['sel_rows_per_page']) : Model\Entity\System\Parameter::fromId('_CONST_DEFAULT_ROWS_PER_PAGE')->getValue();
      $v_start = 1;
      $v_end = $v_rows_per_page;
    }else{
      $v_page = isset($_POST['sel_goto_page']) ? replace_bad_char($_POST['sel_goto_page']) : 1;
      if ($per_page == 1) {
          $v_rows_per_page = isset($_POST['sel_rows_per_page']) ? replace_bad_char($_POST['sel_rows_per_page']) : Model\Entity\System\Parameter::fromId('_CONST_DEFAULT_ROWS_PER_PAGE_BCA')->getValue();
      }
      else {
          $v_rows_per_page = isset($_POST['sel_rows_per_page']) ? replace_bad_char($_POST['sel_rows_per_page']) : Model\Entity\System\Parameter::fromId('_CONST_DEFAULT_ROWS_PER_PAGE')->getValue();
      }
      $v_start = $v_rows_per_page * ($v_page - 1) + 1;
      $v_end = $v_start + $v_rows_per_page - 1;
    }



}

function is_id_number($id)
{
    return (preg_match( '/^\d*$/', trim($id)) == 1);
}

function get_post_var($html_object_name, $default_value='', $is_replace_bad_char=TRUE)
{
    $var = isset($_POST[$html_object_name]) ? $_POST[$html_object_name] : $default_value;

    if ($is_replace_bad_char && !is_array($var))
    {
        return replace_bad_char ($var);
    }

    return $var;
}

function get_request_var($html_object_name, $default_value='', $is_replace_bad_char=TRUE)
{
    $var = isset($_REQUEST[$html_object_name]) ? $_REQUEST[$html_object_name] : $default_value;

    if ($is_replace_bad_char)
    {
        return replace_bad_char ($var);
    }

    return $var;
}
function get_post_request($html_object_name,$flat=0){
	$var=$flat==0 ? get_post_var($html_object_name) : get_request_var($html_object_name);
	return $var;
	}
function get_filter_condition($arr_html_object_name=array())
{
    $arr_filter = array();
    foreach ($arr_html_object_name as $v_html_object_name)
    {
        $arr_filter[$v_html_object_name] = get_request_var($v_html_object_name);
    }

    return $arr_filter;
}

function get_role($task_code)
{
    return trim(preg_replace('/[A-Z0-9_]*[:]+/', '', $task_code));
}

function xml_remove_declaration($xml_string)
{
    return trim(preg_replace('/\<\?xml(.*)\?\>/','', $xml_string));
}

function xml_add_declaration($xml_string, $utf8_encoding=TRUE)
{
    $xml_string = xml_remove_declaration($xml_string);

    if ($utf8_encoding)
    {
        return '<?xml version="1.0" encoding="UTF-8"?>' . $xml_string;
    }

    return '<?xml version="1.0" standalone="yes"?>' . $xml_string;
}

function get_xml_value($dom, $xpath)
{
    $r = $dom->xpath($xpath);
    if (isset($r[0]))
    {
        return strval($r[0]);
    }

    return NULL;
}

/**
 * Tính số ngày chênh lệch giữa 2 ngày
 * @param string $begin_date Ngay bat dau, dang in yyyy-mm-dd
 * @param string $end_date Ngay ket thuc, dang yyyy-mm-dd
 * @return Int
 */
function days_diff($begin_date_yyyymmdd, $end_date_yyyymmdd)
{
    $b = date_create($begin_date_yyyymmdd);
    $e = date_create($end_date_yyyymmdd);

    $interval = date_diff($b, $e);
    return intval($interval->format('%R%a'));
}

function is_past_date($date_yyyymmdd)
{
    $today = Date('Y-m-d');
    return days_diff($date_yyyymmdd, $today) > 0;
}
function is_future_date($date_yyyymmdd)
{
    $today = Date('Y-m-d');
    return days_diff($date_yyyymmdd, $today) < 0;
}

function check_permission($function_code, $app_code)
{
    @Session::init();
    $function_code = strtoupper($app_code . '::' . $function_code);
    return in_array($function_code, Session::get('arr_function_code'));
}
/**
 * Lay gia tri cho boi dau hieu mau
 *
 * @param string $html_content Xau can lay
 * @param string dau hieu bat dau $bp
 * @param string dau hieu ket thuc $ep
 * @return string xau thu duoc
 */
function get_value_by_pattern($html_content,$bp,$ep){
	preg_match("/$bp(.+)$ep/eUim",$html_content,$arr_matches);
	if (count($arr_matches) >= 1){
		return ($arr_matches[1]);
	}
	else{
		return '';
	}
}
/**
 * Xoa het cac ky tu dieu khien trong doan html text
 *
 * 		o Dau xuong dong
 * 		o Dong moi
 * 		o Cac dau cach thua
 *
 * @param string $text Xau ky tu vao
 * @return string Xau thu duoc sau khi da xoa het ky tu dieu khien
 * @author Ngo Duc Lien
 */
function delete_control_characters($text)
{
	$ret_text = preg_replace (
       array (
               '/\s+/u'      // Any space(s)
               ,'/^\s+/u'      // Any space(s) at the beginning
               ,'/\s+$/u'      // Any space(s) at the end
               ,'/\n+/u'      // Any New line(s)
               ,'/\r+/u'      // Any Rn(s)

       ),
       array (
               ' '    // ... one space
               ,''    // ... nothing
               ,''     // ... nothing
               ,''     // ... nothing
               ,''     // ... nothing
       ),
       $text);
       return $ret_text;
}

function parse_boolean($str)
{
    if ($str == '') {
        return FALSE;
    }
    switch (strtolower($str)) {
        case 'true':
        case '1':
        case 'yes':
        case 'y':
            return TRUE;
    }

    return FALSE;
}
function toStrictBoolean ($_val, $_trueValues = array('yes', 'y', 'true'), $_forceLowercase = true)
{
    if (is_string($_val)) {
        return (in_array(
                        ($_forceLowercase?strtolower($_val):$_val)
                        , $_trueValues)
        );
    } else {
        return (boolean) $_val;
    }
}

/**
 * This function is write data to xml file
 * @param xml string
 * @param xml path
 * return 0(successfully) 1(unformat xml) 2(fail)
 */
function write_xml_file($v_xml_string, $v_xml_file_path)
{
	$xml = '<<<XML'.$v_xml_string.'XML';
    if(simplexml_load_string($xml))
		return 1;
		    
    $v_dir = dirname($v_xml_file_path);
	if (!is_dir($v_dir))
		@mkdir($v_dir);
		
	if(!file_put_contents($v_xml_file_path, $v_xml_string))
		return 2;
    
    return 0;
}
function writeXML($xml, $file)
{
	$res = write_xml_file($xml, $file);
	if($res===1)
	{
		$msg = 'Unformat XML string';
	}
	elseif($res===2)
	{
		$msg = 'Unable to write to XML file';
	}
	if($msg != '')
	{
		echo '<script type="text/javascript">alert("'.$msg.'");<\/script>';
		return false;
	}
	return true;
}
function getElementHtml($tag, $attributes, $content = false) {
    $code = '<' . $tag;
    foreach ($attributes as $attribute => $value) {
        $code .= ' ' . $attribute . '="' . htmlentities(stripslashes($value), ENT_COMPAT) . '"';
    }

    if ($content === false || $content === null) {
        $code .= ' />';
    } else {
        $code .= '>' . $content . '</' . $tag . '>';
    }

    return $code;
}
function getOptionGroup($options, $currentValue) {
    $content = '';
    foreach ($options as $optionKey => $optionValue) {
        if (is_array($optionValue)) {
            $content .= '<optgroup label="' . $optionKey . '">' . getOptionGroup($optionValue, $currentValue) . '</optgroup>';
        } else {
            $optionAttributes = array();
            if ($currentValue == $optionKey) {
                $optionAttributes['selected'] = 'selected';
            }
            $content .= getOptionHtml($optionKey, $optionValue, $optionAttributes);
        }
    }

    return $content;
}
function getOptionHtml($value, $content, $attributes = array()) {
    $defaultAttributes = array(
        'value' => $value
    );

    $finalAttributes = array_merge($defaultAttributes, $attributes);

    return getElementHtml('option', $finalAttributes, $content);
}
function getSelectHtml($name, $currentValue, $options, $attributes = array()) {
    $defaultAttributes = array(
        'id' => $name,
        'name' => $name
    );
    $finalAttributes = array_merge($defaultAttributes, $attributes);
    $content = getOptionGroup($options, $currentValue);

    return getElementHtml('select', $finalAttributes, $content);
}
function alert($string){
	echo "<script>alert(".$string.")</script>";
}

if (!function_exists('show_paginate')) {
    /**
     * Tao ra môt doan phan trang
     *
     * @param array $data : mảng truyền vào để kiểm tra phân trang
     * @param array $append : các tham số đầu vào trên url
     * @return string
     * @throws Exception
     */
    function show_paginate($data = array (), $append = array ())
    {
        $lastPage    = $data['lastPage'];
        $currentPage = $data['currentPage'];
        $adjacents   = 2;
        $next        = $currentPage + 1;
        $previous    = $currentPage - 1;

        $pagination = '';
        if ($lastPage > 6) {
            $pagination .= "<ul class='pagination'>";
            if ($currentPage > 1) {
                $pagination .= "<li class=''><a class='page-link current' title='Về trang đầu' href='" . append_url($append,
                        ['page' => 1]) . "'>&lt;&lt;</a></li>";
                $pagination .= "<li class=''><a class='page-link' href='" . append_url($append,
                        ['page' => $previous]) . "'>&lt;</a></li>";
            }
            if ($lastPage <= 3 + ($adjacents * 2)) { // thiếu trường hợp =
                for ($counter = 1; $counter <= $lastPage; $counter++) {
                    $pagination .= ($counter == $currentPage)
                        ? "<li class='active '><a class='page-link'>$counter</a></li>"
                        : "<li class=''><a class='page-link' href='" . append_url($append,
                            ['page' => $counter]) . "'>$counter</a></li>";
                }
            } elseif ($lastPage > 3 + ($adjacents * 2)) {
                // trường hợp dành cho việc phân trang lúc đầu nhỏ hơn 5
                if ($currentPage < 1 + ($adjacents * 2)) {
                    for ($counter = 1; $counter < 2 + ($adjacents * 2); $counter++) {
                        $pagination .= ($counter == $currentPage)
                            ? "<li class='active '><a class='page-link'>$counter</a></li>"
                            : "<li class=''><a class='page-link' href='" . append_url($append,
                                ['page' => $counter]) . "'>$counter</a></li>";
                    }
                } //trường hợp dành cho page cuối cùng -4 lớn hơn page đang click
                elseif ($lastPage - ($adjacents * 2) > $currentPage && $currentPage > ($adjacents * 2)) {

                    for ($counter = $currentPage - $adjacents; $counter <= $currentPage + $adjacents; $counter++) {
                        $pagination .= ($counter == $currentPage)
                            ? "<li class='active '><a class='page-link'>$counter</a></li>"
                            : "<li class=''><a class='page-link' href='" . append_url($append,
                                ['page' => $counter]) . "'>$counter</a></li>";
                    }
                } // trường hợp click vào các page cuối cùng
                else {
                    for ($counter = $lastPage - (2 + ($adjacents * 2)); $counter <= $lastPage; $counter++) {
                        $pagination .= ($counter == $currentPage)
                            ? "<li class='active '><a class='page-link'>$counter</a></li>"
                            : "<li class=''><a class='page-link' href='" . append_url($append, ['page' => $counter]) . "'>$counter</a></li>";
                    }
                }
            }
            if ($currentPage < $lastPage - 2) {
                $pagination .= "<li class=''><a class='page-link' title='>' href='" . append_url($append, ['page' => $next]) . "'>&gt;</a></li>";
                $pagination .= "<li class=''><a class='page-link' title='>>' href='" . append_url($append, ['page' => $lastPage]) . "'>&gt;&gt;</a></li>";
            }
            $pagination .= "</ul>";
        } elseif ($lastPage > 1) {
            $pagination .= "<ul class='pagination'>";
            for ($counter = 1; $counter <= $lastPage; $counter++) {
                $pagination .= ($counter == $currentPage)
                    ? "<li class='active '><a class='page-link'>$counter</a></li>"
                    : "<li class=''><a class='page-link' href='" . append_url($append, ['page' => $counter]) . "'>$counter</a></li>";
            }
        } else {
            $pagination = '';
        }

        return $pagination;
    }
}

if (!function_exists('append_url')) {
    function append_url($append = array (), $page = array ())
    {
        $r           = null;
        $urlUri      = getQueryUri();
        $dataUrl     = explode('?', $urlUri);
        $redirectUrl = $dataUrl[0] && $dataUrl[0] != '/' ? $dataUrl[0] : '';
        $urlQuerry   = isset($dataUrl[1]) ? $dataUrl[1] : '';
        parse_str($urlQuerry, $data);

        // check mảng append link để xuất ra link
        $appendLink = array ();

        $append = $page ? array_merge($append, $page) : $append;

        foreach ($append as $ka => $va) {
            if (preg_match('/^\d+$/', $ka)) {
                throw new Exception('Giá trị ' . $va . ' gán link có key= ' . $ka . ' phải là một chuoi');
            }
            if (is_array($va)) {
                foreach ($va as $va1) {
                    $appendLink[urlencode($ka . '[]')] = urlencode($ka . '[]') . '=' . urlencode($va1);
                }
            } elseif ($va) {
                $appendLink[urlencode($ka)] = urlencode($ka) . '=' . urlencode($va);
            }
        }

        // check mang param query để thay đổi nếu có k
        if ($data) {
            foreach ($data as $k => $value) {
                if ($appendLink) {
                    foreach ($appendLink as $ka => $va) {
                        //nếu trùng key thì đổi value
                        if ($k == $ka) {
                            $r[$k] = $appendLink[$ka];
                        } // khác key thì thêm value
                        else {
                            $r[$ka] = $appendLink[$ka];
                        }
                    }
                }
            }
        }
        $r = $r ? $r : $appendLink;
        return $redirectUrl . '?' . implode('&', $r);
    }
}

if (!function_exists('getQueryUri')) {
    /**
     * Tra ve cac tham so query tren url
     *
     * @return string
     */
    function getQueryUri()
    {
        return $_SERVER['REQUEST_URI'];
    }
}

if (!function_exists('getThamSoArray')) {
    /**
     * Hienctt it kv1
     * Chuyển tham số array 2 chiều về dạng 1 chiều
     *
     * @return array
     */
    function getThamSoArray($tham_so_goc)
    {
        $result = [];
        if(is_array($tham_so_goc)) {
            foreach ($tham_so_goc as $arr) {
                foreach ($arr as $key => $value) {
                    $result[$key] = $value;
                }
            }
        }

        return $result;
    }
}

if (!function_exists('convertThamSoArray')) {
    /**
     * Hienctt it kv1
     * Chuyển tham số array 2 chiều về dạng 1 chiều
     *
     * @return array
     */
    function convertThamSoArray($tham_so_goc, $d = ',')
    {
        $result = [];
        if(is_string($tham_so_goc) && $tham_so_goc) {
            $result = explode($d, $tham_so_goc);
        }

        return $result;
    }
}

if (!function_exists('convertTextHTML')) {
    /**
     * Hienctt it kv1
     * convert các kí tự đặc biệt
     *
     * @return array
     */

     function convertTextHTML($str) {
        $str =   stripslashes($str);
        $str = str_replace("&amp;",'&', $str);
        $str = str_replace('&lt;','<', $str);
        $str = str_replace('&gt;','>',$str);
        $str = str_replace('&#34;','"', $str);
        $str = str_replace("&#39;","'", $str);
        $str = str_replace("&#40;",'(', $str);
        $str = str_replace("&#41;",')', $str);

        return $str;
    }
}

if (!function_exists('removePrefixKeyArray')) {
    /**
     * Lấy mảng với tiền tố key
     * @param $my_array
     * @param string $prefix
     * @return array
     */

     function removePrefixKeyArray($my_array, $prefix) {
         $new_array = [];
         foreach ($my_array ?: [] as $key => $item) {
             if (substr($key, 0, strlen($prefix)) == $prefix) {
                 $key_new = substr($key, strlen($prefix));
                 $new_array[$key_new] = $item;
             }
         }
        return $new_array;
    }

    if (!function_exists('convertStringThemDuoiNamHienTaiHNI')) {
        /**
         * convert string thêm định dạng năm vào cuối chuỗi - Hà nội
         */
        function convertStringThemDuoiNamHienTaiHNI($value) {
            $result = '';
            if(!empty($value)) {
                if (strpos($value, '/') !== false) { // nếu có chứa /
                    $result = explode('/', $value);

                    $end = end($result);
                    if($end) {
                        if (DateTime::createFromFormat('Y', $end) !== false) {
                            //TH3 : Sau dấu gạch là định dạng year nhưng khác năm hiện tại -> giữ nguyên
                            // TH4 : Sau dấu gạch là định dạng year = năm hiện tại giữ nguyên
                            $result = $value;
                        } else {
                            // TH2: Sau dấu gạch k phải định dạng year -> + /date('Y')
                            $result = $value.'/'.date('Y');
                        }
                    } else {
                        // TH1 : sau dấu gạch rỗng -> + date('Y')
                        $result = $value.date('Y');
                    }
                } else {
                    $result = $value.'/'.date('Y');
                }
            }

            return $result;
        }
    }
}

if (!function_exists('convertDateToText')) {
    function convertDateToText($dateObject) {
        $day = $dateObject->format('d');
        $month = $dateObject->format('m');
        $year = $dateObject->format('Y');
//        $hours = $dateObject->format('h');
//        $minute = $dateObject->format('i');
//        $second = $dateObject->format('s');

        $dayArr = ["mồng một", "mồng hai", "mồng ba", "mồng bốn", "mồng năm", "mồng sáu", "mồng bảy", "mồng tám", "mồng chín", "mồng mười",
            "mười một", "mười hai", "mười ba", "mười bốn", "mười lăm", "mười sáu", "mười bảy", "mười tám", "mười chín",
            "hai mươi", "hai mươi mốt", "hai mươi hai", "hai mươi ba", "hai mươi tư", "hai mươi năm", "hai mươi sáu", "hai mươi bảy", "hai mươi tám", "hai mươi chín",
            "ba mươi", "ba mươi mốt"];

        $monthArr = ["một", "hai", "ba", "bốn", "năm", "sáu", "bảy", "tám", "chín", "mười", "mười một", "mười hai"];
        
        $day = $dayArr[$day-1];
        $month = $monthArr[$month-1];

        $date = "ngày " . $day . ", tháng " . $month . ", năm " . convertYearToText($year);
        return $date;

    }
}

if (!function_exists('convertYearToText')) {
    function convertYearToText($year){
        //Từ 0 đến 9999
        if ($year < 0 || $year > 9999) return 'Không xác định';
        $dg = ['không', 'một', 'hai', 'ba', 'bốn', 'năm', 'sáu', 'bảy', 'tám', 'chín'];

        if ($year < 10) {
            return $dg[$year];
        }

        $stringYear = '';
        $nThousand = ($year - $year % 1000) / 1000;

        $hundred = ($year - $nThousand * 1000);
        $hundred = ($hundred - $hundred % 100) / 100;
        $dozen = $year - $nThousand * 1000 - $hundred * 100;
        $dozen = ($dozen - $dozen % 10) / 10;
        $unit = $year - $nThousand * 1000 - $hundred * 100 - $dozen * 10;
        if ($nThousand > 0) $stringYear = $dg[$nThousand] . ' nghìn ';

        if ($hundred > 0 || ($nThousand > 0 && ($nThousand != 0 || $unit != 0))) $stringYear = $stringYear . $dg[$hundred] . ' trăm ';
        if ($dozen == 1) {
            $stringYear = $stringYear . 'mười ';
        } else if ($dozen == 0) {
            $stringYear = $stringYear . ($unit == 0 ? '' : 'linh ');
        } else {
            $stringYear = $stringYear . $dg[$dozen] . ' mươi ';
        }
        if ($unit > 0) {
            if ($unit == 1 && $dozen > 1) {
                $unitStr = 'mốt';
            } else if ($unit == 4 && $dozen != 1) {
                $unitStr = 'tư';
            } else if ($unit == 5 && $dozen != 0) {
                $unitStr = 'lăm';
            } else {
                $unitStr = $dg[$unit];
            }
            $stringYear = $stringYear . $unitStr;
        }
        return $stringYear;
    }
}

if (!function_exists('getRootDomain')) {
    function getRootDomain() {
        $rootDomain = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . SITE_ROOT;
        return $rootDomain;
    }
}
function page_calc_update(&$v_start, &$v_end, &$v_row)
{
      $v_page = isset($_POST['sel_goto_page']) ? replace_bad_char($_POST['sel_goto_page']) : 1;
      $v_rows_per_page = isset($_POST['sel_rows_per_page']) ? replace_bad_char($_POST['sel_rows_per_page']) : Model\Entity\System\Parameter::fromId('_CONST_DEFAULT_ROWS_PER_PAGE')->getValue();
      $v_start = $v_rows_per_page * ($v_page - 1) + 1;
      $v_end = $v_start + $v_rows_per_page - 1;
      $v_row =  $v_rows_per_page * ($v_page - 1);
}

if (!function_exists('json_validate')) {
    function json_validate($string) {
        $result = json_decode($string, true);

        // khong phai json thi tra lai string
        if (!is_array($result)) {
            return htmlspecialchars($string, ENT_QUOTES);
        }
        // tra ra mang
        return $result;
    }
}

if (!function_exists('check_mimetype_is_img')) {
    function check_mimetype_is_img($extension) {
        $mimetypes = [
            'png'  => 'image/png',
            'jpeg' => 'image/jpeg',
            'jpg'  => 'image/jpeg'
        ];
        $ext = strtolower($extension);
        return in_array($ext, $mimetypes);
    }
}

if (!function_exists('encrypt_sha512')) {
    function encrypt_sha512($sid) {
        $secretKey = Model\Entity\System\Parameter::fromId('BCA_SECRET_ENTITY_SID')->getValue();
        $hashed  = hash_hmac("sha512", $sid, $secretKey);
        return $hashed;
    }
}

if (!function_exists('decrypt_sha512')) {
    function decrypt_sha512($sid, $hashString) {
        $secretKey = Model\Entity\System\Parameter::fromId('BCA_SECRET_ENTITY_SID')->getValue();
        $hashed  = hash_hmac("sha512", $sid, $secretKey);
        return ($hashString === $hashed);
    }
}

if (!function_exists('json_decode_filter')) {
    function json_decode_filter($string, $returnArr = false) {
        $result = json_decode($string, true);
        $resultFilter = array();
        if (is_array($result)) {
            foreach ($result as $rkey => $value){
                if(is_array($value)){
                    $tmp = json_encode($value);
                    $resultFilter[replace_bad_char($rkey)] = json_decode_filter($tmp, $returnArr);
                }else{
                    $resultFilter[replace_bad_char($rkey)] = replace_bad_char($value);
                }
            }
        }
        if($returnArr){
            return $resultFilter; // tra ra mang
        }else{
            return (object)$resultFilter;
        }  
    }
}

if (!function_exists('generateNumericOTP')) {
    function generateNumericOTP($n = 6) {
        $generator = "1357902468";
        $result = "";
        for ($i = 1; $i <= $n; $i++) {
            $result .= substr($generator, (rand()%(strlen($generator))), 1);
        }
        return $result;
    }
}

if (!function_exists('encryptAES')) {
    function encryptAES($data){
        error_reporting(0);
        $encryptKey = \Model\Entity\System\Parameter::fromId('KEY_ENCRYPT_AES')->getValue();
        $blockCipher = \Zend\Crypt\BlockCipher::factory('mcrypt', array('algo' => 'aes'));
        $blockCipher->setKey($encryptKey);
        $result = $blockCipher->encrypt($data);
        return $result;
    }
}

if (!function_exists('decryptAES')) {
    function decryptAES($data){
        error_reporting(0);
        $encryptKey = Model\Entity\System\Parameter::fromId('KEY_ENCRYPT_AES')->getValue();
        $blockCipher = \Zend\Crypt\BlockCipher::factory('mcrypt', array('algo' => 'aes'));
        $blockCipher->setKey($encryptKey);
        $result = $blockCipher->decrypt($data);
        return $result;
    }
}
