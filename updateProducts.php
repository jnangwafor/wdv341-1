<?php
//session_start();
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


$nameErrMsg = "";
$categoryErrMsg = "";
$typeErrMsg = "";
$quanErrMsg = "";
$costErrMsg = "";
$priceErrMsg = "";
$descErrMsg = "";
$validForm = false;


//Update records
	if(isset($_POST['update'])){
		$prod_name =	$_POST['prod_name'];
		$prod_category =$_POST['prod_category'];
		$prod_type =$_POST['prod_type'];
		$prod_quantity =$_POST['prod_quantity'];
		$prod_cost =$_POST['prod_cost'];
		$prod_price =$_POST['prod_price'];
		$prod_id =$_POST['prod_id'];
		$prod_description = $_POST['prod_description'];
		
		include "validateProduct.php";// include product form validation 
		$validForm = true; //set valid form to true
		
		validateName();// call  validate name input
		validateCategory();// call validate category input
		validateType();// call validate type input
		validateQuantity();//call validate quantity input
		validateCost();// call validate cost input
		validatePrice();//call validate price input
		validateDescription();//call validate price input
		
		if($validForm){
			try{
		require "connectPDO.php";
		
		//Create sql update query
		$sql = "UPDATE products SET 
		prod_name = :prodName, 
		prod_category = :prodCategory,
		prod_type = :prodType,
		prod_quantity = :prodQuantity,
		
		prod_cost = :prodCost,
		prod_price = :prodPrice,
		prod_description = :prodDescription
		WHERE prod_id = :prodId";
		
			//PREPARE the SQL statement
				$statement = $conn->prepare($sql);
				
				//BIND the values to the input parameters of the prepared statement
				$statement->bindParam(':prodName', $prod_name, PDO::PARAM_STR);
				
				$statement->bindParam(':prodCategory', $prod_category, PDO::PARAM_STR);		
				
				$statement->bindParam(':prodType', $prod_type, PDO::PARAM_STR);
				$statement->bindParam(':prodQuantity', $prod_quantity, PDO::PARAM_INT);
				$statement->bindParam(':prodCost', $prod_cost, PDO::PARAM_INT);
				$statement->bindParam(':prodPrice', $prod_price, PDO::PARAM_INT);
				$statement->bindParam(':prodDescription', $prod_description, PDO::PARAM_STR);
				$statement->bindParam(':prodId', $prod_id, PDO::PARAM_INT);
		
		//EXECUTE the prepared statement
		$statement->execute();	
				
		
		       header('location: updateProducts.php'); // redirect back to portfolioProject.php
		
	}
		catch(PDOException $e)
			{
				$_SESSION['message'] = "There has been a problem. The system administrator has been contacted. Please try again later.";
	
				error_log($e->getMessage());			//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
				error_log(var_dump(debug_backtrace()));
			
				//Clean up any variables or connections that have been left hanging by this error.		
			
				header('Location: files/505_error_response_page.php');	//sends control to a User friendly page					
			}
		
		if($statement->execute()){
			$_SESSION['message'] = "Record Updated";
			header("location: updateProducts.php");
		}
	}//end update
	}//end if validform	
			
else{
	//Fetch records to update
      if(isset($_GET['edit'])){
	     $prod_id  = $_GET['edit'];
	
	    // $edit_state = true; //change edit state to true
		
		try{
			//connect to the database
			require "connectPDO.php";
			//create a select query
			$sql = "SELECT * FROM products WHERE prod_id=$prod_id";
			
			//Prepare statement
			$rec = $conn->prepare($sql);

			//Execute statement
			$rec->execute();

			//check for execution and produce associative array
			if($rec->execute()){
				$rec->setFetchMode(PDO::FETCH_ASSOC);	
				  
				  $record=$rec->fetch(PDO::FETCH_ASSOC);

				$prod_id =$record['prod_id'];
				$prod_name =$record['prod_name'];
				$prod_category =$record['prod_category'];
				$prod_type =$record['prod_type'];
				$prod_quantity =$record['prod_quantity'];
				$prod_cost =$record['prod_cost'];
				$prod_price =$record['prod_price'];
				$prod_description =$record['prod_description'];
				$prod_date =$record['available_date'];
				
				
		}

		}
		 catch(PDOException $e)
			  {
				  $_SESSION['message'] = "There has been a problem.  Please try again later.";

				  error_log($e->getMessage());			//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
				  error_log($e->getLine());
				  error_log(var_dump(debug_backtrace()));

				  //Clean up any variables or connections that have been left hanging by this error.		

				  header('Location: files/505_error_response_page.php');	//sends control to a User friendly page					
			}


	  }//end if isset()
}//close else

