<?php
//validate name function
function validateName(){
	global $user_name, $nameErrMsg, $validForm;// global variables
	$nameErrMsg = ""; //clear name error message
	
	//check if name is empty
	if($user_name ==""){
		$validForm = false;
		$nameErrMsg = "Name cannot be spaces";
	}
	
}
//function to validate email
function validateEmail()
{
	global $user_email, $validForm, $emailErrMsg;	//Use the GLOBAL Version of these variables instead of making them local
	$emailErrMsg = "";							//Clear the error message. 
		
												//Using a Regular Expression to FORMAT VALIDATION email address
	if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$user_email))		//Copied straight from W3Schools.  Uses a Regular Expression
  	{
		$validForm = false;
  		$emailErrMsg = "Invalid email format"; 
  	}		
}
//Validate title
function validateTitle(){
	global $message_title, $titleErrMsg, $validForm;// global variables
	$titleErrMsg = ""; //clear name error message
	
	//check if name is empty
	if($message_title ==""){
		$validForm = false;
		$titleErrMsg = "Title cannot be spaces";
	}
	
}
//function to validate message
function validateMessage(){
	global $message_details, $descErrMsg, $validForm;// global variables
	$descErrMsg = ""; //clear name error message
	
	//check if name is empty
	if($message_details ==""){
		$validForm = false;
		$descErrMsg = "Please enter a message";
	}
	
}
if(!empty($robot))
	{
		echo "You are not human";
		
	}
?>