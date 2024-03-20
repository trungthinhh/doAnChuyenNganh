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
        'public/css/css' => ['cache' => true],
        'public/css/cssChitiet' => ['cache' => true]
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
    <div class="productDetail">
        <div class="container_main">
            <div class="Productdetail_main">
            <div class="productt">
            <input type="hidden" id="maSP" value="<?php echo $maSP; ?>">
                <?php if(count($products) > 0){ 
                    foreach($products as $pro){
                ?>
                <input type="hidden" id="tenSP" value="<?php echo $pro['TenSP']; ?>"><!--gọi TenSP trong sql ra (TenSP) phải trùng khớp với TenSP trong table sanpham-->
                    <input type="hidden" id="gia" value="<?php echo $pro['GIA']; ?>">
                    
                <div class="productdetail_gallery">
                    <div class="product-gallery">
                        <!-- <div class="swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="slide-item">
                                        <span>
                                            <img src="<?php echo SITE_ROOT_IMG.$pro['Hinh1'];?>" alt="">
                                        </span>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="slide-item">
                                        <span>
                                            <img src="<?php echo SITE_ROOT_IMG.$pro['Hinh2'];?>" alt="">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="swiper swiper-img">
                            <div class="swiperimg-wrapper">
                                
                                <span>
                                    <img src="<?php echo SITE_ROOT_IMG.$pro['img'];?>" alt="">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="productdetail_info">
                    <div class="productInfo">
                        <div class="productInfo_tittle">
                            <h3><?php echo $pro['TenSP']?></h3>
                            <h4>Mã sản phẩm:<?php echo $pro['MaSP']?></h4>
                        </div>
                        <div class="productInfo_price">
                            <p id="gia"><?php echo number_format($pro['GIA'],0)."đ"?></p>
                        </div>
                        <div class="productInfo_size">
                            <!-- <label>Chọn size: -->
                                <!-- <b>?</b> -->
                            </label>
                            <ul>
                                <!-- <li><a href="#">S</a></li>
                                <li><a href="#">M</a></li>
                                <li><a href="#">L</a></li> -->
                            </ul>
                        </div>
                        <div class="productInfo_quanity">
                            <div class="productInfo_input">
                                <div class="productInfo_block">
                                    <div class="quanity_product">
                                        <button type="button" class="btn_minus" onclick="handleMinus()">
                                            <svg width="37" height="36" viewBox="0 0 37 36" fill="none"><rect x="12.5" y="17" width="12" height="1.5" rx="0.750001" fill="#292929"></rect></svg>
                                        </button>
                                        <label for="">
                                            <input type="text" value="1" id="amount" name="amount">
                                        </label>
                                        <button type="button" class="btn_plus" onclick="handlePlus()">
                                            <svg width="37" height="36" viewBox="0 0 37 36" fill="none"><rect x="12.5" y="17.25" width="12" height="1.5" rx="0.75" fill="#292929"></rect><rect x="19.25" y="12" width="12" height="1.5" rx="0.75" transform="rotate(90 19.25 12)" fill="#292929"></rect></svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" id="btn_cart">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M7.5 7.67001V6.70001C7.5 4.45001 9.31 2.24001 11.56 2.03001C14.24 1.77001 16.5 3.88001 16.5 6.51001V7.89001" stroke="#0A0B11" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path><path d="M8.99983 22H14.9998C19.0198 22 19.7398 20.39 19.9498 18.43L20.6998 12.43C20.9698 9.99 20.2698 8 15.9998 8H7.99983C3.72983 8 3.02983 9.99 3.29983 12.43L4.04983 18.43C4.25983 20.39 4.97983 22 8.99983 22Z" stroke="#0A0B11" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path><path d="M15.4955 12H15.5045" stroke="#0A0B11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M8.49451 12H8.50349" stroke="#0A0B11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                            </button>
                            <button type="button" class="btn_order">Mua ngay</button>
                        </div>
                        <div class="productInfor_desc">
                            <div class="desccontent" id="demo">
                                <h1>Thông tin sản phẩm:</h1>
                                <div id="desc">
                                    <ol type="1">
                                        <li style="font-size:20px">1. Thông tin sản phẩm:
                                            <ul type="circle">
                                                <li style="font-size:19px">Wave Alpha được trang bị động cơ 110cc</li>
                                                <Sử style="font-size:19px">Hiệu suất vượt trội nhưng vẫn đảm bảo tiết kiệm nhiên liệu tối ưu, cho bạn thêm tự tin và trải nghiệm tốt nhất trên mọi hành trình</li>
                                                <li style="font-size:19px">Thiết kế bộ tem mới phong cách đầy ấn tượng trên xe giúp bạn thể hiện sự trẻ trung, năng động, thu hút mọi ánh nhìn</li>
                                            </ul>
                                        </li></br>
                                        <!-- <li style="font-size:20px">2. CÁCH CHỌN SIZE
                                            <ul type="circle">
                                                <li style="font-size:19px"> Size: S|Cân nặng: 40 - 48 kg|Eo: 60 - 68 cm</li>
                                                <li style="font-size:19px"> Size: M|Cân nặng: 48 - 55 kg|Eo: 68 - 73 cm</li>
                                                <li style="font-size:19px"> Size: L|Cân nặng: 55 - 65 kg|Eo: 73 - 80 cm</li>
                                            </ul>
                                        </li> -->
                                    </ol>
                                </div>
                            </div>
                            <div class="descbutton"></div>
                        </div>
                    </div>
                </div>
                <?php }} ?>
            </div>
            <!-- <div class="ProductShow">
                <div class="ProductRelated">
                    <div class="ProductRelated_Box">
                        <div class="ProductRelated_Tittle">
                            <h3>Gợi ý</h3>
                        </div>
                        <div class="ProductShow_Body">
                            <div class="ProductShow_Show">
                                <div class="product_column">
                                    <div class="productitem">
                                        <div class="productimg">
                                            <a href="#">
                                                <img src="<?php echo SITE_ROOT_IMG;?>tttl/img/wave-alpha.png" alt="">
                                            </a>
                                        </div>
                                        <div class="product_text">
                                            <div class="product_front">
                                                <h3>Hoda Wave Alpha</h3>
                                            </div>
                                            <p>2560000đ</p>
                                        </div>
                                        <div class="button_buy">
                                            <div class="buynow">
                                                <button id="addcart" type="button">Thêm vào giỏ</button>
                                                <button id="buy_now" type="button">Mua ngay</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product_column">
                                    <div class="productitem">
                                        <div class="productimg">
                                            <a href="#">
                                                <img src="<?php echo SITE_ROOT_IMG;?>tttl/img/sh125i.png" alt="">
                                            </a>
                                        </div>
                                        <div class="product_text">
                                            <div class="product_front">
                                                <h3>Honda SH125i</h3>
                                            </div>
                                            <p>72.650.000đ</p>
                                        </div>
                                        <div class="button_buy">
                                            <div class="buynow">
                                                <button id="addcart" type="button">Thêm vào giỏ</button>
                                                <button id="buy_now" type="button">Mua ngay</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product_column">
                                    <div class="productitem">
                                        <div class="productimg">
                                            <a href="#">
                                                <img src="<?php echo SITE_ROOT_IMG;?>tttl/img/AB.png" alt="">
                                            </a>
                                        </div>
                                        <div class="product_text">
                                            <div class="product_front">
                                                <h3>Honda Air Blade 125</h3>
                                            </div>
                                            <p>45.000.000đ</p>
                                        </div>
                                        <div class="button_buy">
                                            <div class="buynow">
                                                <button id="addcart" type="button">Thêm vào giỏ</button>
                                                <button id="buy_now" type="button">Mua ngay</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product_column">
                                    <div class="productitem">
                                        <div class="productimg">
                                            <a href="#">
                                                <img src="<?php echo SITE_ROOT_IMG;?>tttl/img/Piaggio-Medley.png" alt="">
                                            </a>
                                        </div>
                                        <div class="product_text">
                                            <div class="product_front">
                                                <h3>Piaggio Medley</h3>
                                            </div>
                                            <p>70.000.000đ</p>
                                        </div>
                                        <div class="button_buy">
                                            <div class="buynow">
                                                <button id="addcart" type="button">Thêm vào giỏ</button>
                                                <button id="buy_now" type="button">Mua ngay</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product_column">
                                    <div class="productitem">
                                        <div class="productimg">
                                            <a href="#">
                                                <img src="<?php echo SITE_ROOT_IMG;?>tttl/img/Piaggo-Vespa-S.png" alt="">
                                            </a>
                                        </div>
                                        <div class="product_text">
                                            <div class="product_front">
                                                <h3>Vespa 125i</h3>
                                            </div>
                                            <p>90.000.000đ</p>
                                        </div>
                                        <div class="button_buy">
                                            <div class="buynow">
                                                <button id="addcart" type="button">Thêm vào giỏ</button>
                                                <button id="buy_now" type="button">Mua ngay</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product_column">
                                    <div class="productitem">
                                        <div class="productimg">
                                            <a href="#">
                                                <img src="<?php echo SITE_ROOT_IMG;?>tttl/img/vision.png" alt="">
                                            </a>
                                        </div>
                                        <div class="product_text">
                                            <div class="product_front">
                                                <h3>HONDA Vision</h3>
                                            </div>
                                            <p>30.000.000đ</p>
                                        </div>
                                        <div class="button_buy">
                                            <div class="buynow">
                                                <button id="btn_cart" type="button">Thêm vào giỏ</button>
                                                <button id="buy_now" type="button">Mua ngay</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>

