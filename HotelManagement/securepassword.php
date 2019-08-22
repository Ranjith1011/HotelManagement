<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Welcome to Employee Login Page</title>
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


<h1>
Premam Group Of Hotels
</h1>
<br>
<br>
<br>
<br>

<?php
include("connect.php");
$error="";
$mail=$_SESSION["mail"];
if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$ans=$_POST["ans"];
	$sql="SELECT Ans FROM online_accounts
		  WHERE Email='$mail'";
	$result=mysqli_query($conn,$sql);
	if(!$result)
	{
		die(mysqli_error($conn));
	}
	$row=mysqli_fetch_assoc($result);
	if($row["Ans"]==$ans)
	{
		header("Location:changepassword.php");
	}
	else
	{
		$error="Invalid Answer";
	}
}
	$sql="SELECT Q_No FROM online_accounts
		  WHERE Email='$mail'";
	$result=mysqli_query($conn,$sql);
	if(!$result)
	{
		die(mysqli_error($conn));
	}
	$row=mysqli_fetch_assoc($result);
		echo "<fieldset>";
		echo "<legend><h1>Security Question!!!</h1></legend>";
?>
		<table width="300" border="1" cellpadding="1" cellspacing="1">
<?php
		echo "<tr>";
		echo "<td>","<p3>".$row["Q_No"]."<p3>","</td>";
		echo "</tr>";
?>
<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
<table>
<tr>
<td><p1>Ans:</p1></td>
<td><input type="text" name="ans" autofocus required/></td>
<span style="color:Red" style="font-size:25px"><?php echo $error ?></span>
</tr>
<tr>
<td colspan="1px"><input type="submit" value="Submit"/>
</tr>
</table>
</fieldset>
</form>
<a href="loginuser.php"><p1 style="padding-left:10px" ><p1>Back to Login Page</p1></a>
</body>
</html>


