<?php
    require_once './layouts/header.php';
    require_once './layouts/sidebar.php';
?>
<?php
    $id = $_GET['id'] ?? '';
    if($id == ''){
        header("Location: ./news.php");
    }
    $sql_getdata = "SELECT * FROM news WHERE id='$id'";
    $run_query = mysqli_query($conn,$sql_getdata);
    $news = mysqli_fetch_assoc($run_query);
    $message = '';

    if(isset($_POST['edit_news'])){
        $category_id    = $_POST['category'];
        $title          = $_POST['title'];
        $content        = $_POST['content'];
        $updated_at = time();

        $sql_update = "UPDATE `news` SET `category_id`='$category_id',`title`='$title',
                                `content`='$content',`updated_at`='$updated_at' WHERE id='$id'";

        if (is_uploaded_file($_FILES['img']['tmp_name'])) {
            $filename = $_FILES['img']['name'];
            $size = $_FILES['img']['size'];
            if ($_FILES['img']['error'] > 0) {
                $message = 'Ảnh tải lên bị lỗi!';
            } else if (checkTypeImage($filename) == false) {
                $message = 'Các định dạng ảnh cho phép: gif, png, jpg!';
            } else if ($size > 2 * 1024 * 1024) {
                $message = 'Chỉ chấp nhận ảnh nhỏ hơn 2MB';
            } else {
                $uploads = $_SERVER['DOCUMENT_ROOT'].'/WSS/webtintuc/uploads/'.$filename;
                if (!file_exists($uploads)) {
                    if(!move_uploaded_file($_FILES['img']['tmp_name'], $uploads)){
                        $message = 'Lỗi khi xử lý upload ảnh';
                        exit();
                    }
                }
                $sql_update = "UPDATE `news` SET `category_id`='$category_id',`title`='$title',
                                `content`='$content',`updated_at`='$updated_at',`image`='$filename' WHERE id='$id'";
            }
        }

        $result = mysqli_query($conn,$sql_update);
        $updated_row = mysqli_affected_rows($conn);
        if($updated_row > 0){
            $message = 'Cập nhật thành công!';
        }else{
            $message = 'Cập nhật thất bại';
        }
    }
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Sửa tin đăng</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="./news.php">Quay lại danh sách</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="content-fluid">
            <form action="" method="post" enctype="multipart/form-data" id="form-news">
                <div class="form-group col-6">
                    <label>Danh mục <span class="text-red">*<span class="er-c"></span></span></label>
                    <select class="custom-select category" name="category" required>
                        <option disabled>Chọn danh mục</option>
                    <?php
                        $sql_category = "SELECT * FROM category";
                        $list_category = mysqli_query($conn,$sql_category);
                        while($row = mysqli_fetch_assoc($list_category)){
                    ?>
                            <option value="<?= $row['id'] ?>" <?= ($row['id'] == $news['category_id']) ? 'selected' : '' ?>><?= $row['category_name'] ?></option>
                    <?php } ?>
                    </select>
                </div>
                <div class="form-group col-6">
                    <label>Tiêu đề tin <span class="text-red">*</span></label>
                    <input type="text" name="title" value="<?= $news['title'] ?>" class="form-control" placeholder="Nhập tiêu đề tin" required>
                </div>
                <div class="form-group col-10">
                    <label>Nội dung tin  <span class="text-red">*</span></label>
                    <textarea class="form-control descriptions" name="content" rows="3" placeholder="Nội dung.." required><?= $news['content'] ?></textarea>
                </div>
                <div class="form-group col-10 group__img">
                    <label>Ảnh mô tả</label>
                    <input type="file" name="img" id="image">
                </div>
                <div class="form-group col-10">
                    <span class="text-red"><?= $message ?></span>
                </div>
                <div class="form-group col-6">
                    <button type="submit" name="edit_news" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->


<?php require_once './layouts/footer.php'; ?>
<script>
    $("#form-news").on('submit', function (){
        var category = $('.category').val();
        if(category == 'Chọn danh mục' || category == ''){
            $('.er-c').html('Vui lòng chọn danh mục!');
            event.preventDefault();
        }else{
            $('.er-c').empty();
        }

    })

</script>