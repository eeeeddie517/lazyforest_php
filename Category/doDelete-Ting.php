<?php
require_once("./db_connect_camp-YU.php");
if (!isset($_GET["id"])) {
    die("無法作業");
}

$id = $_GET["id"];
echo $id;


$sql = "UPDATE db SET valid=0 WHERE category_id='$id'";

if ($conn->query($sql) === TRUE) {
    header("location:../category_list-LIN.php");
} else {
    echo "刪除資料錯誤: " . $conn->error;
}
$conn->close();
