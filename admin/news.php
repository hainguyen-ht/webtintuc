<?php
require_once './layouts/header.php';
require_once './layouts/sidebar.php';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Quản lý bài viết</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <?php if($_SESSION['user_info']['roles'] == 1){ ?>
                        <li class="breadcrumb-item"><a href="./add_news.php">Thêm mới</a></li>
                        <?php } ?>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="content-fluid">
            <table class="table text-center">
                <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Tiêu đề tin</th>
                    <th scope="col">Nội dung</th>
                    <th scope="col">Danh mục</th>
                    <th scope="col">Ảnh mô tả</th>
                    <th scope="col">Ngày đăng</th>
                    <th scope="col">Cập nhật</th>
                    <th scope="col">Hành động</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT * FROM `news` ORDER BY `updated_at` DESC, `id` DESC";
                $result = mysqli_query($conn, $sql);
                $i = 0;
                while ($row = mysqli_fetch_assoc($result)){
                    ?>
                    <tr>
                        <th scope="row"><?= ++$i; ?></th>
                        <td><?= replaceString($row['title'],6) ?></td>
                        <td><?= replaceString($row['content'],8) ?></td>
                        <td><?= $getCategory($row['category_id']) ?></td>
                        <td>
                            <img src="<?= ($row['image']) ? base_url().'/uploads/'.$row['image'] : 'Chưa có ảnh' ?>" width="70">
                        </td>
                        <td><?= date("H:i:s d-m-Y",$row['created_at']) ?></td>
                        <td><?= ($row['updated_at']) ? date("H:i:s d-m-Y",$row['updated_at']) : 'Chưa cập nhật' ?></td>
                        <td>
                        <?php if($_SESSION['user_info']['roles'] == 1){ ?>
                            <a href="./edit_news.php?id=<?= $row['id'] ?>"><i class="fas fa-edit"></i></a>&emsp;
                            <a href="./remove_news.php?id=<?= $row['id'] ?>" onclick="return confirm('Bạn muốn xoá tin này chứ?')"><i class="fas fa-trash text-red"></i></a>
                        <?php }else{ ?>
                                <label><i class="fas fa-edit"></i></label>
                                <label><i class="fas fa-trash"></i></label>
                        <?php } ?>
                        </td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->
<?php require_once './layouts/footer.php'; ?>
