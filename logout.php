<?php
	session_start();
	
	//this affect the content of the session  variable(s)
	$_SESSION['validUser'] ="false";
	session_unset('validUser');

	session_destroy(); //destroy the current session and all related session info
	
	
	header('location: homework.htm');
exit();

?>
