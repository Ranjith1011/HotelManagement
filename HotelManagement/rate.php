<?php
session_start();
?>
<!Doctype html>
<html>
<head>
<title>Rate</title>
<style type="text/css">
h1
{
	color:White;
	text-shadow:5px 5px 10px red;
	text-align:center;
}
h2{
	color:Black;
	text-align:center;
	font-size:30px;
	padding:50px;
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
	background-image:url("taj.jpg");
}
</style>
</head>
<?php
include("connect.php");
$error="";
$success="";
if($_SERVER['REQUEST_METHOD']=="POST")
{
	$c_id=$_SESSION['c_id'];
	$rating=$_POST["rating"];
	$review=$_POST["review"];
	$suggestions=$_POST["suggestions"];
	$sql="SELECT Customer_Id FROM review WHERE Customer_Id='$c_id'";
	$result=mysqli_query($conn,$sql);
	if(!$result)
	{
		die(mysqli_error($conn));
	}
	else if(mysqli_num_rows($result)==0){
	$sql="INSERT INTO review(Rating,Review,Suggestions,Customer_Id)
		  VALUES('$rating','$review','$suggestions','$c_id')";
	$result=mysqli_query($conn,$sql);
	if(!$result)
	{
		die(mysqli_error($conn));
	}
	$success="Review Successfully Saved!!!";
	}
	else{
		$error="Review Already Registered!!!";
	}
}
?>
<body/>
<h1>Premam Group Of Hotels</h1>
<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
<br>
<br>
<br>
<br>
<br>
<fieldset>
<legend><h1>Review!!!</h1></legend>
<span style="color:Red;" style="font-size:50px"><?php echo $error; ?></span>
<span style="color:Green;" style="font-size:50px"><?php echo $success; ?></span>
<br>
<p1 id="font">Rating:</p1>
<input type="radio" name="rating" value="1"><p1>1</p1>
<input type="radio" name="rating" value="2"><p1>2</p1>
<input type="radio" name="rating" value="3"><p1>3</p1>
<input type="radio" name="rating" value="4"><p1>4</p1>
<input type="radio" name="rating" value="5" checked><p1>5</p1>
<br>
<p1 id="font">Review:</p1>
<textarea name="review" placeholder="Write Review here!!!" rows="10" columns="30">
</textarea>
<br>
<p1 id="font">Suggestions:</p1>
<textarea name="suggestions" placeholder="Write Suggestions here!!!" rows="10" columns="30">
</textarea>
<br>
<input type="submit" name="submit" value="Submit">
</fieldset>
<a href="manageroptions.php"><p4>Back to Home page</p4></a>
</form>
</body>
</html>