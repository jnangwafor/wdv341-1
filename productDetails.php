<?php
//Create and initialize variables
$prod_id =0;

$prod_name ="";
$prod_category ="";
$prod_type ="";
$prod_quantity ="";

$prod_price ="";
$prod_description ="";
$prod_date ="";
$prod_image="";

//Fetch records to update
      if(isset($_GET['detail'])){
	     $prod_id  = $_GET['detail'];
	
	    // $edit_state = true; //change edit state to true
		
		try{
			//connect to the database
			require "connectPDO.php";
			//create a select query
			$sql = "SELECT  p.prod_id, p.prod_name, p.prod_category, p.prod_price, p.prod_type, p.prod_quantity, p.prod_description, p.available_date, c.image_name FROM products p LEFT JOIN products_images c USING(prod_id) WHERE prod_id=$prod_id";
			
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
				$prod_price =$record['prod_price'];
				$prod_image =$record['image_name'];

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
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
	<meta name="viewport" content="width=device-width, initial-scale=1", user-scalable="no">
	<link href="CSS/productDetails.css" rel="stylesheet" type="text/css"/>
	 
	<script src="Javascript/productDisplay.js"></script>
</head>

<body >
	<?php include "portfolioHeader.php"; ?>
	
	<a href= "products.php"><button id="button1" name="button1">Back to Products</button></a>
	
	<div class="container-div" >
		<div class="image-div">
		   <img src="uploadImages/<?php echo $prod_image; ?>" width="200" height="250"/>
		</div>
		<div class="detail-div">
			<p>Product Name: </p>
			
			<p>Selling Now at: </p>
			<p>Category: </p>
			
			<p>Product Type: </p>
			<p>Date posted: </p>
			<p>Description: </p>
			
		</div>
			<div class="in-div" id="inDisplay">
			<p> <?php echo $prod_name; ?></p>
			<p id="inPrice"> <?php  echo "<script>document.write(formatCurrency($prod_price)); </script>" ?></p>
			<p> <?php echo $prod_category; ?></p>
			
			<p><?php echo $prod_type; ?></p>
			
			<p id="inDate" ><?php echo $prod_date; ?> </p>
			<p><?php echo $prod_description."\n..\n"; ?></p>

			</div>
		</div>
		
		
		
	
	<?php include "footer.php"; ?>
</body>
</html>