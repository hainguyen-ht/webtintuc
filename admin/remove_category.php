<?php
    require_once '../functions/function.php';
    $id = $_GET['id'] ?? '';
    if($id == ''){
        header("Location: ./category.php");
    }else{
        $sql = "DELETE FROM `category` WHERE id='$id'";
        $result = mysqli_query($conn,$sql);
        $remove_row = mysqli_affected_rows($conn);
        if($remove_row > 0){
            echo "<script>
                    alert('Xoá thành công!');
                    location.replace('./category.php');
                  </script>";
        }else{
            echo "<script>
                    alert('Không có bản ghi nào được tìm thấy!');
                    location.replace('./category.php');
                  </script>";
        }
    }
?>