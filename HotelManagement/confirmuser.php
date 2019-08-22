<?php
session_start();
?>
<?php
include("connect.php");
$c_id=$_SESSION["c_id"];
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
	background-image:url("available.jpg");
}
</style>
</head>
<body>
<h1>Premam Group Of Hotels User</h1>
<fieldset>
	<legend><h1>Confirmation</h1></legend>
	<span style="padding:550px"><p1>Thanks for Choosing Us!!!</p1></span>
	<span style="padding:550px"><p1>Your Id is<?php echo " ",$c_id,"."; ?></p1></span>
	</fieldset>
	<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
	<input type="submit" name="submit" value="home">
	</form>
<?php
if($_SERVER['REQUEST_METHOD']=="POST")
	{
		if($_POST["submit"]=='home')
		{
			header("Location:useroptions.php");
		}
	}
?>
</body>
</html>