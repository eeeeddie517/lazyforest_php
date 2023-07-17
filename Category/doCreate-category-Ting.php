<?php
if (!isset($_POST["name"])) {
    die("請依正常管道進入");
}
if (empty($_POST["name"])) {
    die("類別名稱不可空白");
}

require_once("./db_connect_camp-YU.php");
$name = $_POST["name"];
$sql = "INSERT INTO db (category_name,valid)
VALUES ('$name',1) ";

if ($conn->query($sql) === TRUE) {

    // echo "新增類別成功";
    header("location: ../category_list-LIN.php");
} else {
    echo "新增類別錯誤: " . $conn->error;
}
$conn->close();
