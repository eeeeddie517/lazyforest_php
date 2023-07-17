<?php

if(!isset($_GET["camp_id"])){
   die("無法作業"); 
}
require_once("./Camp_Ground/db_connect_camp-YU.php");

$camp_id=$_GET["camp_id"];

$sql="UPDATE camp_info SET valid=0 WHERE camp_id = '$camp_id'";



if ($conn->query($sql) === TRUE) {
    header("location: ../camp_info-LIN.php");

} else {
    echo "刪除資料錯誤: " . $conn->error;
}

