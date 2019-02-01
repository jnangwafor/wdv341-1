<?php

	
$id = 0;

// connect to the database
include 'dbConnection.php';


// sql to delete a record
if(isset($_GET['recId'])){
	$id = $_GET['recId'];
	
	
	$row = "DELETE FROM wdv341_event WHERE event_id = $id";



if  ($connection->query($row) === TRUE) {
	?>
     <span id="del">Record deleted successfully</span>
	<?php
	//header('location: selectEvent.php'); //Redirect back to selectEvent.php page
} else {
	?>
	<span id="del">Error deleting record</span>
	<?php
}
}
//$connection->close();
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Display Events</title>
	<style>
		
	#del{
			 color: red;
		 }
		
	 
		
	</style>
</head>

<body>
</body>
</html>
