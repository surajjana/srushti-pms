<?php  
session_start();
$len = strlen($_SESSION["pms_user"]);
echo gettype($len);
?>