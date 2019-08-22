<?php
session_start();
if($_SESSION["account"])
{
?>
<!Doctype html>
<html>
<head>
<title>Welcome to Employee Login Page</title>
<style type="text/css">
h1{
	color:White;
	text-shadow:5px 5px 10px red;
	text-align:center;
}

body{
	background-image:url("bang2.jpg");
	background-repeat: no-repeat;
}
p1
{
	font-size:20px;
	color:White;
	text-shadow:2px 2px 6px ;
	text-align:center;
}
p2
{
	font-size:20px;
	color:White;
	text-shadow:2px 2px 6px ;
	text-align:center;
	padding:1200px;
}
</style>
</head>
<?php
include("connect.php");
$id=$_SESSION["id"];
$passwordemp=$_SESSION["passwordemp"];
$sql="SELECT Name 
	  FROM employee_details
	  WHERE Employee_Id='$id' AND Password='$passwordemp'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
?>
<body>
<h1>Premam Group Of Hotels</h1>
<?php echo "<p1>"," Welcome ".$row["Name"]."!!!","</p1>","<br>","<br>";?>
<fieldset>
<legend style="font-size:160%">Select an Option</legend>
<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
<input type="radio" name="option" value="book" checked><p1>Book a Room</p1>
<br>
<br>
<input type="radio" name="option" value="cancel" ><p1>Cancel a Room</p1>
<br>
<br>
<input type="radio" name="option" value="bill" ><p1>Generate Bill</p1>
<br>
<br>
<input type="radio" name="option" value="view" ><p1>View Previous Bookings</p1>
<br>
</fieldset>
<input type="submit" name="submit" value="Select">
<span style="padding-left:1390px" ><input type="submit" name="submit" value="Log Out"></span>
</form>
</body>
</html>
<?php
if($_SERVER['REQUEST_METHOD']=="POST")
{
	if($_POST["submit"]=="Select"){
	$option=$_POST["option"];
	if($option=='book')
	{
		header("Location:bookroom1.php");
	}
	if($option=='cancel')
	{
		header("Location:cancelroom1.php");
	}
	if($option=='bill')
	{
		header("Location:generatebill.php");
	}
	if($option=='view')
	{
		header("Location:viewbooking.php");
	}
	}
	else{
		header("Location:logout.php");
	}
}
}
else{
	header("Location:loginemployee.php");
}
?>