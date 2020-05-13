<?php include("Include/Sessions.php"); ?>
<?php include("Include/Functions.php"); ?>
<?php 
$_SESSION["User_name"]=null;

session_destroy();

Redirect_to("Login.php");

 ?>