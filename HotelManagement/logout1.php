<?php

	echo "Logged out scuccessfully";
    
    session_start();
	$mail=$_SESSION["mail"];
	session_destroy();
	setcookie($mail,session_id(),time()-1);

?>