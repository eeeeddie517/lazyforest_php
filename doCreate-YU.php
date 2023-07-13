<?php

if (!isset($_POST["camp_id"])) {
    die("請依正常管道到此頁");
}

require_once("../db_connect_camp.php");

// $id = $_POST["id"];
$camp_id = $_POST["camp_id"];
$part = $_POST["part"];
$amount = $_POST["amount"];
$image = $_POST["image"];
$price = $_POST["price"];
$description = $_POST["description"];
$now = date('Y-m-d H:i:s');

// echo "$camp_id, $part, $amount, $image, $price, $description, $now";


$sql = "INSERT INTO camps (camp_id, part, amount, image, price, description, created_at, updated_at, valid) VALUES ('$camp_id', '$part', '$amount', '$image', '$price', '$description', '$now', '$now', 1)";


// var_dump($sql);

if ($conn->query($sql) === TRUE) {

    $latestId=$conn->insert_id;
    echo "資料表 camps 新增資料完成, id 為 $latestId";
    header("location: camp-list.php");
} else {
    echo "新增資料錯誤: " . $conn->error;
}

$conn->close();
?>
