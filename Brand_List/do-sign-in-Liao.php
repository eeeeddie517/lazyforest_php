<?php
session_start();
require_once("../db_connect.php");


if (!isset($_POST["account"]) || empty($_POST["account"]) || !isset($_POST["password"]) || empty($_POST["password"])) {
    die("請輸入帳號和密碼");
}

$account=$_POST["account"];
$password=$_POST["password"];
$password=md5($password);


$sql="SELECT * FROM brand WHERE brand_email='$account' AND brand_password='$password'";
$result=$conn->query($sql);
$brand=$result->fetch_assoc() ;

$memberCount=$result->num_rows;

if($memberCount===0){

    if(!isset($_SESSION["error"]["times"])){
        $_SESSION["error"]["times"]=1;
    }else{
        $_SESSION["error"]["times"]++;
    }

    $_SESSION["error"]["message"]="帳號或密碼不正確";

    echo $_SESSION["error"]["times"];
 
    header("location: brand-signIn-Liao.php");

}else{
    //成功
    unset($_SESSION["error"]);
    $_SESSION["brand"]=$brand;
    header("location:../camp_home-LIN.php");
}



