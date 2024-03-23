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
<div class="mainLayout">
        <div class="container">
        <from class = "form-login">
            <h1>Đăng nhập</h1>
            <div class="form-text">
                <input type="text" id="user" value="thinh13@gmail.com">
               <label for="myInput">Username</label>
              
            </div>

            <div class="form-text">
                <input type="Password" id="passInput" value="Thinh@123">
                <label for="pasInput">Password</label>
            </div>

            <button id="login">Đăng nhập</button><br>
            <h5>Quên mật khẩu?</h5>
            <span>Bạn chưa có tài khoản ? <a href = "http://localhost:81/product/dangky">Đăng ký Tại đây</a></span>
        </from>
    </div>
</div>
<script> 

$('#login').click(function(){ //khi nhấn vào giỏ hàng
        var username = $('#user').val();
        var password = $('#passInput').val();
        var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        // if(!username || !password){
        //     alert("Vui lòng nhập đủ thông tin");  
        // }
        //else
        //  if (!passwordPattern.test(password)) {
        //     alert("Mật khẩu phải có chữ hoa, chữ thường, số, và kí tự đặc biệt.");
        //     return false;
        // }
        // else if (!filter.test(username)) {
        //     alert("Username phải đủ tên,@,gmail.com");
        //     return false;
        // } 
        // else {
                $.ajax('/product/dangnhap/checkUser',{   
                type: 'POST',  // http method
                data: { 
                    'username': username,
                    'pass': password,

                },  // data to submit
            
                success: function (data, status, xhr) {
                    // console.log(data);
                   //alert(data);
                   if(data==1){
                    window.open("<?php echo SITE_ROOT ?>product/dathang","_self");
                   }
                   else{
                    alert("Tài khoản hoặc mật khẩu không đúng");
                   }
                    
                
                }
            });
        //}     
        // console.log(color);
       
    });
</script>
<?php $this->template->display('footer.php'); ?>
</body>
</html>
