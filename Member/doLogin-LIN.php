<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 检查角色选项是否被选择
    if (isset($_POST['role'])) {
        $selectedRole = $_POST['role'];

        // 根据所选的角色执行相应的逻辑
        if ($selectedRole === 'camp_host') {
            // 用户选择了 "Camp Host" 角色
            // 执行相应的逻辑...
            require_once("../db_connect.php");
            
            $camp_host = $_POST["camp_host"];
            $password = $_POST["password"];

            $sql = "SELECT * FROM camp_list WHERE camp_email='$camp_host' AND camp_password='$password' AND valid='1'";
            $result = $conn->query($sql);
            $userCount = $result->num_rows;
            $camp_host = $result->fetch_assoc();

            $userRole = 'A';

            // 继续处理其他逻辑...
        } elseif ($selectedRole === 'brand') {
            // 用户选择了 "Brand" 角色
            // 执行相应的逻辑...
            $userRole = 'B';

            // 继续处理其他逻辑...
        } elseif ($selectedRole === 'admin') {
            // 用户选择了 "Admin" 角色
            // 执行相应的逻辑...
            $userRole = 'C';

            // 继续处理其他逻辑...
        }
    } else {
        // 未选择角色时显示错误提示
        echo "未選擇角色，請重新選擇";
        exit;
    }
} else {
    echo "請循正常管道進入";
    exit;
}






require_once("../db_connect.php");

// $camp_host = $_POST["camp_host"];
// $password = $_POST["password"];
// $password=md5($password);

// echo $name.",".$password;

// $sql =
//     "SELECT * FROM camp_list WHERE camp_email='$camp_host'
//  AND camp_password = '$password' AND valid ='1'
// ";

// $result = $conn->query($sql);
// $userCount = $result->num_rows;
// $camp_host = $result->fetch_assoc();

if ($userCount === 0) { //登入失敗
    // echo "帳號或密碼不正確";
    // 存到session裡
    if (!isset($_SESSION["error"]["times"])) {
        $_SESSION["error"]["times"] = 1;
    } else {
        $_SESSION["error"]["times"]++;
    }
    // $_SESSION["error"]=["time"]

    // $_SESSION["error"]=[
    //     "message"=>"帳號或密碼不正確"
    // ];
    $_SESSION["error"]["message"] = "帳號或密碼不正確";
    header("location: member-signIn-Liao.php");
} else { //登入成功
    // echo $userCount."<br>";
    unset($_SESSION["error"]);
    // 確認登入成功，把error刪掉
    $_SESSION["camp_host"] = $camp_host;
    //把user存進去

    header("location: ../camp_home-LIN.php");
    //登入成功導到目標網站

}
