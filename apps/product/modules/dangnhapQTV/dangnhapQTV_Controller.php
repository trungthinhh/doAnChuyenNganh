<?php

if (!defined('SERVER_ROOT')) {
    exit('No direct script access allowed');
}

class dangnhapQTV_Controller extends Controller {

    public function __construct() { //ham cau truc, vd app la home/ke ben la module
        parent::__construct('product', 'dangnhapQTV');
       
    }
    
    public function main() {//dau tien khi url goi home/index thi dau tien no se vo index
        $this->index();//khong bo qua nhieu xu ly vao ham main nay
    }
    public function index() {
        $viewData=[];
        $this->getView()->render('dangnhapQTV', $viewData);
    }
    public function checkSeller(){
        $Gmail = get_post_var('Gmail');
        $MatKhau = get_post_var('MatKhau');
        $result = $this->model->getTaikhoan($Gmail,$MatKhau);
        if(!$result){
            echo 0;
            if($result){
                $_SESSION['Gmail']=$result;
            }
        }
        else{
            echo 1;
             $_SESSION['Gmail'] = $Gmail;
           
            // $tkDangnhap = $result[0];
           // $_SESSION['TAI_KHOAN_KH'] = $tkDangnhap['MaKH'];
            // $_SESSION['USER_NAME_KH'] = $tkDangnhap['username']; 
        //Session::set('TEN_KH', $tkDangnhap['username']);//nay de lai de tu chinh
        //SESSION_PREFIX neu khong co key nay cung duoc, em co the dat ten tuy y
        //cai nay giong cai e dang xem $_SESSION['dangnhap'] chang qua da duoc dieu chinh lai cho hop ly, de su dung
        //file session.php > day da dieu chinh lai

        }
    }
    
}
?>