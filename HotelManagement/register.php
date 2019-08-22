<?php
session_start();
?>
<!Doctype html>
<html>
<head>
<title>Hotel Manam booking page</title>
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
	font-size:25px;
	color:White;
	text-shadow:2px 2px 6px blue;
}
p2
{
	font-size:20px;
	color:White;
	whitespace:pre;
	text-shadow:2px 2px 6px blue;
}
p3
{
	color:Black;
	font-size:25px;
}
body
{
	background-image:url("final14.png");
}
</style>
</head>
<body>
<?php
include("connect.php");
$error="";
if($_SERVER['REQUEST_METHOD']=="POST")
{
	if($_POST["submit"]=="Register"){
	$name=$_POST['name'];
	$password=$_POST['password'];
	$age=$_POST['age'];
	$gender=$_POST['gender'];
	$mail=$_POST['mail'];
	$pno=$_POST['pno'];
	$hno=$_POST['hno'];
	$sname=$_POST['sname'];
	$city=$_POST['city'];
	$qes=$_POST['qes'];
	$ans=$_POST['ans'];
	$sql="SELECT Email,Phone_No
		  FROM online_accounts
		  WHERE Email='$mail' OR Phone_No='$pno'";
$result=mysqli_query($conn,$sql);
if(!$result)
{
	die(mysqli_error($sql));
}
if((mysqli_num_rows($result)==0))
{
	$sql="INSERT INTO online_accounts(Name,Age,Gender,Email,Phone_No,H_No,Street_name,City,Password,Q_No,Ans)
		  VALUES('$name','$age','$gender','$mail','$pno','$hno','$sname','$city','$password','$qes','$ans')";
	$result=mysqli_query($conn,$sql);
	if(!$result)
	{
	die(mysqli_error($conn));
	}
	$sql="SELECT MAX(User_Id) AS RECENT1 FROM online_accounts";
	$result=mysqli_query($conn,$sql);
	if(!$result)
	{
		die(mysqli_error($conn));
	}
	$row = mysqli_fetch_assoc($result);
	$u_id=$row["RECENT1"];
	$_SESSION["u_id"]=$u_id;
	header("Location:registersucces.php");
}
else
{
	$error="Entered Email or(and) Phone No. is(are) already registered...";
}	
}
}	

?>
<h1>Premam Group Of Hotels</h1>
<fieldset>
<legend><p1>Enter User Details</p1></legend>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
<table>
<tr>
<td><p2>Name</p2></td>
<td><input type="text" name="name" required autofocus></td>
</tr>
<tr>
<td><p2>Gender:</p2></td>
</tr>
<tr>
<td><input type="radio" name="gender" value="M" checked><p2>Male</p2></td>
</tr>
<tr>
<td><input type="radio" name="gender" value="F" ><p2>Female</p2></td>
</tr>
<tr>
<td><input type="radio" name="gender" value="O" ><p2>Other</p2></td>
</tr>
<tr>
<td><p2>Age</p2></td>
<td><input type="int" name="age"  Min="18" Max="100" required></td>
</tr>
<tr>
<td><p2>Email</p2></td>
<td><input type="email" name="mail" required></td>
</tr>
<tr>
<td><p2>Phone</p2></td>
<td><input type="tel" name="pno" required></td>
<span style="color:Red;" style="font-size:20px"><?php echo $error; ?></span>
</tr>
<tr>
<td><p2>House No.</p2></td>
<td><input type="text" name="hno" required></td>
</tr>
<tr>
<td><p2>Street name</p2></td>
<td><input type="text" name="sname" required></td>
</tr>
<tr>
<td><p2>City</p2></td>
<td><input type="text" name="city" required></td>
</tr>
<tr>
<td><p2>Password</p2></td>
<td><input type="password" name="password" required></td>
</tr>
<tr>
<td><p2>Security Question:</p2></td>
<td><<select name="qes" required>
	<option value="What is your favourite pet name?">What is your favourite pet name?</option>
	<option value="Who is your most loved family member?">Who is your most loved family member?</option>
	<option value="What is your favourite movie name?">What is your favourite movie name?</option>>
	</select>
	</td>
</tr>
<tr>
<td><p2>Ans:</p2></td>
<td><input type="text" name="ans" required></td>
</tr>
</table>
</fieldset>
<span><input type="submit" name="submit" value="Register" ></span>
<span style="padding-left:50px;"><input type="reset" name="reset"></span>
</form>
<br>
<a href="firsh1.php"><p1>Back</p1></a>
</body>
</html>