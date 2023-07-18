<?php
if (!isset($_POST["brand_name"])) {
    header("location: 404.php");
}

require_once("../db_connect.php");



    $brand_name = $_POST["brand_name"];
    $brand_intro = $_POST["brand_intro"];

    $brand_logo = $_FILES["brand_logo"]["name"];
    $brand_logo_tmp = $_FILES["brand_logo"]["tmp_name"];
    move_uploaded_file($brand_logo_tmp, "brand_logo/" . $brand_logo);

    $brand_img = $_FILES["brand_img"]["name"];
    $brand_img_tmp = $_FILES["brand_img"]["tmp_name"];
    move_uploaded_file($brand_img_tmp, "brand_img/" . $brand_img);

    // $brand_logo = $_POST["brand_logo"];
    // $brand_img = $_POST["brand_img"];

    $sql = "INSERT INTO brand_info (brand_name, brand_intro, brand_logo, brand_img, valid) VALUES ('$brand_name', '$brand_intro', '$brand_logo', '$brand_img', 1)";


    if ($conn->query($sql) === TRUE) {
        // $latestId = $conn->insert_id;
        // echo "新增資料完成";
        header("location: ../brand-LIN.php");
    } else {
        echo "新增資料錯誤 : " . $conn->error;
    }


$conn->close();