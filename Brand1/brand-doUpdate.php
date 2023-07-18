<?php
$brand_id = $_POST["brand_id"];
$brand_name = $_POST["brand_name"];
$brand_intro = $_POST["brand_intro"];
$brand_logo = $_POST["brand_logo"];
$brand_img = $_POST["brand_img"];


require_once("../db_connect.php");

$sql = "UPDATE brand_info SET brand_name='$brand_name', brand_intro='$brand_intro', brand_logo='$brand_logo', brand_img='$brand_img' WHERE brand_id=$brand_id";


if ($conn->query($sql) === TRUE) {
    header("location: brand-edit.php?brand_id=" . $brand_id);
} else {
    echo "修改資料錯誤: " . $conn->error;
}