try{
	//connect to the database
	require "connectPDO.php";
	//create a select query
	$sql = "SELECT * FROM products";
	
	//Prepare statement
	$stmt = $conn->prepare($sql);
	
	//Execute statement
	$stmt->execute();
	
	
		//$stmt->setFetchMode(PDO::FETCH_ASSOC);	
		  
		  
}
		
 catch(PDOException $e)
	  {
		  $_SESSION['message'] = "There has been a problem. The system administrator has been informed. Please try again later.";
	
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
<title>Udapte Records</title>
	<link rel="stylesheet" type="text/css" href="CSS/pStyle.css">
</head>
	
<body>
	<?php
		include "portfolioHeader.php";
		include "sideNav.php";
		include "welcome.php"; 
	?>
	<h1>Products Table</h1>
	<h2> Update Products Table</h2>
	
	
	<?php if(isset($_SESSION['message']));{  ?>
	<div class="infoMsg">
		<span><?php echo $_SESSION['message']; }?></span>
	</div>
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
					
		echo "</tr>";
	}
?>
	
	</table >
	<?php
	if($validForm){
		$message = "All good";
	}
	else{
		
	
	?>
	
	<form name="form1" method="post" action="">
		<input type="hidden" name="prod_id" value="<?php echo $prod_id; ?>">
		<div class="input-group">
			<lable>Name</lable><br>
			<input type="text" name="prod_name"  value="<?php echo $prod_name; ?>">
			<span class="errorMsg"><?php echo $nameErrMsg?></span>
			
		</div>
			<div class="input-group">
			<lable>Category</lable><br>
			<input type="text" name="prod_category"  value="<?php echo $prod_category; ?>">
				<span class="errorMsg"><?php echo $categoryErrMsg?></span>
		</div>
			<div class="input-group">
			<lable>Type</lable><br>
			<input type="text" name="prod_type"  value="<?php echo $prod_type; ?>">
				<span class="errorMsg"><?php echo $typeErrMsg?></span>
		</div>
			<div class="input-group">
			<lable>Quantity</lable><br>
			<input type="text" name="prod_quantity"  value="<?php echo $prod_quantity; ?>">
				<span class="errorMsg"><?php echo $quanErrMsg?></span>
		</div>
				<div class="input-group">
			<lable>Cost</lable><br>
			<input type="text" name="prod_cost"  value="<?php echo $prod_cost; ?>">
					<span class="errorMsg"><?php echo $costErrMsg?></span>
		</div>
			<div class="input-group">
			<lable>Price</lable><br>
			<input type="text" name="prod_price"  value="<?php echo $prod_price; ?>">
				<span class="errorMsg"><?php echo $priceErrMsg?></span>
		</div>
		
			<div class="input-group">
			<lable>Description</lable><br>
			<textarea name="prod_description" maxlength ="700"  value="<?php echo $prod_description; ?>"></textarea>
		<span class="errorMsg"><?php echo $descErrMsg?></span>
		</div>
		<div class="input-group">
			
			
			<button type="submit" name="update" class="btn">Update</button>
			
			
		</div>
	</form>
	<?php
	}
		?>
	</body>
</html>
	

