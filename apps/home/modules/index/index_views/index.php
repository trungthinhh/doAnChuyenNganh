<html lang="en">
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
        'public/css/cssTrangchu' => ['cache' => true],
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
<div class="_trangchu">
    <div class="mainLayout">
        <div class="main">
            <div class="content_main">
                <div class="SwiperSilder">                     
                      <div class="sildes">
                        <img class="mySlides" src="<?php echo SITE_ROOT_IMG ?>tttl/img/banner1.jpg" style="width:100%;height: 800;">
                      </div>
                </div>
                <div class="category_content">
                    <div class="category">
                        <div class="item_category">
                            <div class="img_category">
                                <span>
                                   <a href="product/danh-sach?t=t_dress&g=1"><img src="<?php echo SITE_ROOT_IMG;?>tttl/img/sh125i.png" alt=""></a> 
                                </span>
                            </div>
                            <span>HONDA</span>
                        </div>
                    </div>
                    <div class="category">
                        <div class="item_category">
                            <div class="img_category">
                                <span>
                                   <a href="product/danh-sach?t=t_dress&g=5"><img src="<?php echo SITE_ROOT_IMG;?>tttl/img/AB.png" alt=""></a> 
                                </span>
                            </div>
                            <span>Triumph</span>
                        </div>
                    </div>
                    <div class="category">
                        <div class="item_category">
                            <div class="img_category">
                                <span>
                                   <a href="product/danh-sach?t=t_dress&g=2"><img src="<?php echo SITE_ROOT_IMG;?>tttl/img/Sirius.png" alt=""></a> 
                                </span>
                            </div>
                            <span>YAMAHA</span>
                        </div>
                    </div>
                    <div class="category">
                        <div class="item_category">
                            <div class="img_category">
                                <span>
                                   <a href="product/danh-sach?t=t_dress&g=5"><img src="<?php echo SITE_ROOT_IMG;?>tttl/img/Sym-Tus.png" alt=""></a> 
                                </span>
                            </div>
                            <span>SYM</span>
                        </div>
                    </div>
                    <div class="category">
                        <div class="item_category">
                            <div class="img_category">
                                <span>
                                   <a href="product/danh-sach?t=t_dress&g=3"><img src="<?php echo SITE_ROOT_IMG;?>tttl/img/Piaggo-Liberty.png" alt=""></a> 
                                </span>
                            </div>
                            <span>Piaggio</span>
                        </div>
                    </div>
                    <div class="category">
                        <div class="item_category">
                            <div class="img_category">
                                <span>
                                   <a href="#"><img src="<?php echo SITE_ROOT_IMG;?>tttl/img/vario.png" alt=""></a> 
                                </span>
                            </div>
                            <span>Phụ Tùng</span>
                        </div>
                    </div>
                </div>
                <div class="productBox">
                <div class="container_product">
                        <div class="productStyle_Box">
                            <div class="productBanner">
                                <span>
                                    <img src="<?php echo SITE_ROOT_IMG ?>tttl/img/banner2.jpg" alt="">
                                </span>
                                <!-- <span>
                                    <img src="<?php echo SITE_ROOT_IMG ?>tttl/img/banner3.jpg" alt="">
                                </span> -->
                                <span>
                                    <img src="<?php echo SITE_ROOT_IMG ?>tttl/img/banner4.jpg" alt="">
                                </span>
                            </div>
                            <div class="productstyle_list">
                                <div class="product_tittle">
                                    <h3>TOP BAN CHAY</h3>
                                </div>
                                <div class="product_listBox">
                                    <div class="product_swiper">
                                  
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
                        </div>
                                   
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                </div>
                <!---->
            </div>
        </div>
    </div>
</div>
<?php $this->template->display('footer.php'); ?>
</body>
</html>