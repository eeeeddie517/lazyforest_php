<?php
session_start();

// unset($_SESSION["error"]);

// var_dump($_SESSION);

if (!isset($_SESSION["user"])) {
    unset($_SESSION["user"]);
    header("location: Member/member-signIn-Liao.php");
    }
if (!isset($_SESSION["camp"])) {
    unset($_SESSION["camp"]);
    header("location: CampHost_List/camp-signIn-Liao.php");
    }
if (!isset($_SESSION["brand"])) {
    unset($_SESSION["brand"]);
    header("location: Brand_List/brand-signIn-Liao.php");
    }
// header("location: Member/member-signIn-Liao.php");

?>
