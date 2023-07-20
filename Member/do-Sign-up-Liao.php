<?php
session_start();

if (!isset($_POST["name"])) {
    die("請依正常管道進入");
};

if (empty($_POST["name"])) {
     die("請輸入姓名");
};

if (empty($_POST["password"])) {
    die("請輸入密碼");
};
if (empty($_POST["phone"])) {
    die("請輸入電話");
};

$password = $_POST["password"];
$repassword = $_POST["repassword"];

if ($password != $repassword) {
    die("密碼前後不一致");
};


require_once("../db_connect.php");

$name = $_POST["name"];
$account = $_POST["account"];
$phone = $_POST["phone"];
$now = date('Y-m-d H:i:s');
$password = md5($password); //將密碼加密
$city = $_POST["city"];
$citycode = intval($city);
// var_dump($citycode);

//檢查使用者是否註冊過了
$sqlCheck = "SELECT * FROM member_list WHERE user_email='$account' ";
$checkResult = $conn->query($sqlCheck);
$checkNum = $checkResult->num_rows;

// var_dump($checkNum);

if ($checkNum == 0) {
    //成功
    $sql = "INSERT INTO member_list (user_name, user_password, user_phone, user_email, user_city, created_at,update_at, valid)
    VALUES ('$name','$password','$phone','$account','$citycode' , '$now','$now', 1)";


    if ($conn->query($sql) === TRUE) {
        header("location: member-signIn-Liao.php");
    } else {
        echo "新增資錯誤: " . $conn->error;
    }
    $conn->close();
} else {
    //失敗

    if(!isset($_SESSION["error"]["again"])){
        $_SESSION["error"]["again"]="這個帳號已經註冊過了";
    }else{
        
    }
    header("location:member-signUp-Liao.php");
}
