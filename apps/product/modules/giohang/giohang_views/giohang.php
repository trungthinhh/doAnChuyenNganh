<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    $context = Context::getContext();
    //luu css va add vao nhu nay, khong goi truc tiep link css hay js tu he thong khac > viec nay tranh viec tan cong tu he thong thu 3 > luu y
    $context->prependStylesheet([
        'public/libs/ionicons/2.0.0/css/ionicons.min' => ['cache' => true],
        'public/libs/font-awesome-4.7.0/css/font-awesome.min' => ['cache' => true],
        'public/libs/bootstrap-3.3.7-dist/css/bootstrap.min' => ['cache' => true],
        'public/css/cssTrangchu' => ['cache' => true],
        'public/css/css' => ['cache' => true],
        'public/css/cssGiohang' => ['cache' => true]
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
<div class="mainLayout">
        <div class="container_main">
            <div class="productBox">
                <div class="ProductShow">
                    <div class="col-12 text-center">
                        <br>
                        <h3>Giỏ hàng</h3> 
                        <!-- //<p>Khách hàng:</p>        -->
                            <table class="tableCart" id="giohang">
                                <tr>
                                    <!-- <th>MaG</th> -->
                                    <th>Mã giỏ hàng</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Giá</th>
                                    <th>Thành tiền</th>
                                   <th>Hành động</th>
                                    
                                </tr>
                                
                                <?php if(count($products)>0){ 
                                     $tong=0;
                                    //error_reporting (E_ALL ^ E_NOTICE);
                                            foreach($products as $pro){
                                            // var_dump($pro['MaG']);die();
                                           
                                            $tt=number_format($pro['gia']*$pro['soluong']);
                                            $tong+= $tt;                
                                    ?>
                                <!-- <input type="hidden" id="makh" value="<?php echo $makh; ?>"> -->
                                <tr>
                            
                                    <td id="MaG"><?php echo $pro['MaG']?></td>
                                    <td id="tensp"><?php echo $pro['tenSP']?></td>
                                    <td><?php echo $pro['soluong']?></td>
                                    <td><?php echo number_format($pro['gia'],0)?></td>
                                    <td><?php echo number_format($pro['gia']*$pro['soluong'],0)?></td>
                                    <td><a style="cursor:hand;" onclick="deletePro('<?php echo $pro['MaG']; ?>')">Xóa</a></td>                  

                                </tr>    
                                 <?php }}?>
                            <tr>                  
                                    <th colspan="3">Tổng tiền</th>
                                    <th></th>  
                                    <th id="tongdonhang"><?php echo number_format($tong,3).''."đ"?></th>          
                                    <th></th>
                                </tr>
                           
                            </table>
                            <a href="/product/dathang"> <button id="Order">Đặt hàng</button></a>
                           
                            <!-- <button id="deletePro" >Xóa</button> -->
                        <p>Hãy nhanh tay chọn ngay sản phẩm yêu thích.</p>
                    </div>
                    
                </div>
            </div>
        </div>
</div>
<script>
     function deletePro(MaG){
        //var maG = $('#MaG').val();
        $('#MaG').val(MaG);
        //console.log(MaG);
       
            $.ajax('/product/giohang/XoaGiohang',{   
                type: 'POST',  // http method
                data: { 
                    'MaG': MaG,                    
                },  // data to submit
                success: function (data, status, xhr) {
                   alert(data);
                    //alert(dât);
                }
            });     
    }
</script>
<?php $this->template->display('footer.php'); ?>
</body>
</html>
