<?php

	require 'connectPDO.php';
	try{

	//Get the name vlue pairs from the $_post variable into the php variables
	$event_name = $_POST['event_name'];
	$event_description = $_POST['event_description'];
	$event_date = $_POST['event_date'];
	$event_time = $_POST['event_time'];

	//create the sql insert command to insert data into the database
	$sql = "INSERT INTO wdv341_event(";
	$sql.= "event_name,";
	$sql.= "event_description,";
	$sql.= "event_date,";
	$sql.= "event_time";
	$sql.= ")VALUES (:eventName, :eventDescription, :eventDate, :eventTime)";
	
	$stmt = $conn->prepare($sql);	//prepare the SQL statement
	
	
	//bind placeholder to a value
	
	$stmt->bindParam(':eventName', $event_name);
	$stmt->bindParam(':eventDescription', $event_description);
	$stmt->bindParam(':eventDate', $event_date);
	$stmt->bindParam(':eventTime', $event_time);
	$stmt->execute();
	
		}
catch (PDOException $e ){
	$message = "There has been a problem. The system administrator has been contacted. Please try again later.";
	
				error_log($e->getMessage());			//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
				error_log(var_dump(debug_backtrace()));
				
			
				header('Location: files/505_error_response_page.php');	
}
	
	






?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
	<?php
		if($stmt->execute())
		{	
	?>
	<h3>Thank you!</h3>
	<p>Your registration has been received</p>
	<?php
		}
	else
	{
	?>
	<?php
		echo $message;
	}
	?>
	
</body>
</html>