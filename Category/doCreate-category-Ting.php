<?php
if (!isset($_POST["name"])) {
    die("請依正常管道進入");
}
if (empty($_POST["name"])) {
    die("類別名稱不可空白");
}

require_once("db_connect-Ting.php");
$name = $_POST["name"];
$sql = "INSERT INTO db (category_name,valid)
VALUES ('$name',1) ";
$sqlname = "SELECT * FROM db WHERE category_name = '$name' ";
$result = $conn->query($sqlname);

if ($result->num_rows > 0) {
    echo "該種類已存在，請不要重複新增。";
} elseif ($conn->query($sql) === TRUE) {

    // echo "新增類別成功";
    header("location:category-list-Ting.php");
} else {
    echo "新增類別錯誤: " . $conn->error;
}


$conn->close();
