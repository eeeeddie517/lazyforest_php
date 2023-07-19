<?php

require_once("../db_connect.php");

$brand_id = $_POST["brand_id"];

$brand_name = $_POST["brand_name"];
$brand_intro = $_POST["brand_intro"];

$brand_logo = $_FILES["brand_logo"]["name"];
$brand_logo_tmp = $_FILES["brand_logo"]["tmp_name"];
$brand_logo_folder = "brand_logo/";

$brand_img = $_FILES["brand_img"]["name"];
$brand_img_tmp = $_FILES["brand_img"]["tmp_name"];
$brand_img_folder = "brand_img/";

if (!empty($brand_logo_tmp)) {
    move_uploaded_file($brand_logo_tmp, $brand_logo_folder.$brand_logo);
    $brand_logo_path = $brand_logo_folder.$brand_logo;
} else {
   
    $brand_logo_path = $_POST["original_brand_logo"];
}


if (!empty($brand_img_tmp)) {
    move_uploaded_file($brand_img_tmp, $brand_img_folder.$brand_img);
    $brand_img_path = $brand_img_folder.$brand_img;
} else {
   
    $brand_img_path = $_POST["original_brand_img"];
}

$sql = "UPDATE brand_info SET brand_name='$brand_name', brand_intro='$brand_intro', brand_logo='$brand_logo', brand_img='$brand_img' WHERE brand_id=$brand_id";

// echo $sql;
if ($conn->query($sql) === TRUE) {
    header("location:brand.php?brand_id=" . $brand_id);
} else {
    echo "修改資料錯誤: " . $conn->error;
}

$conn->close();
?>