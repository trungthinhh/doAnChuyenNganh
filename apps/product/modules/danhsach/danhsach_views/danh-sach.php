<?php
 //echo 'type '.$type;
 //echo '<br>gender '.$gender;
// var_dump($products); die(); dong test thu
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    
    // var_dump($products); die();
    $context = Context::getContext();
    //luu css va add vao nhu nay, khong goi truc tiep link css hay js tu he thong khac > viec nay tranh viec tan cong tu he thong thu 3 > luu y
    $context->prependStylesheet([
        'public/libs/ionicons/2.0.0/css/ionicons.min' => ['cache' => true],
        'public/libs/font-awesome-4.7.0/css/font-awesome.min' => ['cache' => true],
        'public/libs/bootstrap-3.3.7-dist/css/bootstrap.min' => ['cache' => true],
        'public/css/danhsach' => ['cache' => true],
        'public/css/css' => ['cache' => true]
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
                <div class="ProductShow_Body">
                    <div class="ProductShow_Show">
                        <?php if(count($products) > 0){ 
                            foreach($products as $pro){
                        ?>
                        <div class="product_column">                                    
                            <div class="productitem">
                                <div class="productimg">
                                    <a href="#">
                                        <img src="<?php echo SITE_ROOT_IMG.$pro['img'];?>" onclick="xemChiTiet('<?php echo $pro['MaSP']?>')" alt="">
                                    </a>
                                </div>
                                <div class="product_text">
                                    <div class="product_front">
                                        <h3><?php echo $pro['TenSP']?></h3>
                                    </div>
                                    <p><?php echo number_format($pro['GIA'],0).'đ' ?></p>
                                </div>
                                        <!-- <div class="button_buy">
                                            <div class="buynow">
                                                <button id="addcart" type="button">Thêm vào giỏ</button>
                                                <button id="buy_now" type="button">Mua ngay</button>
                                            </div>
                                        </div> -->
                            </div>
                        </div>
                        <?php } } ?>
                       
                    </div>
                    <ul class="pagination">
                            <li><a href="?per_page=4&page=1">1</a></li>
                            <li><a href="?per_page=4&page=2">2</a></li>
                            <li><a href="?per_page=4&page=3">3</a></li>
                            <li><a href="?per_page=4&page=4">4</a></li>
                            <li><a href="?per_page=4&page=5">5</a></li>                              
                        </ul>
                </div>
                  
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php $this->template->display('footer.php'); ?>


<script>
    function xemChiTiet(MaSP){
        // $.ajax({
        //     type: "POST",
        //     url: '/product/chitietsanpham',
        //     dataType:"jsonp",
        //     data: {
        //         "id": maSP
        //     },
        //     success: function(response){
                
        //         $( "#result" ).empty().append( response );
        //     }
        // });
        window.open("<?php echo SITE_ROOT ?>product/chitietsanpham?msp="+MaSP, "_top");
    }
</script>
