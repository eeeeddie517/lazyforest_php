<?php

$id = $_POST["id"];
$part=$_POST["part"];
$amount=$_POST["amount"];
$image=$_POST["image"];
$price=$_POST["price"];
$description=$_POST["description"];

require_once("../db_connect_camp.php");



$sql="UPDATE camps SET part='$part', amount='$amount', image='$image', price='$price', description='$description' WHERE id=$id";


if ($conn->query($sql) === TRUE) {
    header("location: camp-edit.php?id=".$id);

} else {
	echo "新增資料錯誤: " . $conn->error;
}

