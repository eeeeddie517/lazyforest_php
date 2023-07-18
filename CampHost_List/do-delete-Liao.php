<?php

require_once("../db_connect.php");

$id=$_GET["id"];

$sql="UPDATE camp_list SET valid=0 WHERE camp_id='$id' ";

if ($conn->query($sql) === TRUE) {
    header("location: ../camphost_list-Lin.php");
} else {
    echo "刪除資料錯誤: " . $conn->error;
}