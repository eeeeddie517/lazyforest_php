<?php

if (!isset($_POST["camp_name"])) {
    die("請依正常管道到此頁");
}

require_once("./Camp_Ground/db_connect_camp-YU.php");

$camp_name = $_POST["camp_name"];
$camp_address = $_POST["camp_address"];
$camp_introduce = $_POST["camp_introduce"];
$camp_notice = $_POST["camp_notice"];
$camp_phone = $_POST["camp_phone"];
$camp_altitude = $_POST["camp_altitude"];

// 代辦事項:
// JOIN CampHost_List > 抓登入進來的CampHost 的ID > 然後再insert

// echo "$camp_name, $camp_address, $camp_introduce, $camp_notice,  $camp_phone, $camp_altitude";

$sql = "INSERT INTO camp_info (camp_name, camp_address, camp_introduce, camp_notice, camp_phone, camp_altitude, valid) VALUES ('$camp_name', '$camp_address', '$camp_introduce', '$camp_notice', '$camp_phone', '$camp_altitude', 1)";

// echo $sql;


if ($conn->query($sql) === TRUE) {

    $latestId = $conn->insert_id;
    echo "資料表 camp_info 新增資料完成, id 為 $latestId";
    // header("location: user-list.php");

} else {
    echo "新增資料錯誤: " . $conn->error;
}

$conn->close();
