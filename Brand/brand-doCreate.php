<?php

if (!isset($_POST["brand_name"])) {
    die("請依正常管道前往此頁");
}

require_once("../db-connect.php");

$brand_name = $_POST["brand_name"];
$brand_intro = $_POST["brand_intro"];

$brand_logoName = $_FILES['brand_logo']['name'];
$brand_logoTmpName = $_FILES['brand_logo']['tmp_name'];
$brand_logoError = $_FILES['brand_logo']['error'];

$brand_imgName = $_FILES['brand_img']['name'];
$brand_imgTmpName = $_FILES['brand_img']['tmp_name'];
$brand_imgError = $_FILES['brand_img']['error'];

// $brand_logo = $_POST["brand_logo"];
// $brand_img = $_POST["brand_img"];

if ($brand_logoError === UPLOAD_ERR_OK && $brand_imgError === UPLOAD_ERR_OK) {
    // 将图像文件从临时位置移动到目标目录
    $brand_logo = "../brand_img" . basename($brand_logoName);
    move_uploaded_file($brand_logoTmpName, $brand_logo);

    $brand_img = "../brand_img" . basename($brand_imgName);
    move_uploaded_file($brand_imgTmpName, $brand_img);



$sql = "INSERT INTO brand_info (brand_name, brand_intro, brand_logo, brand_img, valid)
VALUES ('$brand_name', '$brand_intro', '$brand_logo', '$brand_img', 1)";

// echo $sql;

if ($conn->query($sql) === TRUE) { 
    $latestId = $conn->insert_id;
    echo "新增資料完成";
    header("location: brand-list.php");

} else {
echo "新增資料錯誤 : " . $conn->error;
}
}

$conn->close();