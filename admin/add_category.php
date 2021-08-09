<?php
require_once './layouts/header.php';
require_once './layouts/sidebar.php';
?>

<?php
    $message = '';
    if(isset($_POST['add_category'])){
        $category_name = $_POST['category_name'];
        $created_at = time();
        $sql = "INSERT INTO `category`(`category_name`, `created_at`) VALUES ('$category_name','$created_at')";

        $result = mysqli_query($conn,$sql);
        $insert_id = mysqli_insert_id($conn);
        if($insert_id > 0){
            $message = 'Thêm mới thành công!';
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
                        <li class="breadcrumb-item"><a href="./category.php">Quay lại danh sách</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="content-fluid">

            <form action="" method="post">
                <div class="form-group col-6">
                    <label for="exampleInputEmail1">Tên danh mục</label>
                    <input type="text" name="category_name" class="form-control" placeholder="Nhập tên danh mục" required>
                    <?= $message; ?>
                </div>

                <div class="form-group col-6">

                    <button type="submit" name="add_category" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->


<?php require_once './layouts/footer.php'; ?>
