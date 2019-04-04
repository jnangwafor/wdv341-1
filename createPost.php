<?php
session_start();
include "connectPDO.php";

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
$validForm = false;
$productSaved = false;
$lastInsertId = 0;
$nameErrMsg = "";
$categoryErrMsg = "";
$typeErrMsg = "";
$quanErrMsg = "";
$costErrMsg = "";
$priceErrMsg = "";
$descErrMsg = "";

	//If save button is click

if(isset($_POST['save'])){
		$prod_name =	$_POST['prod_name'];
		$prod_category =	$_POST['prod_category'];
		$prod_type =	$_POST['prod_type'];
		$prod_quantity =	$_POST['prod_quantity'];
		$prod_cost =	$_POST['prod_cost'];
		$prod_price =	$_POST['prod_price'];
		
		$prod_description = $_POST['prod_description'];
	
	include "validateProduct.php";// include product form validation 
		$validForm = true; //set valid form to true
		
		validateName();// call  validate name input
		validateCategory();// call validate category input
		validateType();// call validate type input
		validateQuantity();//call validate quantity input
		validateCost();// call validate cost input
		validatePrice();//call validate price input
	
	if($validForm){
		$target_dir = "uploadImages/";
		
	     $todaysDate = date("Y-m-d");// hold date file was uploaded in a "year-month-date" format.
		
		 $allowTypes = array('jpg','png','jpeg','gif');//Allowed file formats
    
    $statusMsg = $errorMsg = $insertImage = $errorUpload = $errorUploadType = ''; //Variables for error messages
		
    if(!empty(array_filter($_FILES['files']['name']))){
		
		//for each loop to add multiple files.
        foreach($_FILES['files']['name'] as $key=>$val){
			
            // File upload pathway
            $imageName = basename($_FILES['files']['name'][$key]);
            $targetFilePath = $target_dir . $imageName;
            
            // Check whether file type is valid
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
			
            if(in_array($fileType, $allowTypes)){
				
                // Upload file to server
                if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){
                    // Insert image sql 
                    $insertImage .= "('".$imageName."'),";
                }else{
                    $errorUpload .= $_FILES['files']['name'][$key].', ';
                }
            }else{
                $errorUploadType .= $_FILES['files']['name'][$key].', ';
            }
        }
		try{
					require 'connectPDO.php';	//CONNECT to the database
					
					$todaysDate = date("Y-m-d");		//use today's date as the default
					
					//create insert commands to input data into the database
					$sql = "INSERT INTO products(";
					$sql.= "prod_name,";
					$sql.= "prod_category,";
					$sql.= "prod_type,";
					$sql.= "prod_quantity,";
					$sql.= "prod_cost,";
					$sql.= "prod_price,";
					$sql.= "prod_description,";
					$sql.= "available_date";
					$sql.= ")VALUES (:prodName, :prodCategory, :prodType, :prodQuantity, :prodCost, :prodPrice, :prodDescription, :AvailableDate)";
					
					//PREPARE the SQL statement
				$statment = $conn->prepare($sql);
				
				//BIND the values to the input parameters of the prepared statement
				$statment->bindParam(':prodName', $prod_name);
				
				$statment->bindParam(':prodCategory', $prod_category);
					$statment->bindParam(':prodType', $prod_type);
				$statment->bindParam(':prodQuantity', $prod_quantity);
				
				$statment->bindParam(':prodCost', $prod_cost);
				
				$statment->bindParam(':prodPrice', $prod_price);
				$statment->bindParam(':prodDescription', $prod_description);
					
				  $statment->bindParam(':AvailableDate', $todaysDate);
					
				
				//EXECUTE the prepared statement
				$success = $statment->execute();	
				if($success)	{
			$_SESSION['message'] = "Record created"; //display confirmation message
					$lastInsertId = $conn->lastInsertId();
					$productSaved = true;
		      // header('location: index.php'); // redirect back to portfolioProject.php
				}
				}
				CATCH (PDOException $e)
					{
				$_SESSION['message'] = "There has been a problem. The system administrator has been contacted. Please try again later.";
				$productSaved = false;
				error_log($e->getMessage());			//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
				error_log(var_dump(debug_backtrace()));
				
			
				//header('Location: files/505_error_response_page.php');				
				}		
}

		
		
        
        if(!empty($insertImage)){
            $insertImage = trim($insertImage,',');
			
            try{
					require 'connectPDO.php';	//CONNECT to the database
					
					$todaysDate = date("Y-m-d");		//use today's date as the default
					
					//create insert commands to input data into the database
					$sql = "INSERT INTO products_images(";
					$sql.= "prod_id,";
					$sql.= "image_name,";
					$sql.= "upload_date";
					$sql.= ")VALUES ( :productID, :imageName,:imageUploadDate)";
					
					//PREPARE the SQL statement
				$statment = $conn->prepare($sql);
				
				//BIND the values to the input parameters of the prepared statement
				$statment->bindParam(':productID', $lastInsertId);
				$statment->bindParam(':imageName', $insertImage);	
				$statment->bindParam(':imageUploadDate', $todaysDate);
					
				
				//EXECUTE the prepared statement
				$successful = $statment->execute();	
					
				}
				CATCH (PDOException $e)
					{
				$message = "There has been a problem. The system administrator has been contacted. Please try again later.";
	
				error_log($e->getMessage());			//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
				
				
			
							
				}
			}
			
            if($successful){
				
                $errorUpload = !empty($errorUpload)?'Upload Error: '.$errorUpload:'';
                $errorUploadType = !empty($errorUploadType)?'File Type Error: '.$errorUploadType:'';
                $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType;
                $statusMsg = "Files are uploaded successfully.".$errorMsg;
            }else{
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        }
    else{
        $statusMsg = 'Please select a file to upload.';
    }
    
    // Display status message
    echo $statusMsg;

	}//end save
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Create Post</title>
	<meta name="viewport" content="width=device-width, initial-scale=1", user-scalable="no">
	<link href="CSS/createPost.css" rel="stylesheet" type="text/css"/>
	<script>
		//This function count the number of files upload and make sure at least more than one file must be uploaded
		function fileUploadRules(){
			var uploadFile = document.getElementById("files").value; //get the value of uploaded file
			var counter ; // counter to check number of file in array
			for(counter = 0; counter< uploadFile.length; counter ++){
				console.log(counter);
			}
			if(counter <2){
				alert("Please enter at least 2 pictures of your product");
			}
			else {
				alert(counter + " images uploaded");			}
			
		}
	</script>
