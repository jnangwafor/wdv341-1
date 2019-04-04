<?php
include "productList.php";

//Create and initialize variables
$prod_id =0;

$prod_name ="";
$prod_category ="";
$prod_type ="";
$prod_quantity ="";
$prod_cost ="";
$prod_price ="";
$prod_description ="";
$prod_date ="";
$edit_state = false;

$nameErrMsg = "";
$categoryErrMsg = "";
$typeErrMsg = "";
$quanErrMsg = "";
$costErrMsg = "";
$priceErrMsg = "";
$descErrMsg = "";

$validForm = false;

try{
	//connect to the database
	require "connectPDO.php";
	//create a select query
	$sql = "SELECT * FROM products";
	
	//Prepare statement
	$stmt = $conn->prepare($sql);
	
	//Execute statement
	$stmt->execute();
	
	
		$stmt->setFetchMode(PDO::FETCH_ASSOC);	
		  
		  $row=$stmt->fetch(PDO::FETCH_ASSOC);
}
		
 catch(PDOException $e)
	  {
		  $message = "There has been a problem. The system administrator has been informed. Please try again later.";
	
		  error_log($e->getMessage());			//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
		  error_log($e->getLine());
		  error_log(var_dump(debug_backtrace()));
	  
		  //Clean up any variables or connections that have been left hanging by this error.		
	  
		 header('Location: files/505_error_response_page.php');	//sends control to a User friendly page					
	  }	
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Process Records</title>
	<link rel="stylesheet" type="text/css" href="CSS/pStyle.css">
	<link href="CSS/portfolioIndex.css" rel="stylesheet" type="text/css"/>
	
</head>
	
<body>
	<?php
		include "portfolioHeader.php";
		include "sideNav.php";
		include "welcome.php"; 
	?>
	<h1>Products Table</h1>
	<h2>Create, Update and Delete</h2>
	
	<table  cellpadding="4" cellspacing="0">
	
	
	<tr>
				
				<th>Name</th>
				<th>Category</th>
				<th>Type</th>
				<th>Quantity</th>
				<th>Cost</th>
				<th>Price</th>
				<th >Description</th>
				<th colspan="2">Action</th>
			</tr>
	<?php 
	while ($results = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		echo "<tr>";
			echo "<td>" . $results['prod_name'] . "</td>";
			echo "<td>" . $results['prod_category'] . "</td>";	
			echo "<td>" . $results['prod_type'] . "</td>";
			echo "<td>" . $results['prod_quantity'] . "</td>";
			echo "<td>" . $results['prod_cost'] . "</td>";
			echo "<td>" . $results['prod_price'] . "</td>";
			echo "<td>" . $results['prod_description'] . "</td>";
			echo "<td><a href='updateProducts.php?edit=".$results['prod_id'] . "'>Edit</a></td>"; 
			echo "<td><a href='selectProducts.php?del=".$results['prod_id'] . "'>Delete</a></td>"; 		
		echo "</tr>";
	}
?>
	
	</table >
	
	</body>
</html>
	
	
	