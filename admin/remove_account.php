<?php
session_start();
require_once '../functions/function.php';
checkRole($_SESSION['user_info']['roles']);
$id = $_GET['id'] ?? '';
if($id == ''){
    header("Location: ./account.php");
}else{
    $sql = "DELETE FROM `user` WHERE id='$id'";
    $result = mysqli_query($conn,$sql);
    $remove_row = mysqli_affected_rows($conn);
    if($remove_row > 0){
        echo "<script>
                alert('Xoá thành công!');
                location.replace('./account.php');
              </script>";
    }else{
        echo "<script>
                alert('Không có bản ghi nào được tìm thấy!');
                location.replace('./account.php');
              </script>";
    }
}
?>