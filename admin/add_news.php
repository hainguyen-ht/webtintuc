<?php
require_once './layouts/header.php';
require_once './layouts/sidebar.php';
?>

<?php
    $message = '';
    if(isset($_POST['add_news'])){
        if (is_uploaded_file($_FILES['img']['tmp_name'])){
            $filename = $_FILES['img']['name'];
            $size = $_FILES['img']['size'];
            if ($_FILES['img']['error'] > 0){
                $message = 'Ảnh tải lên bị lỗi!';
            }else if(checkTypeImage($filename) == false){
                $message = 'Các định dạng ảnh cho phép: gif, png, jpg!';
            }else if($size > 2*1024*1024){
                $message = 'Chỉ chấp nhận ảnh nhỏ hơn 2MB';
            }else{
                $uploads = $_SERVER['DOCUMENT_ROOT'].'/WSS/webtintuc/uploads/'.$filename;
                if (!file_exists($uploads)) {
                    if(!move_uploaded_file($_FILES['img']['tmp_name'], $uploads)){
                        $message = 'Lỗi khi xử lý upload ảnh';
                        exit();
                    }
                }

                $category_id = $_POST['category'];
                $title = $_POST['title'];
                $content = $_POST['content'];
                $created_at = time();

                $sql = "INSERT INTO `news`(`category_id`,`title`, `content`, `image`, `created_at`) 
                        VALUES ('$category_id','$title','$content','$filename','$created_at')";

                $result = mysqli_query($conn,$sql);
                $insert_id = mysqli_insert_id($conn);
                if($insert_id > 0){
                    $message = 'Thêm mới thành công!';
                }else{
                    $message = 'Thêm mới thất bại!';
                }
            }
        }else{
            $message = 'Vui lòng tải ảnh lên';
        }
    }

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Đăng bài viết</h1>
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
                        <option selected>Chọn danh mục</option>
                    <?php
                        $sql_category = "SELECT * FROM category";
                        $list_category = mysqli_query($conn,$sql_category);
                        while($row = mysqli_fetch_assoc($list_category)){
                    ?>
                        <option value="<?= $row['id'] ?>"><?= $row['category_name'] ?></option>
                    <?php } ?>
                    </select>
                </div>
                <div class="form-group col-6">
                    <label>Tiêu đề tin <span class="text-red">*</span></label>
                    <input type="text" name="title" class="form-control" placeholder="Nhập tiêu đề tin" required>
                </div>
                <div class="form-group col-10">
                    <label>Nội dung tin  <span class="text-red">*</span></label>
                    <textarea class="form-control descriptions" name="content" rows="3" placeholder="Nội dung.." required></textarea>
                </div>
                <div class="form-group col-10 group__img">
                    <label>Ảnh mô tả</label>
                    <input type="file" name="img" id="image">
                </div>
                <div class="form-group col-10">
                    <span class="text-red"><?= $message ?></span>
                </div>
                <div class="form-group col-6">
                    <button type="submit" name="add_news" class="btn btn-primary">Submit</button>
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
