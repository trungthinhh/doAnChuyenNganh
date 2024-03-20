<?php

if (!defined('SERVER_ROOT')) {
    exit('No direct script access allowed');
}

class dathang_Controller extends Controller {

    public function __construct() { //ham cau truc, vd app la home/ke ben la module
        parent::__construct('product', 'dathang');
       
    }
    

    public function main() {//dau tien khi url goi home/index thi dau tien no se vo index
        $this->index();//khong bo qua nhieu xu ly vao ham main nay
    }
    public function index() {
        $viewData['products'] = $this->model->getDatHang();      
            $this->getView()->render('dathang', $viewData);
    }
   
   }

?>