<?php
session_start();
?>
<!Doctype html>
<html>
<head>
<title>finalbill</title>
<style type="text/css">
h1
{
	color:White;
	text-shadow:5px 5px 10px red;
	text-align:center;
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
	font-size:30px;
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
	background-image:url("final8.jpg");
}
</style>
</head>
<body>
<h1>Premam Group Of Hotels</h1>
<?php
include("connect.php");
$id=$_SESSION['id'];
$c_id=$_SESSION['c_id'];
$gtotal=$_SESSION['gtotal'];
$sql="SELECT *
	  FROM billing_details
	  WHERE Customer_Id='$c_id'";
$result=mysqli_query($conn,$sql);
if(!$result){
	die(mysqli_error($conn));
}
if(mysqli_num_rows($result)==1){
		$row=mysqli_fetch_assoc($result);
		echo "<fieldset>";
		echo "<legend><h1>Already Paid & Billing Details!!!</h1></legend>";
		?>
		<table width="300" border="1" cellpadding="1" cellspacing="1">
		<?php
		echo "<tr>";
		echo "<td><p3>Grand Total<p3></td>";
		echo "<td>","<p3>".$row["Amount_Paid"]."<p3>","</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td><p3>Billing Date & Time<p3></td>";
		echo "<td>","<p3>".$row["Billing_date_time"]."<p3>","</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td><p3>Customer_Id<p3></td>";
		echo "<td>","<p3>".$row["Customer_Id"]."<p3>","</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td><p3>Employee_Id<p3></td>";
		echo "<td>","<p3>".$row["Employee_Id"]."<p3>","</td>";
		echo "</tr>";
		echo "</table>";
		echo "</fieldset>";
}
else{
	$sql="INSERT INTO billing_details
		  VALUES('$gtotal',Now(),'$id','$c_id')";
	$result=mysqli_query($conn,$sql);
	if(!$result){
	die(mysqli_error($conn));
	}
	echo "<fieldset>";
	echo "<legend><h1>Billing Details!!!</h1></legend>";
	echo "<p2>Billing Successfull</p2>";
	echo "</fieldset>";
}
?>
<a href="manageroptions.php"><p1 style="padding-left:10px" ><p1>Back to Home</p1></a>
<a href="rate.php"><p1 style="padding-left:100px" ><p1>Rate Us!!!</p1></a>
</body>
</html>