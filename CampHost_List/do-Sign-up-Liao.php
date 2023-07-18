<?php
session_start();
require_once("../db_connect.php");

if (!isset($_POST["name"])) {
    die("請依正常管道進入");
};

if (empty($_POST["name"])) {
    die("請輸入聯絡人姓名");
};

if (empty($_POST["vat"])) {
    die("請輸入統一編號");
};

if (empty($_POST["phone"])) {
    die("請輸入電話");
};

if (empty($_POST["account"])) {
    die("請設定登入帳號");
};

if (empty($_POST["password"])) {
    die("請輸入密碼");
};

$password = $_POST["password"];
$repassword = $_POST["repassword"];

if ($password != $repassword) {
    die("密碼前後不一致");
};

$password = md5($password); //將密碼加密
$account = $_POST["account"];
$password = $_POST["password"];
$password = md5($password); //將密碼加密
$vat = $_POST["vat"];
$name = $_POST["name"];
$phone = $_POST["phone"];
$now = date('Y-m-d H:i:s');
// var_dump($certification);

//檢查使用者是否註冊過了
$sqlCheck = "SELECT * FROM camp_list WHERE camp_email='$account' ";
$checkResult = $conn->query($sqlCheck);
$checkNum = $checkResult->num_rows;

// $sql = "INSERT INTO camp_list (camp_email, camp_password, camp_vat, camp_hostName, camp_phone, created_at, update_at, valid)
// VALUES ('$account','$password','$vat','$name','$phone','$now','$now', 1)";
// echo $sql;



if ($checkNum == 0) {
    //成功
    $sql = "INSERT INTO camp_list (camp_email, camp_password, camp_vat, camp_hostName, camp_phone, created_at, update_at, valid)
    VALUES ('$account','$password','$vat','$name','$phone','$now','$now', 1)";


    if ($conn->query($sql) === TRUE) {
        header("location:camp-signUp-Liao.php");
        //這邊要改成前往dashboard
    } else {
        echo "新增資料錯誤: " . $conn->error;
    }
    $conn->close();
} else {
    //失敗
    if (!isset($_SESSION["error"]["again"])) {
        $_SESSION["error"]["again"] = "這個帳號已經註冊過了";
    } else {
    }
    
    header("location:camp-signUp-Liao.php");
    
}