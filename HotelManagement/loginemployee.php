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
	background-image:url("bang2.jpg");
	background-repeat: no-repeat;
}
p1
{
	font-size:25px;
	color:White;
	text-shadow:2px 2px 6px ;
	text-align:center;
}
</style>
</head
<?php
include("connect.php");
$error="";
if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$id=$_POST["id"];
	$passwordemp=$_POST["password"];
	$sql="SELECT * FROM employee_details
		  WHERE Employee_Id='$id' AND Password='$passwordemp'";
	$result=mysqli_query($conn,$sql);
	if(!$result)
	{
		die(mysqli_error($conn));
	}
	if(mysqli_num_rows($result)==1)
	{
		$_SESSION["id"]=$id;
		$_SESSION["passwordemp"]=$passwordemp;
		$row=mysqli_fetch_assoc($result);
		$_SESSION["account"]=1;
		header("Location:manageroptions.php");
	}
	else
	{
		$error="Invalid Email-Id or Password";
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
<td><p1> Employee-Id</p1></td>
<td><input type="text" name="id" placeholder="ID" autofocus required/></td>
</tr>
<tr>
<td><p1>Password</p1></td>
<td><input type="password" name="password" placeholder="Password" required/></td>
<span style="color:Red" style="font-size:25px"><?php echo $error ?></span>
</tr>
<tr>
<td colspan="2px"><input  class="inp" type="submit" value="Login"/>
</tr>
</table>
</fieldset>
</form>
<a href="firsh1.php"><p1 style="padding-left:10px" ><p1>Back</p1></a>
</body>
</html>