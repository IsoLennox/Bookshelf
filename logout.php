<?php require_once("functions/session.php"); require_once("functions/functions.php");

//Clear Sessions

$_SESSION["user_id"] = null;
$_SESSION["email"] = null;
$_SESSION["username"] = null;
redirect_to("login.php");
?>