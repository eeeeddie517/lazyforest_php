<?php

require_once("../db-connect-CH.php");

$id = $_POST["id"];
$input_product_name = $_POST["input_product_name"];
$input_product_category = $_POST["input_product_category"];
$input_product_introduce = $_POST["input_product_introduce"];
$input_product_spec = $_POST["input_product_spec"];
$input_product_price = $_POST["input_product_price"];
$input_product_amount = $_POST["input_product_amount"];
$input_product_img = $_FILES["input_product_img"];


if($input_product_img["error"]==0) {
    if(move_uploaded_file($_FILES["input_product_img"]["tmp_name"], "../images-CH/".$_FILES["input_product_img"]["name"])){
        $input_product_img_name = $input_product_img["name"];

        $sqlUpdate = "UPDATE product_info SET product_name = '$input_product_name', category_id = '$input_product_category',product_introduce = '$input_product_introduce', product_spec = '$input_product_spec', product_price = '$input_product_price', product_img = '$input_product_img_name',product_amount = '$input_product_amount' WHERE id = $id";

        if ($conn->query($sqlUpdate) === TRUE) {
            $response = array("success" => true, "message" => "成功");
     
        } else {
            $response = array("success" => false, "message" => "失敗");
        }

        echo json_encode($response);
    }
}
else{
    var_dump($product_img["error"]);
}
?>