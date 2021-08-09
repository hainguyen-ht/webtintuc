<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- <link rel="stylesheet" href="assets/fonts/all.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <title>Đăng nhập</title>
</head>
<body>
<div class="app">
    <div class="auth__container">
        <div class="auth__container__box">
            <div class="auth__container__form">
                <h1 class="auth__container__form-form__heading">Đăng nhập hệ thống</h1>
                <div class="heading__login">
                    <div class="form__login mt-24">
                        <div class="form-group">
                            <label class="form-label" for="email">Email</label>
                            <input class="form-input" type="text" name="email" placeholder="VD: nguyenvanhai@gmail.com">
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="password">Mật khẩu</label>
                            <input id="fPass" class="form-input" type="password" name="password"  placeholder="Nhập mật khẩu">
                            <span class="password-hide"><i onclick=hidePass() class="far fa-eye-slash" id="eHide"></i></span>
                            <span class="form-message"></span>
                        </div>
                        <button class="btn btn-login">
                            <span class="text-btn">Đăng nhập</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var ePass = document.getElementById('fPass')
    var eHide = document.getElementById('eHide');

    var hidePass = function(){
        var status  = ePass.type;

        if(status === 'text'){
            ePass.type = 'password'
            eHide.className = 'far fa-eye-slash'
        }else{
            ePass.type = 'text'
            eHide.className = 'far fa-eye'
        }
    }
</script>
<script src="../assets/js/jquery-3.5.1.min.js"></script>
</body>
</html>