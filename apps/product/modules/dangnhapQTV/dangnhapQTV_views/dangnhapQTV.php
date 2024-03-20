<?php
//session_start();
?>
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
        'public/css/taikhoan_style' => ['cache' => true]
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
        <div class="container">
        <from class = "form-login" action="">
            <h1>Đăng nhập kênh người bán</h1>
            <div class="form-text">
                <input type="text" name="" id="user" value="thaouyen13@gmail.com">
                <label for="">Email</label>
            </div>
            <div class="form-text">
                <input type="password" name="" id="passInput" value="Thaouyen@123">
                <label for="">Password</label>
            </div>

            <button type="button" id="login" value="login">Đăng nhập</button><br>
            <h5 id="quenmk">Quên mật khẩu?</h5>
            <span>Bạn chưa có tài khoản ? <a href = "/product/dangkyQTV">Đăng ký Tại đây</a></span>
        </from>
    </div>
</div>
<script>
$('#login').click(function(){ //khi nhấn vào giỏ hàng
        var Gmail = $('#user').val();
        var MatKhau = $('#passInput').val();
        var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        if(!Gmail || !MatKhau){
            alert("Vui lòng nhập đủ thông tin");  
        }
        else if (!passwordPattern.test(MatKhau)) {
            alert("Mật khẩu phải có chữ hoa, chữ thường, số, và kí tự đặc biệt.");
            return false;
        }
        else if (!filter.test(Gmail)) {
            alert("Username phải đủ tên,@,gmail.com");
            return false;
        } 
        else {
                $.ajax('/product/dangnhapQTV/checkSeller',{   
                type: 'POST',  // http method
                data: { 
                    'Gmail': Gmail,
                    'MatKhau': MatKhau,

                },  // data to submit          
                success: function (data, status, xhr) {
                   if(data==1){
                    window.open("<?php echo SITE_ROOT ?>product/kenhnguoiban?per_page=4&page=1","_self");
                    alert("Xin chào '"+Gmail+"' Bạn đăng nhập thành công");
                    }
                   else{
                    alert("Tài khoản hoặc mật khẩu không đúng");
                   }  
                }
            });
        }     
    });
</script>
<?php $this->template->display('footer.php'); ?>
</body>
</html>
