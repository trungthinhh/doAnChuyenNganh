<?php
if (!defined('SERVER_ROOT')) {
    exit('No direct script access allowed');
}
class danhsach_Model extends Model {
    public function getDanhSachSanPham(){
        $query = "SELECT * FROM sanpham";
        return $this->qSelect($query);
    }

    public function getDanhSachSanPhamTheoGioiTinh($gender){
        $query = "SELECT * FROM sanpham where MADM = ".$gender;
        return $this->qSelect($query);
    }
    public function getDanhSachSanPhamTheoTenSP($tukhoa){
        $query = "select * from ql_banhang.sanpham where TenSP like '%".$tukhoa."%' order by MaSP asc"; 
        //echo $query; die();
        return $this->qSelect($query);
    }
}
