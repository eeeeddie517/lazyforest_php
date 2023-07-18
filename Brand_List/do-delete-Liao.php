<?php

require_once("../db_connect.php");

$id=$_GET["id"];

$sql="UPDATE brand SET valid=0 WHERE brand_id='$id' ";

if ($conn->query($sql) === TRUE) {
    header("location:../brand_list-Lin.php");
} else {
    echo "刪除資料錯誤: " . $conn->error;
}