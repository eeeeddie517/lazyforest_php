<?php

require_once("../db-connect.php");

$brand_id = $_POST["brand_id"];

if ($_FILES["file"]["error"] == 0) {
    if (move_uploaded_file($_FILES["brand_logo"]["tmp_name"], "../Product Image/" . $_FILES["file"]["name"])) {

        $filename = $_FILES["file"]["name"];
        echo "上傳成功, 檔名為" . $filename;

        $sql = "INSERT INTO product_images (product_id, name)
        VALUES ('$product_id', '$filename')";

        if ($conn->query($sql) === TRUE) {

            header("location: product-picture.php");
        } else {
            echo "新增資料錯誤 : " . $conn->error;
        }
    } else {
        echo "上傳失敗";
    }
} else {
    var_dump($_FILES["file"]["error"]);
}
