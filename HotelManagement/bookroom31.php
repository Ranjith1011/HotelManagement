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
	background-image:url("book1.jpg");
}
</style>
</head>
<body>
<?php
include("connect.php");
$i=$_SESSION["i"];
$error="";
if($_SERVER['REQUEST_METHOD']=="POST")
{
	$name=$_POST['name'];
	$code=$_POST['coupon'];
	$age=$_POST['age'];
	$gender=$_POST['gender'];
	$mail=$_POST['mail'];
	$pno=$_POST['pno'];
	$hno=$_POST['hno'];
	$sname=$_POST['sname'];
	$city=$_POST['city'];

	$sql="SELECT Offer_Code,Valid_date
		  FROM offers
		  WHERE Offer_Code='$code' && Valid_date>Now()";
$result=mysqli_query($conn,$sql);
if(!$result)
{
	die(mysqli_error($sql));
}
if((mysqli_num_rows($result)>0)||$code=="")
{
	$sql="INSERT INTO customer_details(	Name,Age,Gender,Email,Phone_No,H_No,Street_name,City)
		  VALUES('$name','$age','$gender','$mail','$pno','$hno','$sname','$city')";
	
	if(mysqli_query($conn,$sql))
	{
		$sql="SELECT MAX(Customer_Id) AS RECENT FROM customer_details";
		$result=mysqli_query($conn,$sql);
		if(!$result)
		{
			die(mysqli_error($conn));
		}
		$row = mysqli_fetch_assoc($result);
		$y=$row["RECENT"];
		for($j=0;$j<$i;$j++)
		{
			$x=$j+1;
			$z=$_SESSION["room$x"];
			$check_in=$_SESSION["check_in"];
			$check_out=$_SESSION["check_out"];
			$c=$_SESSION["id"];
			$sql="INSERT INTO reservation_details(Room_No,Booking_date_time,Check_In,Check_Out,Employee_User_Id,	Customer_Id)
				  VALUES('$z',Now(),'$check_in','$check_out','$c','$y')";
			if(!(mysqli_query($conn, $sql)))
			{
				die(mysqli_error($conn));
			}
		}
		echo $code;
	if($code!="")
	{
	$sql="INSERT INTO uses(Offer_Code,Customer_Id)
		  VALUES('$code','$y')";
	if(!(mysqli_query($conn, $sql)))
	{
		die(mysqli_error($conn));
	}
	}
	if(!empty($_POST['check_list']))
	{
		foreach($_POST['check_list'] as $check)
		{
			$sql="INSERT INTO chooses(Customer_Id,Service_name)
				  VALUES('$y','$check')";
			if(!(mysqli_query($conn, $sql)))
			{
				die(mysqli_error($conn));
			}
		}
	}
	$_SESSION["c_id"]=$y;
	header("Location:confirm.php");

}
}
else
{
	$error="Invalid Coupon Code";
}
}	

?>
<h1>Premam Group Of Hotels</h1>
<fieldset>
<legend><p1>Customer Details</p1></legend>
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
<td><input type="int" name="age" min="18" max="100" required></td>
</tr>
<tr>
<td><p2>Email</p2></td>
<td><input type="email" name="mail" required></td>
</tr>
<tr>
<td><p2>Phone</p2></td>
<td><input type="tel" name="pno" required></td>
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
</table>
</fieldset>
<fieldset>
<legend><p1>Choose Services</p1></legend>
<?php
include("connect.php");
$sql="SELECT Service_name
	  FROM services";
$result=mysqli_query($conn,$sql);
if(!$result)
{
	die(mysqli_error($conn));
}
while($row=mysqli_fetch_assoc($result))
{
	$x=$row['Service_name'];
?>
<input type="checkbox" name="check_list[]" value="<?php echo $x;?>"><?php echo "<p2>".$x."<p2>";?><br>
<?php
}
?>
</fieldset>
<p2 style="padding-left:400px;">Apply Offer Code:</p2>
<input type="text" name="coupon" placeholder="code">
<span style="color:red;"><?php echo $error;?></span>
<br>
<span style="padding-left:400px;"><input type="submit" name="submit"></span>
<span style="padding-left:50px;"><input type="reset" name="reset"></span>
</form>
<br>
<a href="bookroom2.php"><p2>Back</p2></a>
</body>
</html>