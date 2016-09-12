<?php 
session_start();
$_SESSION['userId']="";
$_SESSION['name']="";
session_unset();
session_destroy();
echo "out";
?>