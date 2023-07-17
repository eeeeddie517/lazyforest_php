<?php

if (!isset($_POST["camp_name"])) {
    die("請依正常管道到此頁");
}

require_once("../Camp_Ground/db_connect_camp-YU.php");

$camp_name = $_POST["camp_name"];
$part = $_POST["part"];
$amount = $_POST["amount"];
$image = $_FILES["image"]["name"];
$price = $_POST["price"];
$description = $_POST["description"];
$now = date('Y-m-d H:i:s');

// 根據 camp_name 在 camp_info 資料表中查找對應的 camp_id
$query = "SELECT camp_id FROM camp_info WHERE camp_name = '$camp_name'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $camp_id = $row["camp_id"];

    // 將資料插入到 camps 資料表中
    $sql = "INSERT INTO camps (camp_id, part, amount, image, price, description, created_at, updated_at, valid) VALUES ('$camp_id', '$part', '$amount', '$image', '$price', '$description', '$now', '$now', 1)";

    if ($_FILES["image"]["error"] === UPLOAD_ERR_OK) {
        $tmpFilePath = $_FILES["image"]["tmp_name"];
        $targetDirectory = 'camp_img/';
        $targetFilePath = $targetDirectory . $image;
        move_uploaded_file($tmpFilePath, $targetFilePath);
    }

    if ($conn->query($sql) === TRUE) {
        $latestId = $conn->insert_id;
        header("location:../camp_ground-LIN.php");
    } else {
        echo "新增資料錯誤: " . $conn->error;
    }
} else {
    echo "請先建立營地資訊";
}

$conn->close();

?>