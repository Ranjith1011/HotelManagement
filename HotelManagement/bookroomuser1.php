<?php
session_start();
?>

<!Doctype html>
<html>
<head>
<title>Hotel Manam bookroom page</title>
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
	text-align:center;
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
	background-image:url("raj.jpg");
}
</style>
</head>
</body>
<?php
$error="";
if($_SERVER['REQUEST_METHOD']=="POST")
{
	$check_in=$_POST['check_in'];
	$check_out=$_POST['check_out'];
	$type=$_POST["type"];
	$size=$_POST["size"];
	if($check_in>$check_out){
		$error="Invalid Check-In or Check-Out dates";
	}
	else{
		$_SESSION["check_in"]=$check_in;
		$_SESSION["check_out"]=$check_out;
		$_SESSION["type"]=$type;
		$_SESSION["size"]=$size;
		header("location:bookroom2user.php");
	}
}
?>
<h1 id="font">Premam Group of Hotels</h1>
<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
<br>
<br>
<br>
<br>
<br>
<fieldset>
<legend><p3>Search Availability of a Room at Premam</p3></legend>
<p1 id="font">Check-In date:</p1>
<input type="date" name="check_in" min="<?php echo "20",date("y-m-d");?>" autofocus required>
<p1 style="padding-left:70px" id="font">Check-Out date:</p1>
<input type="date" name="check_out" min="<?php echo "20",date("y-m-d");?>"  required >
<br>
<span style="color:Red;" style="font-size:20px"><?php echo $error; ?></span>
<br>
<p1 id="font">Room Type:</p1>
<br>
<input type="radio" name="type" value="Ordinary" checked ><p2>Ordinary</p2>
<br>
<input type="radio" name="type" value="Deluxe" ><p2>Deluxe</p2>
<br>
<input type="radio" name="type" value="Luxury" ><p2>Luxury</p2>
<br>
<input type="radio" name="type" value="Grand_luxury" ><p2>Grand luxury</p2>
<br>
<br>
<p1 id="font">Room Compatability:</p1>
<br>
<input type="radio" name="size" value="Single" checked ><p2>Single</p2>
<br>
<input type="radio" name="size" value="Double" ><p2>Double</p2>
<br>
<input type="radio" name="size" value="Suite" ><p2>Suite</p2>
<br>
<br>
<input type="submit" name="submit" value="Check Availability">
</fieldset>
</form>
<a href="useroptions.php"><p1 style="padding-left:10px" ><p1>Back to Home</p1></a>
</body>
</html>