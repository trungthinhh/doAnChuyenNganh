<?php
if (!defined('SERVER_ROOT')) {
    exit('No direct script access allowed');
}

class index_Model extends Model {

    public function getDanhSachSanPham(){
        $query = "SELECT * FROM sanpham";
        return $this->qSelect($query);
    }
    // public function getDsSearch(){
    //     $query = "SELECT * FROM ql_banhang.sanpham where TenSP like '%$products%'";
    //     return $this->qSelect($query);
    // }

}
