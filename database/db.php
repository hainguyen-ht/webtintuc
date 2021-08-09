<?php
define('TIMEZONE', 'Asia/Ho_Chi_Minh');
date_default_timezone_set(TIMEZONE);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbtintuc";

$conn = new mysqli($servername, $username, $password,$dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>