<?php

require_once("../db_connect.php");


$id=$_POST["id"];
$name=$_POST["name"];
$account=$_POST["account"];
$phone=$_POST["phone"];
$city=$_POST["city"];
$now=date('Y-m-d H:i:s');


$sql="UPDATE member_list SET user_name='$name', user_email='$account', user_phone='$phone',user_city='$city' WHERE user_id=$id";

// var_dump($sql);

if ($conn->query($sql) === TRUE) {
   header("location:member-detail-Liao.php?id=$id");
    $TimeSql="UPDATE member_list SET update_at='$now' WHERE user_id=$id ";
    $conn->query($TimeSql);
} else {
    echo "修改資錯誤: " . $conn->error;
}