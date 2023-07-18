<?php
session_start();

require_once("../db_connect.php");


if (!isset($_POST["account"]) || empty($_POST["account"]) || !isset($_POST["password"]) || empty($_POST["password"])) {
    die("請輸入帳號和密碼");
}

$account=$_POST["account"];
$password=$_POST["password"];
$password=md5($password);

$sql="SELECT * FROM member_list WHERE user_email='$account' AND user_password='$password'";
$result=$conn->query($sql);
$member=$result->fetch_assoc() ;

$memberCount=$result->num_rows;

if($memberCount===0){

    if(!isset($_SESSION["error"]["times"])){
        $_SESSION["error"]["times"]=1;
    }else{
        $_SESSION["error"]["times"]++;
    }

    $_SESSION["error"]["message"]="帳號或密碼不正確";

    echo $_SESSION["error"]["times"];
 
    header("location: member-signIn-Liao.php");

}else{
    //成功
    unset($_SESSION["error"]);
    $_SESSION["member"]=$member;
    header("location:index-Liao.php");
    // header("location: ../camp_home-LIN.php");
}



