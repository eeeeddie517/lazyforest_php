<?php

require_once("../db_connect.php");

$product_name = $_POST["product_name"];
$product_introduce = $_POST["product_introduce"];
$product_spec = $_POST["product_spec"];
$product_price = $_POST["product_price"];
$product_serial = $_POST["product_serial"];
$product_amount = $_POST["product_amount"];
$product_img = $_FILES["product_img"];
$now = date('Y-m-d H:i:s');


if($product_img["error"]==0) {
    if(move_uploaded_file($_FILES["product_img"]["tmp_name"], "images-CH/".$_FILES["product_img"]["name"])){
        $product_img_name = $product_img["name"];

        //INSERT　INTO (table的名稱) (......) VALUES(寫進去的值) (......) (valid要在這邊對照成1 不然不會顯示出來)

        $sql = "INSERT INTO product_info (product_name, product_introduce, product_spec, product_price, product_serial, product_amount, product_img, created_at, updated_at, valid) VALUES ('$product_name', '$product_introduce', '$product_spec', '$product_price', '$product_serial', '$product_amount', '$product_img_name', '$now', '$now', '1')";

        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id; //取得最新一筆資料(insert_id:當執行 INSERT 語句時，這個成員函數傳回新插入行的ID。)
            $response = array("success" => true, "message" => "上傳成功,檔名為" . $product_img_name, "id" => $last_id);
        } else {
            $response = array("success" => false, "message" => "上傳失敗");

        }
        echo json_encode($response);
        $conn -> close();

    }else{
        $response = array("success" => false, "error" => $product_img["error"]);
        echo json_encode($response);
    }
}else{
    var_dump($product_img["error"]);
}

