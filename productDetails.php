<?php
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
$prod_image="";

//Fetch records to update
      if(isset($_GET['edit'])){
	     $prod_id  = $_GET['edit'];
	
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
	<style>
		body{
			background-color: #CAD3D1;
		}
		.container-div{
			width: 80%;
			
			margin: auto;
			padding: 10px;
		}
		.center-div{
		
			
		}
		.image-div{
			margin-top: 80px;
			float: left;
			width: 25%;
			overflow: hidden;
			height: 200px;
			
		}
		.detail-div{
			margin-top: 80px;
			float: left;
			width: 55%;
			overflow: hidden;
			height: 200px;
			background-color: #BDE2F2;
		
		}
		@media screen and (max-wdth: 600px){
			.detail-div, .image-div {
				width: 100%;
			}
		}
	</style>
</head>

<body>
	<div class="container-div">
		<div class="center-div">
		<div class="image-div">
		   <?php echo "<img src='uploadImages/. $prod_image;'/>" ?>
		</div>
		<div class="detail-div">
			<span>Product Name: <?php echo $prod_name; ?></span><br>
			<span>Selling Now at: <?php echo $prod_price; ?></span><br>
			<span>Category: <?php echo $prod_category; ?></span><br>
			<span>Product Type: <?php echo $prod_type; ?></span><br>
			<span>Description: <?php echo $prod_description; ?></span><br>
			<span>Date posted: <?php echo $prod_date; ?></span>
		</div>
		</div>
		
	</div>
</body>
</html>