<?php

if (!defined('SERVER_ROOT')) {
    exit('No direct script access allowed');
}

class dangky_Controller extends Controller {

    public function __construct() { //ham cau truc, vd app la home/ke ben la module
        parent::__construct('product', 'dangky');
       
    }
    

    public function main() {//dau tien khi url goi home/index thi dau tien no se vo index
        $this->index();//khong bo qua nhieu xu ly vao ham main nay
    }
    public function index() {
        $viewData=[];
        $this->getView()->render('dangky', $viewData);//khai bao khi goi ham index thi se ra file giao dien nao len
    }
    public function SaveAccount(){
        $tenkh=get_post_var('tenkh');
        $username = get_post_var('username');
        $password = get_post_var('password');
        $phone = get_post_var('phone');
        $address = get_post_var('address');
        echo 'tenhk:'.$tenkh;    
        echo 'username:'.$username;
        echo 'pass:'.$password;
        echo 'phone:'.$phone;
        echo 'address:'.$address;
       $result = $this->model->getLuutaikhoan($tenkh,$username,$phone,$address,$password);
       if(!$result){
        alert("đăng ký không thành công");
        
       }
       else{
        alert("đăng ký thành công");
        
       }
    }
}
?>