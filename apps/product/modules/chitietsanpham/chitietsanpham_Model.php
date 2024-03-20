<?php
if (!defined('SERVER_ROOT')) {
    exit('No direct script access allowed');
}
class chitietsanpham_Model extends Model {
    public function getChiTietSanPham($msp){
        $query = "select MaSP,TenSP,img,GIA from ql_banhang.sanpham 
                where masp=".$msp;
        return $this->qSelect($query);
    }
   
    public function getLuusanpham($masp,$tenSP,$amount,$gia){
        $query = "insert into ql_banhang.GIOHANG(maSP,tenSP,soluong,gia) values ('".$masp."',N'".$tenSP."','".$amount."','".$gia."')";
        //var_dump($query);die();

        return $this->qInsert($query);
    }
    //cách kiểm tra lỗi
    //var_dump($query);die();
}