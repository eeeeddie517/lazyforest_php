<?php

require_once("../db_connect.php");

$id=$_GET["id"];

$sql="UPDATE member_list SET valid=0 WHERE user_id='$id' ";

if ($conn->query($sql) === TRUE) {
    header("location: ../member_list-LIN.php");
} else {
    echo "刪除資料錯誤: " . $conn->error;
}