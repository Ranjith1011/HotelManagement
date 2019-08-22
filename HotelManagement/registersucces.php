<?php
session_start();
?>
<?php
include("connect.php");
$u_id=$_SESSION["u_id"];
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
body
{
	background-image:url("final8.jpg");
}
</style>
</head>
<body>
<h1>Premam Group Of Hotels</h1>
<fieldset>
	<legend><h1>Registration Successful</h1></legend>
	<span style="padding:550px"><p1>Thanks for Registering!!!</p1></span>
	<span style="padding:550px"><p1>Your Id is<?php echo " ",$u_id,"."; ?></p1></span>
	</fieldset>
	<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
	<input type="submit" name="submit" value="Login Page">
	</form>
<?php
if($_SERVER['REQUEST_METHOD']=="POST")
	{
		if($_POST["submit"]=='Login Page')
		{
			header("Location:loginuser.php");
		}
	}
?>
</body>
</html>