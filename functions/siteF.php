<?php
    require_once './database/db.php';

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

    function isSeenNews($news_id){
        if(isset($_COOKIE['seen'.$news_id])){
            return true;
        }
        return false;
    }
?>