<?php
require_once("../db_connect.php");
if (!isset($_GET["category_id"])) {
    die("無法作業");
}
$id = $_GET["category_id"];
// echo $id;
$sql = "UPDATE db SET valid=1   WHERE category_id='$id'  ";



if ($conn->query($sql) === TRUE) {
    header("location: ../category_list-LIN.php");
} else {
    echo "刪除資料錯誤: " . $conn->error;
}
$conn->close();
