<?php
//create and innitialize variables to hold product information
$prod_name ="";
$prod_category ="";
$prod_type ="";
$prod_quantity ="";
$prod_cost ="";
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
	$sql = "SELECT  p.prod_id, p.prod_name, p.prod_price, c.image_name FROM products p LEFT JOIN products_images c USING(prod_id)";
	
	//Prepare statement
	$stmt = $conn->prepare($sql);
	
	//Execute statement
	$stmt->execute();
	
	
		$stmt->setFetchMode(PDO::FETCH_ASSOC);	
		  
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
		function formatPrice(){
			var priceValue = document.getElementById("inPrice").value;
		var	prod_price = formatCurrency("priceValue");
			
		}
	</script>
	<style>
		.container{
			width: 80%;
			margin: 0 auto;
		}
		.product-image{
			width: 200px;
			height: 200px;
			padding: 20px;
			display: inline-block;
		}
	</style>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body onLoad="formatPrice()";>
	<?php  
	include "portfolioHeader.php";
	?>
	<div class="container">
		<?php while( $record=$stmt->fetch(PDO::FETCH_ASSOC)){ 
			echo	"<div class='product-image'>";
				echo"<span>". $record['prod_name']."</span>";
			echo "&nbsp"; echo "&nbsp";
				echo"<span id='inPrice'>". $record['prod_price']."</span>";
				 echo "<img src='uploadImages/".$record['image_name']."width='200' height='200' alt='' '/>";
	  			echo "</div>";
} ?>
	
	</div>
	<?php  
		
	include "footer.php";
		
	?>
</body>
</html>