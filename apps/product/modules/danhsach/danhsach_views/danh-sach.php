<?php
 //echo 'type '.$type;
 //echo '<br>gender '.$gender;
// var_dump($products); die(); dong test thu
?>
<?php $this->template->display('header.php'); ?>

<div class="mainLayout">
        <div class="container_main">
            <div class="productBox">
                <div class="ProductShow">
<!--Do nam-->
                   
                    
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
                                            <p><?php echo $pro['GIA'].'đ' ?></p>
                                        </div>
                                        <div class="button_buy">
                                            <div class="buynow">
                                                <button id="addcart" type="button">Thêm vào giỏ</button>
                                                <button id="buy_now" type="button">Mua ngay</button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <?php } } ?>
                            </div>
                        </div>
                   


                    
 
                    
                </div>
            </div>
        </div>
</div>
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
<?php $this->template->display('footer.php'); ?>

