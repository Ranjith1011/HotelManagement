<?php
session_start();
?>
<!DOCTYPE html>
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
	background-image:url("final11.jpg");
	background-repeat: no-repeat;
}
p1
{
	font-size:25px;
	color:White;
	text-shadow:2px 2px 6px blue;
	text-align:center;
}
</style>
</head
<?php
include("connect.php");
$error="";
if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$mail=$_POST["mail"];
	$sql="SELECT Password FROM online_accounts
		  WHERE Email='$mail'";
	$result=mysqli_query($conn,$sql);
	if(!$result)
	{
		die(mysqli_error($conn));
	}
	if(mysqli_num_rows($result)==1)
	{
		$_SESSION["mail"]=$mail;
		header("Location:securepassword.php");
	}
	else
	{
		$error="Invalid Email-Id";
	}
}
?>
<body>
<h1>
Premam Group Of Hotels
</h1>
<br>
<br>
<br>
<br>
<fieldset>
<legend><p1>Login</p1></legend>
<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
<table>
<tr>
<td><p1>Enter Your Email Id:</p1></td>
<td><input type="text" name="mail" placeholder="ID" autofocus required/></td>
<span style="color:Red" style="font-size:25px"><?php echo $error ?></span>
</tr>
<tr>
<td colspan="1px"><input  class="inp" type="submit" value="Submit"/>
</tr>
</table>
</fieldset>
</form>
<a href="loginuser.php"><p1 style="padding-left:10px" ><p1>Back</p1></a>
</body>
</html>