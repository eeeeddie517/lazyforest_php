<?php
session_start();

unset($_SESSION["user"]);
// unset($_SESSION["error"]);

var_dump($_SESSION);


header("location: Member/member-signIn-Liao.php");

?>
