<?php

if (!defined('SERVER_ROOT')) {
    exit('No direct script access allowed');
}

class chitietsanpham_Controller extends Controller {

    public function __construct() { //ham cau truc, vd app la home/ke ben la module
        parent::__construct('product', 'chitietsanpham');
       
    }
    

    public function main() {//dau tien khi url goi home/index thi dau tien no se vo index
        $this->index();//khong bo qua nhieu xu ly vao ham main nay
    }
    public function index() {

        $msp = get_request_var('msp');
        
        if(!empty($msp)){
            $viewData['products'] = $this->model->getChiTietSanPham($msp);          
            $viewData['maSP'] = $msp; 
            
            $this->getView()->render('chitietsanpham', $viewData);
            
            //khai bao khi goi ham index thi se ra file giao dien nao len      
        }else{
            $this->getView()->render('error404');   
        }
    }
    public function saveCartProduct(){//lưu trữ sản phẩm
        $Hinh = get_post_var('Hinh');
        $masp = get_post_var('maSP');
        $tenSP = get_post_var('tenSP');
        $amount = get_post_var('amount');
        $gia = get_post_var('gia');
        echo "Them gio hang thanh cong";
        // echo  'maSP:'.$masp;
        // echo  'tenSP:'.$tenSP;
        // echo  'amount:'.$amount;
        // echo  'gia:'.$gia;
            
        return $this->model->getLuusanpham($Hinh,$masp,$tenSP,$amount,$gia); 
    }
    }

?>