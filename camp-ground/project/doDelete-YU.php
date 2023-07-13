<?php

require("../db_connect_camp.php");

if (!isset($_GET["id"])) {
    die("無法作業");
}

$id = $_GET["id"];

$sql = "UPDATE camps SET valid=0 WHERE id='$id'";

var_dump($sql);

if ($conn->query($sql) === TRUE) {

    header("location: camp-list.php");
} else {
    echo "刪除資料錯誤: " . $conn->error;
}

?>

