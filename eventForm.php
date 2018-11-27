<?php
//Create global variables
$event_name = "";
$event_description = "";
$event_date = "";
$event_time = "";

//Create error message variables
$nameErrMsg = "";
$descriptErrMsg = "";
$dateErrMsg = "";
$timeErrMsg = "";

//set default form ststus to invalid
$validForm = false;

//Validate event name funtion. 
//Check if event name has been entered before submitting the form
function validateEventName(){
	//Use global variables created above
	global $event_name, $nameErrMsg, $validForm;
	$nameErrMsg = "";
	
	//Check if event name has been entered
	if($event_name == ""){
		$validForm = false; //set valid form to false
		
		$nameErrMsg = "Event name cannot be spaces"; //Name error message
	}
}
//Validate event desceription function.
//Event must be descript for clarity

function validateEventDescription(){
	//Use global variables created above
	global $event_description, $descriptErrMsg, $validForm;
	
	$descriptErrMsg = "";// clear error message
	
	//Check if event description has been entered
	if($event_description == ""){
		$validForm = false;
		
		$descriptErrMsg = "Must descript event"; // Set error message
	}
}
//Function to validate date
function validateDate(){
	//Use global variables created above
	global  $event_date, $dateErrMsg, $validForm;
	
	$dateErrMsg = "";// clear error message
	
	if($event_date == ""){
		$validForm = false; //Set form to be invalid
		
		$dateErrMsg = "Must enter event date";
	}
}
//Function to validate or event time is entered on the form
function validateTime(){
	//Use global variables created above
	global $event_time, $timeErrMsg, $validForm;
	
	$timeErrMsg = ""; //Clear tiem error message
	
	if($event_time == ""){
		$validForm = false; //Set valid form to false
		
		$timeErrMsg = "Must enter time of event";//Time error message
	}
}
//Check if form has been submitted
if(isset($_POST['submit'])){
	$event_name = $_POST['event_name'];
	$event_description = $_POST['event_description'];
	$event_date = $_POST['event_date'];
	$event_time = $_POST['event_time'];
	
	$validForm = true; //Set valid form to true
	
	validateEventName();//Call event name validation function
	validateEventDescription();//Call event description validation function
	validateDate();//Call event date validation function
	validateTime();//Call event time validation function
}

if($validForm){
	include 'insertEvent.php';

}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>WDV341 Intro PHP Form </title>



<style>

	#container	{
		width:960px;
		background-color:lightblue;
		margin:auto;
			
	}
	#button1{
		background-color: #411A1A;
			color:whitesmoke;
			font-size: 16px;
		padding: 5px;
	}
	
</style>

</head>

<body>
	<div id="container">
		<p>
			<a href= "homework.htm"><button id="button1" name="button1">Homework page</button></a>
		
		</p>
        <h1>WDV341 Intro PHP</h1>
        <h2>Unit-6 SQL Insert</h2>
        <h3>Input Form Example</h3>
        <p>This form will gather information from the user. When submitted the form will call a server side PHP program. That program will use the form information to create and insert a record into the wdv341_event table in the database.</p>
		
		<?php
		if($validForm)
		{	
	?>
	<h3>Thank you!</h3>
	<p>Your registration has been received</p>
	<?php
		}
	else
	{
	?>
        <form name="form1" method="post" action="insertEvent.php">
          <p>
            <label>Event Name:
              <input type="text" name="event_name" id="event_name" size="40" value="<?php echo $event_name  ?>">
				<span><?php echo $nameErrMsg ?></span>
            </label>
          </p>
          <p>
            <label>Event Descript:
              <input type="text" name="event_description" id="event_description" size="100"  value="<?php echo $event_description  ?>">
				<span><?php echo $descriptErrMsg ?></span>
            </label>
          </p>
          <p>
            <label>Event Date:
              <input type="date" name="event_date" id="event_date"  value="<?php echo $event_date  ?>">
				<span><?php echo $dateErrMsg ?></span>
            </label>
          </p>
          <p>
            <label>Event Time:
              <input type="time" name="event_time" id="event_time"  value="<?php echo $event_time  ?>">
				<span><?php echo $timeErrMsg ?></span>
            </label>
          </p>
          <p>
            <input type="submit" name="button" id="button" value="Submit">
            <input type="reset" name="button2" id="button2" value="Reset">
          </p>
        </form>
        <p>&nbsp;</p>
    </div>
	<?php
	}
	?>
</body>
</html>