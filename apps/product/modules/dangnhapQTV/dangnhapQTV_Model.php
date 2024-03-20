<?php
if (!defined('SERVER_ROOT')) {
    exit('No direct script access allowed');
}
class dangnhapQTV_Model extends Model {
    public function getTaikhoan($Gmail,$MatKhau){
        $query = "select MaQTV, Gmail from ql_banhang.taikhoanQTV where Gmail='".$Gmail."' and MatKhau='".$MatKhau."'";
        return $this->qSelect($query);

    }
    
}
