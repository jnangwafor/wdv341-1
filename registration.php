<?php
require 'connectPDO.php';// Connect to the database
	
	try //try catch block for any errors
	{
		//Pull data from post variable and validate
		$inName = $_POST['inName'];
		$inSocial = $_POST['inSocial'];
		if(isset($_POST['RadioGroup1'])){
			$RadioGroup1 = $_POST['RadioGroup1'];
		}
			
		//Create an insert command to input data into the database
		$sql = "INSERT INTO customer_registration(";
	$sql.= "name,";
	$sql.= "social_security,";
	$sql.= "response_type";
	$sql.= ")VALUES (:in_Name, :in_Social, :radioGroup1)";
	
	$stmt = $conn->prepare($sql);	//prepare the SQL statement
	
	
	//bind placeholder to a value
	
	$stmt->bindParam(':in_Name', $inName);
	$stmt->bindParam(':in_Social', $inSocial);
	$stmt->bindParam(':radioGroup1', $RadioGroup1);
	
		
		//Execute the prepare statement
		$stmt->execute();
		}
	catch (PDOException $e){
		$message = "There was a problem. Please try again later.";
		error_log($e->getMessage());
		//error_log(var_dump(debug_backtrace()));
		
		//header('Location: files/505_error_response_page.php');	
	}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
	
</body>
</html>