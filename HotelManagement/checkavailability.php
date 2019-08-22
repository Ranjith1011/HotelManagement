<?php
session_start();
?>
<!Doctype html>
<html>
<head>
<title>Availability</title>
<style type="text/css">
h1
{
	color:White;
	text-shadow:5px 5px 10px red;
	text-align:center;
}
h2{
	color:Black;
	text-align:center;
	font-size:30px;
	padding:50px;
}
#font
{
	font-style:"Times New Roman" Serif;
}
p1
{
	font-size:25px;
	color:White;
	text-shadow:2px 2px 6px blue;
	text-align:center;
}
p2
{
	font-size:20px;
	color:White;
	whitespace:pre;
	text-shadow:2px 2px 6px blue;
	padding-left:500px;
}
p4
{
	font-size:25px;
	color:White;
	text-shadow:2px 2px 6px black;
	text-align:center;
}
p3
{
	font-size:20px;
	color:White;
	whitespace:pre;
	text-shadow:2px 2px 6px blue;
	
}
body
{
	background-image:url("room.jpg");
}
</style>
</head>
<h1>Premam Group Of Hotels</h1>
<?php
include('connect.php');
	$check_in=$_SESSION["check_in"];
	$check_out=$_SESSION["check_out"];
	$type=$_SESSION["type"];
	$size=$_SESSION["size"];	
	
$sql="SELECT Room_No
	  FROM room_details
	  WHERE Room_Type='$type' AND Room_Compatibility='$size' AND NOT EXISTS
      (SELECT Room_No
	  FROM reservation_details
	  WHERE ((Check_In<'$check_out' OR Check_In='$check_out') AND (Check_Out>'$check_out' OR Check_Out='$check_out'))OR((Check_In<'$check_in' OR Check_In='$check_in') AND (Check_Out>'$check_in' OR Check_Out='$check_in')))";
$result=mysqli_query($conn,$sql);
if(!$result)
{
	die(mysqli_error($conn));
}
echo "<body>";
if(mysqli_num_rows($result)> 0) {
?>
<table width="200" border="1" cellpadding="1" cellspacing="1">
<?php
		echo "<fieldset>";
		echo "<legend><h1>Available Room details in Premam!!!</h1></legend>";
		echo "<p2>Check-In date: ",$check_in,"<br>";
		echo "<p2>Check-Out date: ",$check_out,"<br>";
		echo "<p2>Room-Type:",$type,"<br>";
		echo "<p2>Room-Comapatabilty:",$size,"<br>";
		echo "<tr>";
		echo "<th><p1>Room No.</p1></th>";
		echo "</tr>";
    while($row = mysqli_fetch_assoc($result)) {
		echo "<tr>";
		echo "<td>","<p3>".$row["Room_No"]."<p3>","</td>";
		echo "</tr>";
    }
		echo "</table>";
		echo "</fieldset>";
} 
else
{
	
	echo "<fieldset>";
	echo "<legend><h1>Regrets...</h1></legend>";
	echo "<h2>","Opps!!! No rooms available in Premam...","</h2>";
	echo "</fieldset>";
}
mysqli_close($conn);
?>
<br>
<a href="firsh1.php"><p4>Modify</p4></a><br>
<br>
<a href="loginuser.php"><p4>Login</p4></a>
<a href="registeruser.php"><p4 style="padding-left:70px" >Register</p4></a>
<a href="loginemployee.php"><p4 style="padding-left:70px" >Employee</p4></a>
</body>
</html>