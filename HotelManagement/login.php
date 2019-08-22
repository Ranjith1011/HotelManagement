<!Doctype html>
<html>
<?php $passerr=""?>
<body style="background-color:springgreen;">
<h1 style="text-align:center;">HOTEL MANAM WELCOMES YOU...</h1>
<br>
<br>
<pre>                         </pre>
<form   action="manam.php" method="post">
Employee ID:
<br>
<input type="text" name="emp_id"><br>
					Password:
	<span><?php echo $passerr; ?></span>
<br>
<input type="text" name="password"><br>
<input type="submit" name="submit"><br>
</form>
</body>
</html>
