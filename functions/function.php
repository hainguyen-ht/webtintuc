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


?>