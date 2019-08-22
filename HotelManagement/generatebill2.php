<?php
session_start();
?>
<!Doctype html>
<html>
<head>
<title>Generate2</title>
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
p3
{
	font-size:20px;
	color:White;
	whitespace:pre;
	text-shadow:2px 2px 6px blue;
	
}
body
{
	background-image:url("final.jpg");
}
</style>
</head>
<h1>Premam Group Of Hotels</h1>
<?php
include('connect.php');
$totalser=0;
$offer=0;
$c_id=$_SESSION['c_id'];
	$sql="SELECT Customer_Id,Check_In,Check_Out,Room_No
		  FROM reservation_details
		  WHERE Customer_Id='$c_id'";
	$result=mysqli_query($conn,$sql);
	if(!$result){
		die(mysqli_error($conn));
	}
	$z=mysqli_num_rows($result);
?>
<table width="400" border="2" cellpadding="1" cellspacing="1">
<?php
		$row=mysqli_fetch_assoc($result);
		$r=$row["Room_No"];
		$x=date_create($row["Check_In"]);
		$y=date_create($row["Check_Out"]);
		$diff=date_diff($x,$y)->format("%a")+1;
		$sql="SELECT Price_per_day
			  FROM room_details
			  WHERE Room_No='$r' ";
		$result1=mysqli_query($conn,$sql);
		if(!$result1){
		die(mysqli_error($conn));
		}
		$row1=mysqli_fetch_assoc($result1);
		$price=$row1["Price_per_day"];
		echo "<fieldset>";
		echo "<legend><h1>Bill-Details</h1></legend>";
		echo "<tr>";
		echo "<td><p2>Price per day</p2></td>";
		echo "<td><p2>",$price,"</p2></td>";
		echo "</tr>";
		echo "</table>";
?>
<table width="400" border="2" cellpadding="1" cellspacing="1">
<?php
		$sql="SELECT services.Price,services.Service_name
			  FROM  services
			  JOIN chooses
			  ON services.Service_name=chooses.Service_name
			  WHERE chooses.Customer_Id='$c_id'";
		$result=mysqli_query($conn,$sql);
		if(!$result){
		die(mysqli_error($conn));
	    }
		while($row=mysqli_fetch_assoc($result))
		{
			$p=$row["Price"];
			$p1=$row["Service_name"];
			echo "<tr>";
			echo "<td><p2>",$p1,"</p2></td>";
			echo "<td><p2>",$p,"</p2></td>";
			echo "</tr>";
			$totalser=$totalser+$p;
		}
		echo "<tr>";
		echo "<td><p2>Total Services Price</td></p2> ";
		echo "<td><p2>",$totalser,"</td></p2>";
		echo "</tr>";
		echo "</table>";
		$sql="SELECT offers.Offer
			  FROM offers
			  JOIN uses
			  ON offers.Offer_Code=uses.Offer_Code
			  WHERE uses.Customer_Id='$c_id'";
		$result3=mysqli_query($conn,$sql);
		if(!$result3){
		die(mysqli_error($conn));
		}
		$row3=mysqli_fetch_assoc($result3);
		if(mysqli_num_rows($result3)>0){	
		$offer=$row3["Offer"];
		}
		$total1=$totalser+$price;
		$total=$total1*$z*$diff;
		$total2=(($offer/100)*$total);
		$gtotal=$total-$total2;
?>
<table width="400" border="2" cellpadding="1" cellspacing="1">
<?php
		echo "<tr>";
		echo "<td><p2>Total Price of 1 room per day</td></p2> ";
		echo "<td><p2>",$total1,"</td></p2>";
		echo "</tr>";
		echo "<tr>";
		echo "<td><p2>Total Days</td></p2> ";
		echo "<td><p2>",$diff,"</td></p2>";
		echo "</tr>";
		echo "<tr>";
		echo "<td><p2>No. of Rooms</td></p2> ";
		echo "<td><p2>",$z,"</td></p2>";
		echo "</tr>";
		echo "<tr>";
		echo "<td><p2>Total Price</td></p2> ";
		echo "<td><p2>",$total,"</td></p2>";
		echo "</tr>";
		echo "<tr>";
		echo "<td><p2>Offer</td></p2> ";
		echo "<td><p2>",$offer,"%"," (i.e.,",$total2,")","</td></p2>";
		echo "</tr>";
		echo "<tr>";
		echo "<td><p2>Grand Total</td></p2> ";
		echo "<td><p2>","Rs ",$gtotal,"/-","</td></p2>";
		echo "</tr>";
		echo "</table>";
		echo "</body>";
		echo "</fieldset>";
?>
<body>
<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
<input type="submit" name="submit" value="Paid">
</form>
<br>
<a href="manageroptions.php"><p4>Back to Home page</p4></a>
<?php
include("connect.php");
if($_SERVER['REQUEST_METHOD']=="POST"){
	$_SESSION['gtotal']=$gtotal;
	$_SESSION['c_id']=$c_id;
	header("Location:finalbill.php");
	}
?>
</body>
</html>