<script type = "text/javascript">
    // function changeColor(colorName){
    //     $('#field1').text(colorName); //jquery
    //     $('#colorChooses').val(colorName);
    // }
    // function changeSize(sizeName){
    //     $('#field2').text(sizeName);
    //     $('#sizeChooses').val(sizeName);//lấy giá trị từ size
    // }

    let amountElement=document.getElementById('amount'); 
    let amount=amountElement.value;
    
    let render=(amount)=>{
        amountElement.value=amount;
    }
    //handle plus
    let handlePlus=()=>{
        amount++;
        render(amount);
    }
    //handleMinus
    let handleMinus=()=>{
        if(amount>1)
            amount--;
        render(amount);
    }
    //khi nguoi dung input vao
    amountElement.addEventListener('input',()=>{
        amount=amountElement.value;
        //chuyen sang so
        amount=parseInt(amount);
        amount=(isNaN(amount)||(amount==0))?1:amount;//neu nguoi dung nhap kieu chu thi se ra loi NaN dong nay minh se doi chu thanh so
        render(amount);
        console.log(amount);
    });

    //tim va so sanh sp trong gio hang
    $('#btn_cart').click(function(){//#btn_cart là id của nút thêm vào giỏ hàng
        var maSP = $('#maSP').val();
        var tenSP = $('#tenSP').val();
        var amount = $('#amount').val();
        var gia = $('#gia').val();
        // console.log(color);
        $.ajax('/product/chitietsanpham/saveCartProduct',{   
            type: 'POST',  // http method
            data: { 
                'maSP': maSP,
                'tenSP': tenSP,
                'amount': amount,
                'gia': gia,
            },  // data to submit
            success: function (data, status, xhr) {
                alert(data);
            }

        });
    });
</script>

<?php $this->template->display('footer.php'); ?>
</body>
</html>
