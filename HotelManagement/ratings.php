<html>
<head>
<title>Ratings</title>
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
	font-size:20px;
	color:White;
	text-shadow:2px 2px 6px Yellow;
}
p2
{
	font-size:30px;
	color:White;
	text-shadow:2px 2px 6px Red;
	padding-left:400px;
}
body
{
	background-image:url("rating.jpg");
}
</style>
</head>
<body>
<h1>Premam Group Of Hotels</h1>
<fieldset>
	<legend><h1>Ratings & Reviews</h1></legend>
	<?php
	include("connect.php");
	$sql="SELECT * FROM review";
	$result=mysqli_query($conn,$sql);
	if(!$result){
		die(mysqli_error($conn));
	}
	if(mysqli_num_rows($result)>0){
		?>
		<table width="500" border="2" cellpadding="1" cellspacing="1">
		<?php
		echo "<tr>";
		echo "<th><p1>Name</p1></th>";
		echo "<th><p1>Review</p1></th>";
		echo "<th><p1>Rating</p1></th>";
		echo "</tr>";
		while($row=mysqli_fetch_assoc($result)){
			$cus_id=$row["Customer_Id"];
			$sql="SELECT Name FROM customer_details WHERE Customer_Id='$cus_id'";
			$result1=mysqli_query($conn,$sql);
			if(!$result1){
			die(mysqli_error($conn));
			}
			$row1=mysqli_fetch_assoc($result1);
			echo "<tr>";
			echo "<td><p1>".$row1["Name"]."</p1></th>";
			echo "<th><p1>".$row["Review"]."</p1></th>";
			echo "<th><p1>".$row["Rating"]."</p1></th>";
			echo "</tr>";
		}
	}
	else
	{
		echo "<p2>No Ratings & Reviews Yet...</p2>";
	}
	?>
	</fieldset>
	<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
	<input type="submit" name="submit" value="Back to home">
	</form>
<?php
if($_SERVER['REQUEST_METHOD']=="POST")
	{
		if($_POST["submit"]=='Back to home')
		{
			header("Location:firsh1.php");
		}
	}
?>
</body>
</html>