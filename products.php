<?php
//create and innitialize variables to hold product information
$prod_name ="";
$prod_category ="";
$prod_type ="";
$prod_quantity ="";

$prod_price ="";
$prod_description ="";
$prod_date ="";
$image_name ="";
$prod_id =0;

try
{
	//connect to the database
	require "connectPDO.php";
	//create a select query
	$sql = "SELECT  p.prod_id, p.prod_name, p.prod_price, c.image_name FROM products p LEFT JOIN products_images c USING(prod_id) ";
	
	//Prepare statement
	$stmt = $conn->prepare($sql);
	
	//Execute statement
	//check for execution and produce associative array
		$stmt->execute();
									  						  
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
function formatPrice(){
	
}
?>
<!doctype html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1", user-scalable="no">
	<link href="CSS/displayProduct.css" rel="stylesheet" type="text/css"/>
	<script>
		function formatCurrency(inValue)
		{
			
			var formatter = new Intl.NumberFormat('en-US', 
				{
					style: 'currency',
					currency: 'USD',
					minimumFractionDigits: 2
				})

			return (formatter.format(inValue));
		}
	
	</script>
	<style>
		
	</style>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
	<?php  
	include "portfolioHeader.php";
	if($stmt->rowCount() > 0)
	{
		while($record=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			$prod_id =$record['prod_id'];
			$prod_name =$record['prod_name'];
			$prod_price =$record['prod_price'];
			$image_name = $record['image_name'];
	?>
	
	
	<div class="container">
		
		 <div class="product-image">
			<span id="product-name"><?php echo $prod_name; ?></span>&nbsp;&nbsp;
		<span id="product-price"><?php echo "<script>document.write(formatCurrency($prod_price)); </script>"?></span>
		<a href="productDetails.php?detail=<?php echo $record['prod_id']; ?>"><img src="uploadImages/<?php echo $image_name ?>" width="200" height="200"/></a>
		
		<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	    </div>
	
	</div>
	
	<?php 
		} 
	}
	?>
	
	<?php  
		
	include "footer.php";
		
	?>
</body>
</html>