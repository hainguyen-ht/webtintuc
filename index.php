<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <title>Site</title>
    <style>
        .content{
            padding-bottom: 20px;
        }
    </style>
</head>
<body>
    <?php
        require_once './functions/siteF.php';
        $sql = "SELECT * FROM news ORDER BY id DESC";
        $key = '';
        if(isset($_GET['key'])){
            $key = $_GET['key'];
            $sql = "SELECT * FROM news WHERE title LIKE '%$key%' ORDER BY id DESC";
        }
        $result = mysqli_query($conn, $sql);
    ?>
    <nav class="navbar navbar-light bg-light justify-content-between">
        <a class="navbar-brand" href="./index.php">Home</a>
        <form class="form-inline" method="get" action="">
            <input value="<?= $key ?>" class="form-control mr-sm-2" type="search" name="key" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </nav>
    <div class="content container-fluid">
        <div class="row">
            <?php
            if(mysqli_num_rows($result) == 0){
                echo "Không có dữ liệu!";
            }else{
                while($row = mysqli_fetch_assoc($result)){?>
                <div class="col-3 mt-4">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top"
                             height="200"
                             onerror="this.onerror=null;this.src='https://cellphones.com.vn/sforum/wp-content/uploads/2018/11/3-8.png';"
                             src="./uploads/<?= $row['image'] ?>">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="./detail.php?news_id=<?= $row['id'] ?>"><?= replaceString($row['title'],8) ?></a>
                            </h5>
                            <p class="text-right text-info">Danh mục: <?= $getCategory($row['category_id']) ?></p>
                            <p class="card-text"><?= replaceString($row['content'],20) ?></p>
                            <a href="./detail.php?news_id=<?= $row['id'] ?>" class="btn btn-primary"><?= isSeenNews($row['id']) ? 'Đã xem' : 'Xem Ngay' ?></a>
                        </div>
                    </div>
                </div>
            <?php }} ?>
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