</head>

<body>
	<?php  
	include "portfolioHeader.php";
	include "sideNav.php";
	?>
	<h1>Create Post</h1>
	<h2>Post Anything for Sales</h2>
	<?php if(isset($_SESSION['message'])){  ?>
	<div class="infoMsg">
		<span><?php echo $_SESSION['message']; }?></span>
	</div>
	<?php
	if($validForm){
	$_SESSION['message'] = "Ready to create post";
}
	else{
?>
	<form name="form1" method="post" enctype="multipart/form-data"   action="">
		<input type="hidden" name="prod_id" value="<?php echo $prod_id; ?>">
		
		<div class="input-group">
			<lable>Product Name</lable><br>
			<input type="text" name="prod_name"  value="<?php echo $prod_name; ?>">
			<span class="errorMsg"><?php echo $nameErrMsg?></span>
			
		</div>
			<div class="input-group">
			<lable>Category</lable><br>
			<input type="text" name="prod_category"  value="<?php echo $prod_category; ?>">
				<span class="errorMsg"><?php echo $categoryErrMsg?></span>
		</div>
			<div class="input-group">
			<lable>Product Type</lable><br>
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
		<div class="upload-images">
      <p>
        <label for="inFile">Select Image </label>
         <input type="file" id="files" name="files[]" multiple >
      </p>
      
		</div>
		<div class="input-group">
			
			<button type="submit" onsubmit= return uploadFileRules(); name="save" class="btn">Save</button>	
			<input type="reset" name="button2" id="button2" class="btn"value="Reset">	
		</div>
	</form>
	
	
	<br>
	<br>
	
	
	<?php  
		}//end if validform
	include "footer.php";
		
	?>
</body>
</html>