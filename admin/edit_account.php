<?php
require_once './layouts/header.php';
checkRole($_SESSION['user_info']['roles']);
require_once './layouts/sidebar.php';
?>
<?php
    $id = $_GET['id'] ?? '';
    if($id == ''){
        header("Location: ./account.php");
    }
    $sql_getdata = "SELECT * FROM user WHERE id='$id'";
    $run_query = mysqli_query($conn,$sql_getdata);

    $account = mysqli_fetch_assoc($run_query);

    $message = '';

    if(isset($_POST['edit_account'])){
        $roles_id = $_POST['roles'];
        $updated_at = time();
        $sql_update = "UPDATE `user` SET `roles`='$roles_id',`updated_at`='$updated_at' WHERE id='$id'";

        $result = mysqli_query($conn,$sql_update);
        $updated_row = mysqli_affected_rows($conn);
        if($updated_row > 0){
//            $message = 'Cập nhật thành công!';
            echo "<script>alert('Cập nhật thành công!'); location.replace('./account.php')</script>";
        }else{
            $message = 'Cập nhật thất bại!';
        }
    }
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Cập nhật quyền</h1>
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
                    <input disabled type="email" name="email" class="form-control" placeholder="Nhập Email..." required value="<?= $account['email'] ?>">
                </div>
                <div class="form-group col-6">
                    <label>Phân quyền</label>
                    <select class="custom-select roles" name="roles" required>
                        <option value="0" <?= $account['roles'] ? '' : 'selected' ?>>Cộng tác viên</option>
                        <option value="1" <?= $account['roles'] ? 'selected' : '' ?>>Quản trị cấp cao</option>
                    </select>
                </div>
                <div class="form-group col-6">
                    <span class="text-red"><?= $message ?></span>
                </div>
                <div class="form-group col-6">
                    <button type="submit" name="edit_account" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->


<?php require_once './layouts/footer.php'; ?>
