<?php

if (!defined('SERVER_ROOT')) {
    exit('No direct script access allowed');
}

class dangnhap_Controller extends Controller {

    public function __construct() { //ham cau truc, vd app la home/ke ben la module
        parent::__construct('product', 'dangnhap');
       
    }
    

    public function main() {//dau tien khi url goi home/index thi dau tien no se vo index
        $this->index();//khong bo qua nhieu xu ly vao ham main nay
    }
    public function index() {
        $viewData=[];
        $this->getView()->render('dangnhap', $viewData);//khai bao khi goi ham index thi se ra file giao dien nao len
    }
    public function checkUser(){
        $username = get_post_var('username');
        $pass = get_post_var('pass');

        // echo 'username:'.$username;
        // echo 'pass:'.$pass;
        
       $result = $this->model->getTaikhoan($username,$pass);

       //$_SESSION['dangnhap']['username']=$username;
        //echo $_SESSION['dangnhap']['username'];
      
        if(!$result){
            echo 0;
        }
        else{
            //echo "Đã đăng nhập thành công";
            echo 1;
            $tkDangnhap = $result[0];
           // $_SESSION['TAI_KHOAN_KH'] = $tkDangnhap['MaKH'];
            $_SESSION['USER_NAME_KH'] = $tkDangnhap['username']; 
            
           //header("/product/giohang");
        //Session::set('TEN_KH', $tkDangnhap['username']);//nay de lai de tu chinh
        //SESSION_PREFIX neu khong co key nay cung duoc, em co the dat ten tuy y
        //cai nay giong cai e dang xem $_SESSION['dangnhap'] chang qua da duoc dieu chinh lai cho hop ly, de su dung
        //file session.php > day da dieu chinh lai

        }
    }
}
?>