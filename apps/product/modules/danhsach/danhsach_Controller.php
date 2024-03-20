<?php

if (!defined('SERVER_ROOT')) {
    exit('No direct script access allowed');
}

class danhsach_Controller extends Controller {

    public function __construct() { //ham cau truc, vd app la home/ke ben la module
        parent::__construct('product', 'danhsach');
       
    }
    

    public function main() {//dau tien khi url goi home/index thi dau tien no se vo index
        $this->index();//khong bo qua nhieu xu ly vao ham main nay
    }
    public function index() {
        $viewData['type'] = get_request_var('t'); //url $_GET['t'] 
        $gender = get_request_var('g');
        $viewData['gender'] = $gender;

        $viewData['products'] = $this->model->getDanhSachSanPhamTheoGioiTinh($gender);
        $this->getView()->render('danh-sach', $viewData);//khai bao khi goi ham index thi se ra file giao dien nao len
    }
    public function getSearch() {
        if(isset($_GET['tukhoa'])){
            $tukhoa=$_GET['tukhoa']; 
            $viewData['gender'] = null;
            $viewData['products'] = $this->model->getDanhSachSanPhamTheoTenSP($tukhoa);
            //var_dump($viewData);die();
            $this->getView()->render('danh-sach', $viewData);
            
        }
        else{
            echo "khong tim thay";
        }
}
}
?>