<?php
session_start();


if(!isset($_POST["name"])){
    echo "請循正常管道進入";
    exit;
}


require_once("../db_connect.php");

$name=$_POST["name"];
$password=$_POST["password"];
$password=md5($password);

// echo $name.",".$password;

$sql=
"SELECT * FROM users WHERE name='$name'
 AND password = '$password'
";

$result=$conn->query($sql);
$userCount=$result->num_rows;
$user=$result->fetch_assoc();

if($userCount===0){//登入失敗
    // echo "帳號或密碼不正確";
    // 存到session裡
    if(!isset($_SESSION["error"]["times"])){
        $_SESSION["error"]["times"]=1;
    }else{
        $_SESSION["error"]["times"]++;
    }
    // $_SESSION["error"]=["time"]

    // $_SESSION["error"]=[
    //     "message"=>"帳號或密碼不正確"
    // ];
    $_SESSION["error"]["message"]="帳號或密碼不正確";
    header("location: sign-in.php");
}else{ //登入成功
    // echo $userCount."<br>";
    unset($_SESSION["error"]);
    // 確認登入成功，把error刪掉
    $_SESSION["admin"]=$user;
    //把user存進去

    header("location: ../camp_home-LIN.php");
    //登入成功導到目標網站

}



?>
