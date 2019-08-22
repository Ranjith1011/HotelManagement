<?php
session_start();
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
<h1>Premam Group Of Hotels</h1>
<fieldset>
	<legend><h1>Successful</h1></legend>
	<span style="padding:400px"><p1>Password Changed Successfully!!!</p1></span>
	</fieldset>
	<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
	<input type="submit" name="submit" value="Back to Login Page">
	</form>
<?php
if($_SERVER['REQUEST_METHOD']=="POST")
	{
		if($_POST["submit"]=='Back to Login Page')
		{
			header("Location:loginuser.php");
		}
	}
?>
</body>
</html>