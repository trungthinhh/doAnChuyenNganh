<?php
if (!defined('SERVER_ROOT')) {
    exit('No direct script access allowed');
}
class dangky_Model extends Model {
    public function getLuutaikhoan($tenkh,$username,$phone,$address,$password){
        $query = " insert into ql_banhang.KHACHHANG(tenkh,username,Matkhau,Diachi,Sodienthoai) 
        values ('".$tenkh."','".$username."','".$password."',N'".$address."','".$phone."')";
        return $this->qInsert($query);
    }
}
