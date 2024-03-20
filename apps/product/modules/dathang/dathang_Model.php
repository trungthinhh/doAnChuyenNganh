<?php
if (!defined('SERVER_ROOT')) {
    exit('No direct script access allowed');
}
class dathang_Model extends Model {
    public function getDatHang(){
      
            $query = "select tenSP, soluong, gia from ql_banhang.giohang;";
       
        return $this->qSelect($query);
    }
   
}