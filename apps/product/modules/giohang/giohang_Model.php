<?php
if (!defined('SERVER_ROOT')) {
    exit('No direct script access allowed');
}
class giohang_Model extends Model {
    public function getDanhSachSanPham(){
        //if($_SESSION['TAI_KHOAN_KH']){
            $query = "select Hinh,MaG,tenSP,soluong,gia,Makh from ql_banhang.giohang order by MaG asc";
        //}
        //else{
        //     $query = "select gh.MaG,tenSP,m.TenMau,sz.TenSz,soluong,gia 
        //     from ql_banhang.giohang1 as gh,ql_banhang.mau as m,ql_banhang.size as sz 
        //     where m.MaMau=gh.mau and sz.MaSz=gh.size and gh.IPAddress='".$_SESSION['IPAddress']."'";
        // }
        return $this->qSelect($query);
    }
    public function getxoaSanpham($MaG){
        $query = "delete from ql_banhang.giohang where MaG = '".$MaG."'";
        var_dump($query);
        return $this->qDelete($query);
    }
    public function getCapNhatSanpham($MaG,$soluong){
        $query = "update ql_banhang.giohang set soluong=".$soluong." where MaG='".$MaG."'";
        //var_dump($query);
        return $this->qUpdate($query);
    }
}
// select MaSP,SLSP,TenSP from ql_banhang.sanpham where MaSP='1'