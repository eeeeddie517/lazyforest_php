<?php
session_start();

// unset($_SESSION["error"]);
// unset ($_SESSION["user"]);
// var_dump($_SESSION);

if (isset($_SESSION["member"])) {
    unset($_SESSION["member"]);
    header("location: Member/member-signIn-Liao.php");
    }
if (isset($_SESSION["camp"])) {
    unset($_SESSION["camp"]);
    header("location: CampHost_List/camp-signIn-Liao.php");
    }
if (isset($_SESSION["brand"])) {
    unset($_SESSION["brand"]);
    header("location: Brand_List/brand-signIn-Liao.php");
    }
if (isset($_SESSION["admin"])) {
    unset($_SESSION["admin"]);
    header("location: admin/sign-in.php");
    }
// header("location: Member/member-signIn-Liao.php");
