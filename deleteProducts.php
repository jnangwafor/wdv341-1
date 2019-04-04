<?php
$id = 0;
if(isset($_GET['del'])){
	$id = $_GET['del'];
	require "connectPDO.php";
	
	 $sql = "DELETE  FROM Products WHERE prod_id=$id";
	//PREPARE the SQL statement
		  $stmt = $conn->prepare($sql); // prepare statement
		  
	if($stmt->execute()){// execute the prepared statement
		$_SESSION['message'] = "Record Deleted";
	header('location: productList.php'); //Redirect back to process.php page
	}
	else{
		$_SESSION['message'] = "Unable to delete record.";
		header('location: productList.php'); //Redirect back to process.php page
	}
}//end delete
?>