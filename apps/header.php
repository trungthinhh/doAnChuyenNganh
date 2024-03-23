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
        'public/css/danhsach' => ['cache' => true]
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
<div class="header">
    <div class="header_container">
        <div class="header_box">
            <div class="header_logo">
                
                <a href="/"><img src="<?php echo SITE_ROOT_IMG;?>tttl/img/logo1.jpg" alt=""></a>
            </div>
            <div class="header_info">
                <ul class="info_menu">
                <li><a href="/product/kenhnguoiban">KÊNH NGƯỜI BÁN</a></li>
                    <li><a href="/">TRANG CHỦ</a></li>
                    <li><a href="">SẢN PHẨM</a>
                        <div class="menu_box">
                            <ul class="menu_list_box">
                                <li><a href="" class="tittle_menu">THƯƠNG HIỆU</a>
                                    <ul class="menu_sub">
                                        <li><a href="<?php echo SITE_ROOT_IMG;?>product/danh-sach?t=t_name&g=1">HONDA</a></li>
                                        <li><a href="<?php echo SITE_ROOT_IMG;?>product/danh-sach?t=t_name&g=2">YAMAHA</a></li>
                                        <li><a href="<?php echo SITE_ROOT_IMG;?>product/danh-sach?t=t_name&g=3">SUZUKI</a></li>
                                    </ul>
                                </li>
                                <li ><a href="" class="tittle_menu">DÒNG XE</a>
                                    <ul class="menu_sub">
                                        <li><a href="<?php echo SITE_ROOT_IMG;?>product/danh-sach?t=t_dress&g=2">Xe số</a></li>
                                        <li><a href="<?php echo SITE_ROOT_IMG;?>product/danh-sach?t=t_dress&g=5">Xe tay ga</a></li>
                                        <li><a href="<?php echo SITE_ROOT_IMG;?>product/danh-sach?t=t_dress&g=4">Xe tay côn</a></li>
                                    </ul>
                                </li>
                                <li><a href="" class="tittle_menu">PHỤ TÙNG</a>
                                    <ul class="menu_sub">
                                        <li><a href="">Phụ tùng</a></li>
                                        <li><a href="">Phụ kiện</a></li>
                                    </ul>
                                </li>
                                
                                <li class="menu_img">
                                    <img src="<?php echo SITE_ROOT_IMG;?>tttl/img/banner.jpg" alt="aonu">
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- <li><a href="">SALE</a></li> -->
                    
                </ul>
            </div>
            <div class="header_right">
                <div class="header_search">
                    <div class="search_Search">
                        <form action="/product/danh-sach/getSearch?" method="GET" class="form_search">
                            <input type="text" name="tukhoa" id="search_input" placeholder="Tìm kiếm" >
                            <button type="submit" class="search_button">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
                                <!-- coi lai cho nay dung de link trang khac vao -->
                            </button>
                        </form>
                    </div>
                </div>
                <div class="header_acc">
                    <ul class="account">
                        <li>
                            <a href="/product/dangnhap">
                                <button type="submit" class="button_acc">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M12.1596 10.87C12.0596 10.86 11.9396 10.86 11.8296 10.87C9.44957 10.79 7.55957 8.84 7.55957 6.44C7.55957 3.99 9.53957 2 11.9996 2C14.4496 2 16.4396 3.99 16.4396 6.44C16.4296 8.84 14.5396 10.79 12.1596 10.87Z" stroke="#1A0405" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M7.15973 14.56C4.73973 16.18 4.73973 18.82 7.15973 20.43C9.90973 22.27 14.4197 22.27 17.1697 20.43C19.5897 18.81 19.5897 16.17 17.1697 14.56C14.4297 12.73 9.91973 12.73 7.15973 14.56Z" stroke="#1A0405" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                                </button>
                            </a>
                            
                        </li>
                        <li><a href="/product/giohang">
                            <button type="submit" class="button_acc" id="cart">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M7.5 7.67001V6.70001C7.5 4.45001 9.31 2.24001 11.56 2.03001C14.24 1.77001 16.5 3.88001 16.5 6.51001V7.89001" stroke="#0A0B11" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path><path d="M8.99983 22H14.9998C19.0198 22 19.7398 20.39 19.9498 18.43L20.6998 12.43C20.9698 9.99 20.2698 8 15.9998 8H7.99983C3.72983 8 3.02983 9.99 3.29983 12.43L4.04983 18.43C4.25983 20.39 4.97983 22 8.99983 22Z" stroke="#0A0B11" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path><path d="M15.4955 12H15.5045" stroke="#0A0B11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M8.49451 12H8.50349" stroke="#0A0B11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>                       
                            </button>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>