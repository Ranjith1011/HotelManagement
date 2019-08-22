<?php
session_start();
?>
<?php
include("connect.php");
$id=$_SESSION["id"];
?>
<html>
<head>
<title>Hotel Manam confirm page</title>
<style type="text/css">
h1
{
	color:White;
	text-shadow:5px 5px 10px red;
	text-align:center;
}
#font
{
	font-style:"Times New Roman" Serif;
}
p1
{
	font-size:30px;
	color:Cyan;
	text-shadow:2px 2px 6px Orange;
}
p2
{
	font-size:20px;
	color:White;
	whitespace:pre;
	text-shadow:2px 2px 6px blue;
}
body
{
	background-image:url("available.jpg");
}
</style>
</head>
<body>
<h1>Premam Group Of Hotels</h1>
<fieldset>
	<legend><h1>Previous Bookings!!!</h1></legend>
	<?php
	include("connect.php");
	$sql="SELECT * FROM reservation_details WHERE Employee_User_Id='$id'";
	$result=mysqli_query($conn,$sql);
	if(!$result)
	{
		die(mysqli_error($conn));
	}
	else if(mysqli_num_rows($result)>0)
	{
?>
<table width="800" border="2" cellpadding="10" cellspacing="1">
<?php
		echo "<tr>";
		echo "<th><p2>Booking Date & Time</p2></th>";
		echo "<th><p2>Check In</p2></th>";
		echo "<th><p2>Check Out</p2></th>";
		echo "<th><p2>Customer Id</p2></th>";
		echo "<th><p2>Room No.</p2></th>";
		echo "</tr>";
		while($row=mysqli_fetch_assoc($result))
		{
		echo "<tr>";
		echo "<td><p2>".$row["Booking_date_time"]."</p2></td>";
		echo "<td><p2>".$row["Check_In"]."</p2></td>";
		echo "<td><p2>".$row["Check_Out"]."</p2></td>";
		echo "<td><p2>".$row["Customer_Id"]."</p2></td>";
		echo "<td><p2>".$row["Room_No"]."</p2></td>";
		echo "</tr>";
		}
	}
	else{
		echo "<p1>No Previous Bookings!!!</p1>";
	}
	?>
	</fieldset>
<?php
if($_SERVER['REQUEST_METHOD']=="POST")
	{
		if($_POST["submit"]=='Back to home')
		{
			header("Location:manageroptions.php");
		}
	}
?>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
<input type="submit" name="submit" value="Back to home">
</form>
</body>
</html>