<?php
// if (!isset($_POST["name"])) {
//     die("請依正常管道進入");
// }
require_once("../db_connect.php");
$name = $_POST["updateName"];
$id = $_POST["id"];
// echo $name;
// var_dump($_POST);

$sql = "UPDATE db SET category_name='$name' WHERE category_id='$id' ";

// var_dump($sql);
if ($conn->query($sql) === TRUE) {

    // echo "新增類別成功";
    header("location: ../category_list-LIN.php");
} else {
    echo "新增類別錯誤: " . $conn->error;
}
$conn->close();
