<?php
$camp_id=$_POST["camp_id"];
$camp_name=$_POST["camp_name"];
$camp_address=$_POST["camp_address"];
$camp_phone=$_POST["camp_phone"];
$camp_altitude=$_POST["camp_altitude"];
$camp_introduce=$_POST["camp_introduce"];
$camp_notice=$_POST["camp_notice"];

require_once("./db_connect_camp-YU.php");

$sql="UPDATE camp_info SET camp_name='$camp_name', camp_address='$camp_address', camp_phone='$camp_phone', camp_altitude='$camp_altitude', camp_introduce='$camp_introduce', camp_notice='$camp_notice' WHERE camp_id=$camp_id";

// echo $sql;

if ($conn->query($sql) === TRUE) {
    header("location: camp-LIN.php?camp_id=".$camp_id);
} else {
    echo "修改資料錯誤: " . $conn->error;
}


