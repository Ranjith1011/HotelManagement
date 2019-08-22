<?php
include('connect.php');
session_start();
$_SESSION["account"]=0;
session_unset();
session_destroy();
header('location:firsh1.php');
?>