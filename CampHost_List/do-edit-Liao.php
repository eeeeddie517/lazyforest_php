<?php

require_once("../db_connect.php");


$id=$_POST["id"];
$name=$_POST["name"];
$account=$_POST["account"];
$phone=$_POST["phone"];
$vat=$_POST["vat"];
$now=date('Y-m-d H:i:s');


$sql="UPDATE camp_list SET camp_hostName='$name',camp_email='$account',camp_phone='$phone',camp_vat='$vat' WHERE camp_id=$id";

// var_dump($sql);

if ($conn->query($sql) === TRUE) {
    header("location:camp-detail-Liao.php?id=$id");
    $TimeSql="UPDATE camp_list SET update_at='$now' WHERE camp_id=$id ";
    $conn->query($TimeSql);
    
} else {
    echo "修改資錯誤: " . $conn->error;
}