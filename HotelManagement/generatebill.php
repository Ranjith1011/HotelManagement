<?php
session_start();
?>
<!Doctype html>
<html>
<head>
<title>Generate</title>
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
	background-image:url("final2.jpg");
}
</style>
</head>
<h1>Premam Group Of Hotels</h1>
<?php
include("connect.php");
$error="";
if($_SERVER['REQUEST_METHOD']=="POST")
{
	$c_id=$_POST['c_id'];
	$sql="SELECT Customer_Id
		  FROM reservation_details
		  WHERE Customer_Id='$c_id'";
	$result=mysqli_query($conn,$sql);
	if(!$result){
		die(mysqli_error($conn));
	}
	if(mysqli_num_rows($result)>0){
		$_SESSION["c_id"]=$c_id;
		header("Location:generatebill2.php");
	}
	
	else{
		$error="Invalid Customer-Id or Timed out...";
	}
}
?>
<body>
<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
<br>
<br>
<br>
<br>
<br>
<fieldset>
<legend><h1>Generate Bill</h1></legend>
<p1 id="font">Customer-Id:</p1>
<input type="int" name="c_id" placeholder="ID" autofocus required>
<br>
<span style="color:Red;"><?php echo $error; ?></span>
<br>
<input type="submit" name="submit" value="Generate Bill">
</fieldset>
<a href="manageroptions.php"><p4>Back to Home page</p4></a>
</form>
</body>
</html>