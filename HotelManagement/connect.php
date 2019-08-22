<?php
$servername = "localhost";
$username = "root";
$password = "";
$mysql_db="hotel";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $mysql_db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>