<?php
require_once './layouts/header.php';
require_once './layouts/sidebar.php';
?>
<?php
    $id = $_GET['id'] ?? '';
    if($id == ''){
        header("Location: ./category.php");
    }
    $sql_getdata = "SELECT * FROM category WHERE id='$id'";
    $run_query = mysqli_query($conn,$sql_getdata);

    $category = mysqli_fetch_assoc($run_query);
    $category_name = $category['category_name'];
    $message = '';

    if(isset($_POST['edit_category'])){
        $category_name = $_POST['category_name'];
        $updated_at = time();
        $sql_update = "UPDATE `category` SET `category_name`='$category_name',`updated_at`='$updated_at' WHERE id='$id'";

        $result = mysqli_query($conn,$sql_update);
        $updated_row = mysqli_affected_rows($conn);
        if($updated_row > 0){
            $message = 'Cập nhật thành công!';
        }
    }
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Cập nhật danh mục</h1>
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
                    <input type="text" name="category_name" class="form-control" placeholder="Nhập tên danh mục" required value="<?= $category_name ?>">
                    <?= $message; ?>
                </div>

                <div class="form-group col-6">

                    <button type="submit" name="edit_category" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->


<?php require_once './layouts/footer.php'; ?>
