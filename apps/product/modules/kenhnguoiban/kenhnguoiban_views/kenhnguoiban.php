<?php
   // session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kênh người bán</title>
    <?php
    $context = Context::getContext();
    //luu css va add vao nhu nay, khong goi truc tiep link css hay js tu he thong khac > viec nay tranh viec tan cong tu he thong thu 3 > luu y
    $context->prependStylesheet([
        'public/libs/ionicons/2.0.0/css/ionicons.min' => ['cache' => true],
        'public/libs/font-awesome-4.7.0/css/font-awesome.min' => ['cache' => true],
        'public/libs/bootstrap-3.3.7-dist/css/bootstrap.min' => ['cache' => true],
        'public/css/css' => ['cache' => true],
        'public/css/cssKenhnguoiban' => ['cache' => true]
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
                    <div class="menuDung">
                        <ul class="dropdownMenu">
                            <li><a href="">Quản lý sản phẩm</a>
                                <ul class="sub-menu">
                                    <li><a class="tablinks" onclick="OpenTab(event, 'XemSanpham')">Xem sản phẩm</a></li>
                                    <li><a class="tablinks" onclick="OpenTab(event, 'QuanlySanpham')">Thêm sản phẩm</a></li>
                                </ul>
                            </li>
                        </ul>
                     </div>
                     <div class="content">
                        <div id="XemSanpham" class="TabContentX">
                            <div class="bangContent">
                                <table>                                  
                                    <tr>
                                        <th id="masp">Mã sản phẩm</th>
                                        <th>Mã danh mục</th>
                                        <th>Hình ảnh</th>
                                        <th id="tensp">Tên sản phẩm</th>
                                        <th>Giá</th>
                                        <th>Hành động</th>                      
                                    </tr>  
                                    <?php if(count($products)>0){ 
                                        foreach($products as $pro){            
                                    ?>
                                    <input type="hidden" id="MaSP" value="<?php echo $pro['MaSP']; ?>">
                                    <tr>

                                        <td><?php echo $pro['MaSP']?></td>
                                        <td><?php echo $pro['MADM']?></td>
                                        <td><img src="<?php echo SITE_ROOT_IMG.$pro['img'];?>" alt=""></td>
                                        <td id="tensp"><?php echo $pro['TenSP']?></td>
                                        <td><?php echo $pro['GIA']?></td>
                                        <td><a style="cursor:hand;" onclick="deletePro('<?php echo $pro['MaSP'];?>')">Xóa</a></td>                  
                                    </tr>   
                                    <?php }}?>   
                                </table>
                                <ul class="pagination">
                                    <li><a href="?per_page=4&page=1">1</a></li>
                                    <li><a href="?per_page=4&page=2">2</a></li>
                                    <li><a href="?per_page=4&page=3">3</a></li>
                                    <li><a href="?per_page=4&page=4">4</a></li>
                                    <li><a href="?per_page=4&page=5">5</a></li>
                                    <li><a href="?per_page=4&page=6">6</a></li>
                                    <li><a href="?per_page=4&page=7">7</a></li>
                                    <li><a href="?per_page=4&page=8">8</a></li>
                                
                                </ul>
                            </div>       
                        </div>
                        <div id="QuanlySanpham" class="TabContentQL">
                            <div class="bangContent">
                                <div class="rowContent">
                                    <div class="lbltitle">
                                        <label> Hình ảnh</label>
                                    </div>
                                    <div class="lblinput">
                                        <form action="tttl/img/" method="post" enctype="multipart/form-data">
                                            <input type="file" name="Hinh" id="Hinh">
                                        </form>
                                    </div>
                                </div>
                                <div class="rowContent">
                                    <div class="lbltitle">
                                        <label>Tên sản phẩm</label>
                                    </div>
                                    <div class="lblinput">
                                        <input type="text" id="txtname" name="" value="">
                                    </div>
                                </div>
                                <div class="rowContent">
                                    <div class="lbltitle">
                                        <label>Danh mục</label>
                                    </div>
                                    <div class="lblinput">                                        
                                        <div class="inputSize">
                                            <form action="" method="POST">
                                                <select id="MaDM" name="MaDM" > 
                                                    <option value="0">--Hãy chọn danh mục--</option>                                                  
                                                    <!-- <option id="MaDM" value="<?php echo $dm['MaDM']?>"><?php echo $dm['TenDM']?></option> -->
                                                    <option value="1">HONDA</option>
                                                    <option value="2">YAMAHA</option>
                                                    <option value="3">SYM</option>
                                                    <option value="4">Piaggio</option>
                                                    <option value="5">Triumph</option>                                             
                                                </select>
                                             </form>                                    
                                        </div>
                                    </div>
                                </div>
                             
           
                                <div class="rowContent">
                                    <div class="lbltitle">
                                        <label>Giá sản phẩm</label>
                                    </div>
                                    <div class="lblinput">
                                        <input type="text" id="txtGia" value="">
                                    </div>
                                </div>
                                <button name="AddProduct" id="AddProduct" onclick="AddProduct()">Thêm sản phẩm</button>
                            </div>
                        </div>
                     </div>       
                </div>
            </div>
        </div>
</div>
<script>
    let user=[];
    let currentPage=1
    let perPage=2
    let totalPage=user.length/2
    let perUsesr=[]
    function OpenTab(evt, productName) {
        var i, TabContentX,TabContentQL, tablinks;
        TabContentX = document.getElementsByClassName("TabContentX");
        TabContentQL = document.getElementsByClassName("TabContentQL");
 
        for (i = 0; i < TabContentX.length; i++) {
            TabContentX[i].style.display = "none";
        }
        for (i = 0; i < TabContentQL.length; i++) {
            TabContentQL[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(productName).style.display = "block";
        evt.currentTarget.className += " active";
        }
    function deletePro(MaSP){
        //var maG = $('#MaG').val();
        $('#MaSP').val(MaSP);
            $.ajax('/product/kenhnguoiban/XoaSanpham',{   
                type: 'POST',  // http method
                data: { 
                    'MaSP': MaSP,                 
                },  // data to submit
                success: function (data, status, xhr) {
                    alert(data);
                }
            });
    }
    function AddProduct(TenSP,Hinh,TenMau,TenSz,TenDM,Gia){
        var TenSP = $('#txtname').val();
        var MaDM = $('#MaDM').val();
        var Hinh = $('#Hinh').val();
        var Gia = $('#txtGia').val();
            $.ajax('/product/kenhnguoiban/ThemSanpham',{   
                type: 'POST',  // http method
                data: { 
                    'TenSP': TenSP,
                    'Hinh': Hinh,
                    'MaDM': MaDM,
                    'Gia': Gia,
                },  // data to submit
                success: function (data, status, xhr) {
                   if(data==1){
                    alert("Thêm thành công");
                   }
                   else{
                    alert("Thêm không thành công");
                   }
                }

            });
    }
</script>
<?php $this->template->display('footer.php'); ?>
</body>
</html>