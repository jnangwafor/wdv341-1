<?php 
//session_start();
include "connectPDO.php";







	


$id = 0;
if(isset($_GET['del'])){
	$id = $_GET['del'];
	require "connectPDO.php";
	
	 $sql = "DELETE  FROM Products WHERE prod_id=$id";
	//PREPARE the SQL statement
		  $stmt = $conn->prepare($sql); // prepare statement
		  
	if($stmt->execute()){// execute the prepared statement
		$_SESSION['message'] = "Record deleted"; //display confirmation message
	header('location: selectProducts.php'); //Redirect back to process.php page
	}
	else{
		$_SESSION['message'] = "Problem deleting records"; //display confirmation message
		header('location: selectProducts.php'); //Redirect back to process.php page
	}
	
}//end delete
?>
