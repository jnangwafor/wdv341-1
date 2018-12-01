<?php

//Create  and initialize variables to hold query data
$event_name = "";
$event_description = "";
$event_presenter = "";
$event_date = "";
$event_time = "";

require_once('dbConnection.php') ;
require_once('exception_handlers.php') ;

//Create sql select statment to query data from the event table
$sql = "SELECT event_name, event_description, event_presenter, DATE_FORMAT( event_time,'%l:%i %p' ), DATE_FORMAT( event_date,'%W %M %D, %Y' )";	
$sql .= " FROM wdv341_event WHERE event_id = '2'";	// SQL command


$query = $connection->stmt_init();

try{
	if(!$query->prepare($sql)){
	throw new Exception("prepares statement failed");
}
}
catch(Exception $e){
	set_exception_handler($connection, $e);
	die(); //Kill connection
}
//run the statement
	
	if( $query->execute() )	//Run Query and Make sure the Query ran correctly
	{
		$query->bind_result($event_name, $event_description, $event_presenter, $event_time, $event_date);
	
		$query->store_result();
	}
else{
	set_statement_exception_handler($query, $e);
}

?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Display Events</title>
	
	 <style>
		.eventBlock{
			width:760px;
			margin-left:auto;
			margin-right:auto;
			background-color: #95D8D3;
			font-family: Gotham, "Helvetica Neue", Helvetica, Arial, "sans-serif";
		}
		
		.displayEvent{
			text_align:left;
			font-size:18px;	
		}
		
		.displayDescription {
			margin-left:100px;
		}
		 #button1{
		background-color: #411A1A;
			color:whitesmoke;
			font-size: 16px;
	}
	</style>
</head>

<body>
	<p>
			<a href= "homework.htm"><button id="button1" name="button1">Homework page</button></a>
		
		</p>
	<h1>Welcome to wdv341--Intro to PHP.</h1>
	<h2>On this page, we are going to display available events.</h2>
	<h3><?php echo $query->num_rows; ?> event is available today.</h3>
	
	
	<?php
	//Display each row as formatted output
	while( $query->fetch() )		
	//Turn each row of the result into an associative array 
  	{
		//For each row you have in the array create a block of formatted text
?>
	<p>
        <div class="eventBlock">	
            <div>
            	<span class="displayEvent"><strong>Event: </strong> <?php echo $event_name; ?></span><br>
            	<span class="displayDescription"><strong>Description </strong><br><?php echo $event_description; ?></span> 
            </div>
		
            <div>
            <strong>Presenter: </strong> <?php echo $event_presenter; ?>
				
            </div>
            <div>
            	<span class="displayTime"><strong>Time:</strong> <?php echo $event_time; ?></span>
				
            </div>
            <div>
            	<span class="displayDate"><strong>Date:</strong> <?php echo $event_date; ?></span>
            </div>
        </div>
    </p>

<?php
  	}//close while loop
	$query->close();
	$connection->close();	//Close the database connection	
?>
</body>
</html>