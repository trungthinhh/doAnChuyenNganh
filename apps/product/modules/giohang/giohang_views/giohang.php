<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <?php
    
    // var_dump($products); die();
    $context = Context::getContext();
    //luu css va add vao nhu nay, khong goi truc tiep link css hay js tu he thong khac > viec nay tranh viec tan cong tu he thong thu 3 > luu y
    $context->prependStylesheet([
        'public/libs/ionicons/2.0.0/css/ionicons.min' => ['cache' => true],
        'public/libs/font-awesome-4.7.0/css/font-awesome.min' => ['cache' => true],
        'public/libs/bootstrap-3.3.7-dist/css/bootstrap.min' => ['cache' => true],
        'public/css/cssHeaderFooter' => ['cache' => true],
        'public/css/cssGioHang' => ['cache' => true]
    ]);
    echo $context->getEmbedStylesheet();

    $context->prependJavascript([
        'public/libs/bootstrap-3.3.7-dist/js/bootstrap.min' => ['cache' => true],
        'public/libs/jquery/jquery-3.6.min' => ['cache' => true]
    ]);
    echo $context->getEmbedJavascript();
    ?> 
</head>
<body>
<?php $this->template->display('header.php'); ?>
<div class="_trangchu">
<div class="mainLayout">
    <div class="main">
        <div class="content_main">
            <div class="shopping_cart_area">
                <form action="#"> 
                    <div class="row">
                        <div class="col-12">
                            <div class="table_desc">
                                <div class="cart_page table-responsive">
                                    <table style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="product_remove">Hành động</th>
                                                <th class="product_thumb">Hình ảnh</th>
                                                <th class="product_name">Sản phẩm</th>
                                                <th class="product-price">Giá</th>
                                                <th class="product_quantity">Số lượng</th>
                                                <th class="product_total">Tổng cộng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                            <?php if(count($products)>0){ 
                                                // error_reporting (E_ALL ^ E_NOTICE);
                                                            $tong=0; 
                                                            foreach($products as $pro){
                                                            
                                                            // var_dump($pro['MaG']);die();
                                                            $tt=$pro['gia']*$pro['soluong'];
                                                            $tong+=$tt;                
                                                ?>
                                                <!-- <input type="hidden" id="soluong" value="<?php echo $pro['soluong']; ?>"> -->
                                                <input type="hidden" id="MaG" value="<?php echo $pro['MaG']; ?>">

                                                    <td class="product_remove"><a href="#" id="btn_delete" onclick=""><i class="fa fa-trash-o"></i></a></td>
                                                    <td class="product_thumb"><a href="#"><img src="<?php echo SITE_ROOT_IMG.$pro['Hinh']?>" alt=""></a></td>
                                                    <td class="product_name"><a href="#"><?php echo $pro['tenSP']?></a></td>
                                                    <td class="product-price"><?php echo $pro['gia']?></td>
                                                    <td class="product_quantity"><input min="0" max="100" id="soluong" value="<?php echo $pro['soluong']?>" type="number"></td>
                                                    <td class="product_total"><?php echo number_format($pro['gia']*$pro['soluong'],0)?></td>
                                                <?php }}?>
                                            </tr>
                                        </tbody>
                                    </table>   
                                </div>  
                                <div class="cart_submit">
                                    <button type="submit" id="btn_update">Cập nhật</button>
                                </div>      
                            </div>
                        </div>
                    </div>
                                     
                    <div class="coupon_area">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="coupon_code">
                                    <h3>TỔNG CỘNG GIỎ HÀNG</h3>
                                    <div class="coupon_inner">
                                        <div class="cart_subtotal">
                                            <p>Tổng mặt hàng</p>
                                            <p class="cart_amount"><?php echo number_format($tong)?></p>
                                        </div>
                                        <!-- <div class="cart_subtotal ">
                                            <p>Giá vận chuyển</p>
                                            <p class="cart_amount"><span>Flat Rate:</span> £255.00</p>
                                        </div>
                                        <a href="#">Calculate shipping</a>
                                        <div class="cart_subtotal">
                                            <p>Total</p>
                                            <p class="cart_amount">£215.00</p>
                                        </div> -->
                                        <div class="checkout_btn">
                                            <a id="Order" onclick="Dathang()">ĐẶT HÀNG</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>
</div>
<?php $this->template->display('footer.php'); ?>
</body>
</html>
<script type = "text/javascript">
function deleteSP(MaG){
        //var maG = $('#MaG').val();
        $('#MaG').val(MaG);
            $.ajax('/product/giohang/XoaGiohang',{   
                type: 'POST',  // http method
                data: { 
                    'MaG': MaG,                 
                },  // data to submit
                success: function (data, status, xhr) {
                    alert(data);
                }
            });
    }
    $('#btn_update').click(function(){
        var soluong = $('#soluong').val();
        var MaG = $('#MaG').val();
        
        // console.log(color);
        $.ajax('/product/giohang/CapNhatGiohang',{   
            type: 'POST',  // http method
            data: { 
                'soluong':soluong,
                'MaG': MaG,
            },  // data to submit
            success: function (data, status, xhr) {
                if(data==1){
                    alert("Cập nhật thành công");
                   }
                   else{
                    alert("Cập nhật không thành công");
                   }
            }

        });
    });
function Dathang(){
    $('#MaG').val(MaG);
    $.ajax('/product/giohang/Order',{   
               type: 'POST',  // http method
               data: { 
                   
               },  // data to submit
               success: function (data, status, xhr) {
                if(data==1){                    
                    window.open("<?php echo SITE_ROOT ?>product/dathang","_self"); 
                   }
                else{
                    alert("Vui lòng đăng nhập trước khi thanh toán");   
                    window.open("<?php echo SITE_ROOT ?>product/dangnhap","_self"); 
                   }  
               }
   
           });
}

</script>