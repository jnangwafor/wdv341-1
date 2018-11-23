<?php
//function to  validate name
function validateName(){
	//Global version of already created variables
	global $inName, $nameErrMsg, $validForm;
	
	$nameErrMsg = ""; //Clear name error message
	
	//Check if name is empty
	if($inName == ""){
		$validForm = false; // form is invalid
		//Create error message foe name field
		$nameErrMsg = "Name is required!";
	}
}
/*Function to validate social security
1.social security must be numbers--contain no special 	   characters.
2. Social security must be 9digits
*/
function validateSocials(){
	//Use the global form of created variables
	global $inSocial, $validForm, $socialErrMsg;
	
	$socialErrMsg = ""; //Clear social security error message
	
	//Check if social security is an integer
	if(!preg_match('/^[1-9][0-9]{8}$/', $inSocial)){
		$validForm = false; //Set valid form to false
		
		//Create error message
		$socialErrMsg = "Must be 9 digits (0-9) only";
	}
	
}
//function to validate response
function validResponse($input)
	{
		if($input == ""){
			return false;
		}
		else{
			return true;
		}
	}
?>