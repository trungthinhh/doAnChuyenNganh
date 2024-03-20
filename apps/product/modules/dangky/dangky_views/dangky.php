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
<?php
echo 'register'.$register;
?>
<div class="mainLayout">
        <div class="container">
            <from class = "form-login">
                <h1>Đăng kí</h1>
                <div class="form-text">
                    <input type="text" id="inputTenkh">
                <label for="myInput">Họ tên</label>  
                </div>
                <div class="form-text">
                    <input type="text" id="inputUser">
                <label for="myInput">Email</label>  
                </div>
                <div class="form-text">
                    <input type="tel" id="inputPhone">
                    <label for="pasInput">Số điện thoại</label>
                </div>      
                <div class="form-text">
                    <input type="text" id="inputAddress">
                    <label for="pasInput">Địa chỉ</label>
                </div>
                <div class="form-text">
                    <input type="Password" id="inputPassword">
                    <label for="pasInput">Password</label>
                </div>


                <button id="register">Đăng kí</button><br>
                <span>Bạn đã có tài khoản ? <a href = "http://localhost:81/product/nhap">Đăng nhập ngay</a></span>
            </from>
        </div>
</div>
<script> 
$('#register').click(function(){ //khi nhấn vào giỏ hàng
        var tenkh=$('#inputTenkh').val();
        var username = $('#inputUser').val();
        var password = $('#inputPassword').val();
        var phone = $('#inputPhone').val();
        var address = $('#inputAddress').val();
        var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
       
        if (!passwordPattern.test(password)) {
            alert("Mật khẩu phải có chữ hoa, chữ thường, số, và kí tự đặc biệt.");
            return false;
        }
        else if (!filter.test(username)) {
            alert("Username phải đủ tên,@,gmail.com");
            return false;
        }
        else if (phone.length !== 10) {
            alert("Số điện thoại phải có đúng 10 số.");
            return false;
        }
        else if(!username || !phone || !address || !password){
            alert("Vui lòng nhập đủ thông tin");  
        }
        
        else{
            $.ajax('/product/dangky/SaveAccount',{   
            type: 'POST',  // http method
            data: { 
                'tenkh':tenkh,
                'username': username,
                'phone': phone,
                'address': address,
                'password': password,
                
            },  // data to submit
            
            success: function (data, status, xhr) {
                console.log(data);
                console.log(status);
                alert("Đã tạo tài khoản thành công,Hãy chọn đăng nhập");
                window.open("<?php echo SITE_ROOT ?>product/dangnhap","_self");

            }
        });
        }
       
    });
</script>
<?php $this->template->display('footer.php'); ?>
</body>
</html>