<?php
if (!defined('SERVER_ROOT')) {
    exit('No direct script access allowed');
}
class dangnhapNguoiban_Model extends Model {
    public function getDanhSachSanPham(){
        // if($_SESSION['TAI_KHOAN_KH']){
            $query = "select gh.MaG,tenSP,m.TenMau,sz.TenSz,soluong,gia,Makh 
            from ql_banhang.giohang1 as gh,ql_banhang.mau as m,ql_banhang.size as sz 
            where m.MaMau=gh.mau and sz.MaSz=gh.size and gh.IPAddress='".$_SESSION['IPAddress']."' order by MaG asc";
        // }
        // else{
        //     $query = "select gh.MaG,tenSP,m.TenMau,sz.TenSz,soluong,gia 
        //     from ql_banhang.giohang1 as gh,ql_banhang.mau as m,ql_banhang.size as sz 
        //     where m.MaMau=gh.mau and sz.MaSz=gh.size and gh.IPAddress='".$_SESSION['IPAddress']."'";
        // }
        return $this->qSelect($query);
    }
    // public function Usermodel(){
    //     $query = "select gh.MaG,tenSP,m.TenMau,sz.TenSz,soluong,gia,Makh 
    //         from ql_banhang.giohang1 as gh,ql_banhang.mau as m,ql_banhang.size as sz 
    //         where m.MaMau=gh.mau and sz.MaSz=gh.size and gh.username='".$_SESSION['IPAddress']."' order by MaG asc";
    //     return $this->qSelect($query);
    // }
    public function getxoaSanpham($MaG){
        $query = "delete from ql_banhang.giohang1 where MaG = '".$MaG."'";
        //var_dump($query);
        return $this->qDelete($query);
        //$abc= $this->qDelete($query);
        //var_dump($abc);
        //die();
        
    }
    public function getCapnhatSP($MaG,$soluong){
        $query="update ql_banhang.giohang1 set soluong='".$soluong."' where MaG='".$MaG."'";
        var_dump($query);
        return $this->qUpdate($query);
    }
    // public function getSPGiohang($MaG){
    //     $query = "";
    //     //var_dump($query);
    //     return $this->qDelete($query);
    //     //$abc= $this->qDelete($query);
    //     //var_dump($abc);
    //     //die();
        
    // }
}