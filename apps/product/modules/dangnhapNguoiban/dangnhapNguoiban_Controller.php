<?php

if (!defined('SERVER_ROOT')) {
    exit('No direct script access allowed');
}

class dangnhapNguoiban_Controller extends Controller {

    public function __construct() { //ham cau truc, vd app la home/ke ben la module
        parent::__construct('product', 'dangnhapNguoiban');
       
    }
    

    public function main() {//dau tien khi url goi home/index thi dau tien no se vo index
        $this->index();//khong bo qua nhieu xu ly vao ham main nay
    }
    public function index() {
        $viewData['products'] = $this->model->getDanhSachSanPham();
        //$viewData['MaG'] = $this->model->xoaSanpham($maG);           
            $this->getView()->render('dangnhapNguoiban', $viewData);
    }
    public function XoaGiohang() {
        //ẩn lỗi
        $MaG = get_post_var('MaG');
        echo "đã xóa thành công";
        return $this->model->getxoaSanpham($MaG);
        
        }
    public function CapnhatGiohang() {
        $MaG = get_post_var('MaG');
        $soluong = get_post_var('soluong');

        echo "đã cập nhật thành công";
        return $this->model->getCapnhatSP($MaG,$soluong);
    }
    // public function Order(){
    //     //xử lý đặt hàng và kiểm tra đăng nhập
    //     $_SESSION['username']=$username;
    //     if(empty($_SESSION['username'])){
    //         //người dùng đã đăng nhập
    //         //$username=new Username();
    //         echo 'đã đăng nhập';
    //     }
    //     else{echo 'chưa';}
    // }
    // public function checkUser(){
    //     //$makh = get_post_var('makh'); 
    //     $result = $this->model->getDanhSachSanPham();
       
           
       
        
    //     // else{
    //     //     //echo "Đã đăng nhập thành công";
    //     //     echo "chưa đăng nhập";
    //     // if(empty($_SESSION['TAI_KHOAN_KH'])){
    //     //     //     //echo 1;
    //     //     //     echo"đã đăng nhập";
    //     //     // $tkDangnhap = $result[0];
    //     //     // $_SESSION['TAI_KHOAN_KH'] = $tkDangnhap['MaKH'];
           
    //     //     // $_SESSION['USER_NAME_KH'] = $tkDangnhap['username']; 
    //     //     echo "đã đăng nhập";
    //     // }
    //     // if(empty($_SESSION['TAI_KHOAN_KH'])){
            
    //     //     echo "chưa đăng nhập";
    
    //     // }
    //     // else{
    //     //     echo"Bạn chưa đăng nhập";
    //     // }
        
    //     // $result = $this->model->getDanhSachSanPham();
    //     // }
    // }
    public function Order(){
       if(!isset($_SESSION['username'])){
        echo 0;
       }
       else{
        echo 1; 
       }
            // $tkDangnhap = $result[0];
           // $_SESSION['TAI_KHOAN_KH'] = $tkDangnhap['MaKH'];
            // $_SESSION['USER_NAME_KH'] = $tkDangnhap['username'];
        //Session::set('TEN_KH', $tkDangnhap['username']);//nay de lai de tu chinh
        //SESSION_PREFIX neu khong co key nay cung duoc, em co the dat ten tuy y
        //cai nay giong cai e dang xem $_SESSION['dangnhap'] chang qua da duoc dieu chinh lai cho hop ly, de su dung
        //file session.php > day da dieu chinh lai

        }

    // public function TangSoluong() {
    //     $pro=$_GET['MaG'];
    //     $products=$this->productModel->findById($pro);
    //     if(empty($_SESSION['cart'])||!array_key_exists($pro,$_SESSION['cart'])){
    //         $products['Soluong']=1;
    //         $_SESSION['cart'][$pro]=[$products];
    //     }
    //     else{
    //         $products['Soluong']=$_SESSION['cart'][$pro]['Soluong']+1;
    //         $_SESSION['cart'][$pro]=$products;
    //     }
    //    // echo  'MaG:'.$maG;
    //     //$result = $this->model->xoaSanpham($maG);         

    // }
}
?>