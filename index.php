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

    <nav class="navbar navbar-light bg-light justify-content-between">
        <a class="navbar-brand">Home</a>
        <form class="form-inline">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </nav>

    <?php require_once './site/index.php' ?>

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