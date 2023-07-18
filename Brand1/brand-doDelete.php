<?php

if(!isset($_GET["brand_id"])) {
    die("無法作業");
}

require_once("../db_connect.php");

$brand_id = $_GET["brand_id"];
// echo $id;

$sql = "UPDATE brand_info SET valid = 0 WHERE brand_id = '$brand_id'";

if ($conn->query($sql) === TRUE) { 
    
    header("location: ../brand-LIN.php");

} else {
echo "刪除資料失敗 : " . $conn->error;
}