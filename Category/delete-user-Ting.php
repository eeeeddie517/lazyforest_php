<?php
require_once("db_connect-Ting.php");

$id = $_GET["id"];
// echo $id;
$sql = "DELETE  FROM db WHERE category_id='$id'";

if ($conn->query($sql) === TRUE) {
    header("location:category-list-Ting.php");
} else {
    echo "刪除類別錯誤: " . $conn->error;
}
$conn->close();
