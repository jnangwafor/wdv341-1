<?php
session_start();
//check if user login successfully and display a welcome message
	if(isset($_SESSION['username'])){
		echo "<h3>Welcome ".$_SESSION['username']."</h3>";
		echo "<a style='float: right; text-decoration: none; padding: 5px;' href='portfolioLogout.php'><button style='font-size: 20px; background-color: green; color: white;'>Logout</button></a>";
	}
else{
	header("location: portfolioLogIn.php");
}

?>