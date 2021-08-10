<?php
    require_once '../database/db.php';

    function base_url(){
        return 'http://localhost/WSS/webtintuc';
    }

    function checkTypeImage($filename){
        $allowed = ['gif', 'png', 'jpg'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $ext = strtolower($ext);
        if (in_array($ext, $allowed)) {
            return true;
        }
        return false;
    }

    function replaceString($str,$num){
        $count = 0;
        for($i = 0; $i < strlen($str); $i++){
            if($count == $num){
                $str = substr($str,0,$i);
                break;
            }
            if($str[$i] == ' '){
                $count++;
            }
        }
        return trim($str).'...';
    }

    $getCategory = function ($cate_id) use($conn){
        if($cate_id == 0){
            return 'Chưa phân loại';
        }
        $sql = "SELECT * FROM category WHERE id = '$cate_id'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            $category = mysqli_fetch_assoc($result);
            $name = $category['category_name'];
            return $name;
        }else{
            return 'Chưa phân loại';
        }

    };

    function getRoles($roles_id){
        $arr_roles = [
            1 => 'Quản trị cấp cao',
            0 => 'Cộng tác viên'
        ];
        return $arr_roles[$roles_id];
    }

    $checkEmail = function ($email) use($conn){
        $sql = "SELECT * FROM user WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        $check = mysqli_num_rows($result);
        if($check > 0){
            return false;
        }
        return true;
    };

    function checkRole($roles_id){
        if($roles_id == 0){
            header("Location: ./index.php");
        }
    }

?>