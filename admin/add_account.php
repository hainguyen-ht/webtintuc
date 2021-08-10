<?php
require_once './layouts/header.php';
checkRole($_SESSION['user_info']['roles']);
require_once './layouts/sidebar.php';

?>

<?php
$message = '';
if(isset($_POST['add_account'])){
    $email = $_POST['email'];
    if($checkEmail($email)){
        $password = md5($_POST['password']);
        $roles_id = $_POST['roles'];
        $created_at = time();
        $sql = "INSERT INTO `user`(`email`,`password`,`roles`,`created_at`) VALUES ('$email','$password','$roles_id','$created_at')";

        $result = mysqli_query($conn,$sql);
        $insert_id = mysqli_insert_id($conn);
        if($insert_id > 0){
            $message = 'Thêm mới thành công!';
        }else{
            $message = 'Thêm mới thất bại!';
        }
    }else{
        $message = 'Email đã tồn tại!';
    }

}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Thêm mới danh mục</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="./account.php">Quay lại danh sách</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="content-fluid">

            <form action="" method="post">
                <div class="form-group col-6">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Nhập Email..." required>
                </div>
                <div class="form-group col-6">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu..." required>
                </div>
                <div class="form-group col-6">
                    <label>Phân quyền</label>
                    <select class="custom-select roles" name="roles" required>
                        <option value="0">Cộng tác viên</option>
                        <option value="1">Quản trị cấp cao</option>
                    </select>
                </div>
                <div class="form-group col-6">
                    <span class="text-red"><?= $message ?></span>
                </div>
                <div class="form-group col-6">
                    <button type="submit" name="add_account" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->


<?php require_once './layouts/footer.php'; ?>
