<?php
if (!defined('SERVER_ROOT')) {
    exit('No direct script access allowed');
}
class dangnhap_Model extends Model {
    public function getTaikhoan($username,$pass){
        $query = "select MaKH, username from ql_banhang.khachhang where username='".$username."' and Matkhau='".$pass."'";
        //echo $query;die();
        return $this->qSelect($query);

    }
}
