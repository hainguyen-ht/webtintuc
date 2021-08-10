<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <title>Chi tiết tin</title>
    <style>
        .content{
            padding-bottom: 20px;
            margin-top: 20px;
        }
        .time{
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <?php
        require_once './functions/siteF.php';
        $id = $_GET['news_id'] ?? '';
        if($id == ''){
            header("Location: ./index.php");
        }else{
            setcookie('seen'.$id,$id,time() + 86400,'/');
            $sql = "SELECT * FROM news WHERE id='$id'";
            $result = mysqli_query($conn,$sql);
            if(mysqli_num_rows($result) == 1){
                $data = mysqli_fetch_assoc($result);
            }else{
                echo "<script>alert('Không tìm thấy tin!');location.replace('./index.php')</script>";
            }
        }

    ?>
    <nav class="navbar navbar-light bg-light justify-content-between">
        <a class="navbar-brand" href="./index.php">Home</a>
    </nav>
    <div class="content container-fluid text-center">
        <h1><?= $data['title'] ?></h1>
        <p>Danh mục: <?= $getCategory($data['category_id']) ?></p>
        <img
            src="./uploads/<?= $data['image'] ?>"
            onerror="this.onerror=null;this.src='https://cellphones.com.vn/sforum/wp-content/uploads/2018/11/3-8.png';"
            alt="">
        <p class="mt-3"><?= $data['content'] ?></p>
        <div class="time font-italic font-weight-bold">
            <div class="created_at">Ngày đăng: <?= date("H:i:s, d-m-Y",$data['created_at']) ?></div>
            <div class="updated_at">Cập nhật: <?= $data['created_at'] ? date("H:i:s, d-m-Y",$data['created_at']) : 'Chưa cập nhật' ?></div>
        </div>
    </div>
    <footer>
        <div class="card text-center">
            <div class="card-header">
                Footer
            </div>
        </div>
    </footer>
    <script src="./assets/js/bootstrap.min.js"></script>
</body>
</html>