<?php
session_start();
?>
<!Doctype html>
<html>
<head>
<title>Availability to book</title>
<style type="text/css">
h1
{
	color:White;
	text-shadow:5px 5px 10px red;
	font-size:30px;
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
body
{
	background-image:url("final1.jpg");
}
</style>
</head>
<h1>Premam Group Of Hotels User</h1>
<?php
$error1="";
$i=0;
if($_SERVER['REQUEST_METHOD']=="POST")
{
	if($_POST["submit"]=='Book')
	{
		if(!empty($_POST['checkrooms']))
	{
		foreach($_POST['checkrooms'] as $check)
		{
			$i++;
			$_SESSION['room'.$i]=$check;
		}
		$_SESSION["i"]=$i;
		header("Location:bookroom3user.php");
	}
	else
	{
		$error1="Choose atleast one room to Book!!!";
	}
	}
}
?>
<?php
include('connect.php');
	$check_in=$_SESSION["check_in"];
	$check_out=$_SESSION["check_out"];
	$type=$_SESSION["type"];
	$size=$_SESSION["size"];
$sql="SELECT Room_No
	  FROM room_details
	  WHERE Room_Type='$type' AND Room_Compatibility='$size'";
$result=mysqli_query($conn,$sql);
if(!$result)
{
	die(mysqli_error($conn));
}
echo "<body>";
if(mysqli_num_rows($result)> 0) {
    // output data of each row
		echo "<fieldset>";
		echo "<legend><h1>Available Room details in Premam!!!</h1></legend>";
		echo "<p2>Check-In date: ",$check_in,"<br>";
		echo "<p2>Check-Out date: ",$check_out,"<br>";
		echo "<p2>Room-Type:",$type,"<br>";
		echo "<p2>Room-Comapatabilty:",$size,"<br>";
		echo "</fieldset>";
		echo "<fieldset>";
		echo "<legend><h1>Choose Room(s)!!!</h1></legend>";
		?>
		<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
		<?php
    while($row = mysqli_fetch_assoc($result)) {
		?>
		<input type="checkbox" name="checkrooms[]" value="<?php echo $row["Room_No"];?>"><?php echo "<p2>".$row["Room_No"]."<p2>";?>
		<br>
		<?php
    }
	?>
	<span style="color:red" style="font-size:80%"><?php echo $error1;?></span>
	<br>
	<input type="submit" name="submit" value="Book">
	</fieldset>
	</form>
	<?php
} 
else
{
	header("Location:norooms.php");
}
mysqli_close($conn);
?>
<br>
<a href="bookroomuser1.php"><p4>Modify Search</p4></a>

</body>
</html>