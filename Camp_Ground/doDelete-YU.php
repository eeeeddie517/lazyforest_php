<?php

require_once("../db_connect.php");

if (!isset($_GET["id"])) {
    die("無法作業");
}

$id = $_GET["id"];

$sql = "UPDATE camps SET valid=0 WHERE id='$id'";

var_dump($sql);

if ($conn->query($sql) === TRUE) {

    header("location:../camp_ground-LIN.php");
} else {
    echo "刪除資料錯誤: " . $conn->error;
}

?>

