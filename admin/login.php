<?php
    session_start();
    if(isset($_SESSION['user_info'])){
        header("Location: ./index.php");
    }
?>
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
<?php
    $message = '';
    require_once '../functions/function.php';
    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password = md5($password);

        $sql = "SELECT id,roles FROM `user` WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($conn,$sql);

        if(mysqli_num_rows($result) == 1){
            $data = mysqli_fetch_assoc($result);

            $user_info = [
                'email' => $email,
                'roles' => $data['roles']
            ];

            $_SESSION['user_info'] = $user_info;
            header("Location: ../admin/index.php");
        }else{
            $message = 'Thông tin đăng nhập chưa đúng!';
        }
    }
?>
    <div class="app">
        <div class="auth__container">
            <div class="auth__container__box">
                <div class="auth__container__form">
                    <h1 class="auth__container__form-form__heading">Đăng nhập hệ thống</h1>
                    <div class="heading__login">
                        <form action="" method="POST">
                            <div class="form__login mt-24">
                                <div class="form-group">
                                    <label class="form-label" for="email">Email</label>
                                    <input class="form-input email" type="email" name="email" placeholder="VD: nguyenvanhai@gmail.com" required>
                                    <span class="form-message error-1"></span>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="password">Mật khẩu</label>
                                    <input id="fPass" class="form-input password" type="password" name="password"  placeholder="Nhập mật khẩu" required>
                                    <span class="password-hide"><i onclick=hidePass() class="far fa-eye-slash" id="eHide"></i></span>
                                    <span class="form-message error-2"></span>
                                </div>
                                <p><?= $message ?></p>
                                <button type="submit" name="login" class="btn btn-login">
                                    <span class="text-btn">Đăng nhập</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/js/jquery-3.5.1.min.js"></script>
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
</body>
</html>