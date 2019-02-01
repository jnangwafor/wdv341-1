<?php
	if( isset($_POST['uploadButton']) )
	{
		$target_dir = "uploadImages/";
		$target_file = $target_dir . basename($_FILES["inFile"]["name"]);
		$validUpload = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));		
	
		//upload the file
		
		if ($validUpload == 0) {
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["inFile"]["tmp_name"], $target_file)) {
				echo "The file ". basename( $_FILES["inFile"]["name"]). " has been uploaded.";
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
		}		
		

	}
	else{
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
	<style>
		 #button1{
		background-color: #411A1A;
			color:whitesmoke;
			font-size: 16px;
	}
	</style>
</head>

<body>
	<p>
	<a href= "homework.htm"><button id="button1" name="button1">Homework page</button></a>
	</p>
<h1>WDV341 Intro PHP</h1>
<h2>File Upload</h2>

<p>&nbsp;</p>

    <form method="post" enctype="multipart/form-data" name="form1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <p>
        <label for="imageName">Picture Name</label>
        <input type="text" name="imageName" id="imageName">
      </p>
      <p>
        <label for="inFile">Select Image </label>
        <input type="file" name="inFile" id="inFile">
      </p>
      <p>
        <input type="submit" name="uploadButton" id="button" value="Upload File">
        <input type="reset" name="button2" id="button2" value="Reset">
      </p>
    </form>

<p>&nbsp;</p>
<?php
	}//close isset() 
?>
</body>
</html>