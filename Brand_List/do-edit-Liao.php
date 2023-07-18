<?php

require_once("../db_connect.php");


$id=$_POST["id"];
$name=$_POST["name"];
$account=$_POST["account"];
$address=$_POST["address"];
$phone=$_POST["phone"];
$vat=$_POST["vat"];
$now=date('Y-m-d H:i:s');


$sql="UPDATE brand SET brand_hostName='$name',brand_email='$account',brand_address='$address',brand_phone='$phone',brand_vat='$vat' WHERE brand_id=$id";

// var_dump($sql);

if ($conn->query($sql) === TRUE) {
    header("location:brand-detail-Liao.php?id=$id");
    $TimeSql="UPDATE brand SET update_at='$now' WHERE brand_id=$id ";
    $conn->query($TimeSql);
    
} else {
    echo "修改資錯誤: " . $conn->error;
}