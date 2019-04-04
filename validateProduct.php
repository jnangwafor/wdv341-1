<?php
	
//Validate product name funtion. 
//Check if product name has been entered before submitting the form
function validateName(){
	//Use global variables created above
	global $prod_name, $nameErrMsg, $validForm;
	$nameErrMsg = "";
	$cleanName = preg_replace("/[^a-zA-Z]/", "", $prod_name);
	
	//Check if product name has been entered
	if($prod_name == ""){
		$validForm = false; //set valid form to false
		
		$nameErrMsg = "Name name cannot be spaces"; //Name error message
	}
	else{
		if(!$prod_name ==$cleanName){
			$nameErrMsg = "Must not contain special characters";
		}
	}
}
//Validate product category function.


function validateCategory(){
	//Use global variables created above
	global $prod_category, $categoryErrMsg, $validForm;
	$cleanCategory = preg_replace("/[^a-zA-Z]/", "", $prod_category);
	
	$categoryErrMsg = "";// clear error message
	
	//Check if product category has been entered
	if($prod_category == ""){
		$validForm = false;
		
		$categoryErrMsg = "Must enter product category. e.g. automobile, electronics, etc."; // Set error message
	}
	else{
		if(!$prod_category==$cleanCategory){
			$categoryErrMsg = "Must not contian special characters";
		}
	}
}//End validateCategory

function validateQuantity()
{
	global $prod_quantity, $validForm, $quanErrMsg;			//Use the GLOBAL Version of these variables instead of making them local
	$quanErrMsg = "";										//Clear the error message. 

	if (!preg_match("/^[1-9][0-9]*$/",$prod_quantity))			//Uses a Regular Expression to validate an integer 
  	{
		$validForm = false;
  		$quanErrMsg = "Invalid Quantity"; 
  	}
	
}//end validateQuantity

function validateType(){
	//Use global variables created above
	global $prod_type, $typeErrMsg, $validForm;
	$cleanType = preg_replace("/[^a-zA-Z]/", "", $prod_type);
	
	$typeErrMsg = "";// clear error message
	
	//Check if product type has been entered
	if($prod_type == ""){
		$validForm = false;
		
		$typeErrMsg = "Must enter product type, e.g. sedan, phone. etc."; // Set error message
	}
	else{
		if(!$prod_type==$cleanType){
			$typeErrMsg = "Must not contain special characters";
		}
	}
}
//Validate product cost
function validateCost()
{
	global $prod_cost, $validForm, $costErrMsg;			//Use the GLOBAL Version of these variables instead of making them local
	$costErrMsg = "";										//Clear the error message. 

	if (!preg_match("/^[1-9][0-9]*$/",$prod_cost))			//Uses a Regular Expression to validate an integer 
  	{
		$validForm = false;
  		$costErrMsg = "Invalid Cost"; 
  	}
	
	
}//end validateCost

//Validate product price
function validatePrice()
{
	global $prod_price, $validForm, $priceErrMsg;			//Use the GLOBAL Version of these variables instead of making them local
	$priceErrMsg = "";										//Clear the error message. 

	if (!preg_match("/^[1-9][0-9]*$/",$prod_price))			//Uses a Regular Expression to validate an integer 
  	{
		$validForm = false;
  		$priceErrMsg = "Invalid Price"; 
  	}
	
	
}//end validatePrice

	function validateDescription(){
		//Use global variables created above
	global $prod_description, $descErrMsg, $validForm;
	$descErrMsg = "";
	
	//Check if product name has been entered
	if($prod_description == ""){
		$validForm = false; //set valid form to false
		
		$descErrMsg = "Discribe your product"; //Name error message
	}
	}

?>