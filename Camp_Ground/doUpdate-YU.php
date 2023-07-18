<?php
$id = $_POST["id"];
$part = $_POST["part"];
$amount = $_POST["amount"];
$price = $_POST["price"];
$description = $_POST["description"];
$now = date('Y-m-d H:i:s');

require_once("../db_connect.php");

$image = $_FILES["image"]["name"];
$tmpFilePath = $_FILES["image"]["tmp_name"];
$targetDirectory = 'camp_img/';
$targetFilePath = $targetDirectory . $image;


// 檢查是否有上傳新圖片
if (!empty($tmpFilePath)) {
    move_uploaded_file($tmpFilePath, $targetFilePath);
    // 若有上傳新圖片，將 $image 設為檔案名稱
} else {
    $image = $_POST["current_image"]; // 若未上傳新圖片，將圖片欄位設為當前圖片的檔案名稱
}

$sql = "UPDATE camps SET part='$part', amount='$amount', price='$price', description='$description', updated_at='$now', image='$image' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("location: camp-YU.php?id=".$id);
} else {
    echo "更新資料錯誤: " . $conn->error;
}
?>



