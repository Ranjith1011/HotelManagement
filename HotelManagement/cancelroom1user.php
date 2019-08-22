<?php
session_start();
?>
<!Doctype html>
<html>
<head>
<title>Cancel</title>
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
	text-shadow:2px 2px 6px blue;
}
p4
{
	font-size:25px;
	color:White;
	text-shadow:2px 2px 6px black;
	text-align:center;
}
body
{
	background-image:url("room.jpg");
}
</style>
</head>
<?php
include("connect.php");
$error="";
$success="";
if($_SERVER['REQUEST_METHOD']=="POST")
{
	$c_id=$_POST['c_id'];
	$sql="SELECT Customer_Id
		  FROM reservation_details
		  WHERE Customer_Id='$c_id' AND (Check_In>Now() OR Check_Out<Now())";
	$result=mysqli_query($conn,$sql);
	if(!$result){
		die(mysqli_error($conn));
	}
	else if(mysqli_num_rows($result)>0){
		$sql="SELECT *
			  FROM billing_details
			  WHERE Customer_Id='$c_id'";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)>0)
		{
			$error="Invalid Customer-Id or Timed out...";
		}
		else{
		$sql="DELETE FROM reservation_details
			  WHERE Customer_Id='$c_id'";
		$result=mysqli_query($conn,$sql);
		if(!$result){
		die(mysqli_error($conn));
		}
		$sql="DELETE FROM uses
			  WHERE Customer_Id='$c_id'";
		$result=mysqli_query($conn,$sql);
		if(!$result){
		die(mysqli_error($conn));
		}
		$sql="DELETE FROM chooses
			  WHERE Customer_Id='$c_id'";
		$result=mysqli_query($conn,$sql);
		if(!$result){
		die(mysqli_error($conn));
		}
		$sql="DELETE FROM customer_details
			  WHERE Customer_Id='$c_id'";
		$result=mysqli_query($conn,$sql);
		if(!$result){
		die(mysqli_error($conn));
		}
		$success="Cancellation Successfull...";
		}
	}
	else{
		$error="Invalid Customer-Id or Timed out...";
	}
}
?>
<body/>
<h1>Premam Group Of Hotels</h1>
<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
<br>
<br>
<br>
<br>
<br>
<fieldset>
<legend><h1>Cancel a Room</h1></legend>
<p1 id="font">Customer-Id:</p1>
<input type="int" name="c_id" placeholder="ID" autofocus required>
<br>
<span style="color:Red;"><p2><?php echo $error; ?></p2></span>
<span style="color:Green;"><p2><?php echo $success; ?></p2></span>
<br>
<input type="submit" name="submit" value="cancel">
</fieldset>
<a href="useroptions.php"><p4>Back to Home page</p4></a>
</form>
</body>
</html>