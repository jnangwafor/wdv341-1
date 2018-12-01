<?php
//Create variables and instantiate them
$inName = "";
$inSocial = "";
$RadioGroup1 = "";
$spamBot = "";
$message = "";

$validForm = false; //Set valid form to false

$nameErrMsg = ""; //Holds error message for name input
$socialErrMsg = ""; // Holds error message for social security input
$RadioErrMsg = ""; // hplds error message for radio group response

include "validateForm.php"; //Get Validation functions


if(isset($_POST['submit'])) //check if form has been submitted
	{
		//Pull data from post variable and validate
		$inName = $_POST['inName'];
		$inSocial = $_POST['inSocial'];
		if(isset($_POST['RadioGroup1'])){
			$RadioGroup1 = $_POST['RadioGroup1'];
		}
			$spamBot = $_POST['spamBot'];
		
		$validForm = true; // set valid form to true
		
		validateName(); // call name validation function
		validateSocials(); // call social security validation function
		if(!validResponse($RadioGroup1))// Call response validation function
		{
			$validForm = false;
			$RadioErrMsg = "Must choose a response";
		}
		if($spamBot !==""){
			echo "You are not human";
			$validForm = false;
		}
		
}
 if($validForm){
	 include 'registration.php';
	
	
}
if(empty($inSocial)){
	echo "No data";
		echo $inSocial;
}

else{
	echo $message;
}

?>

<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WDV341 Intro PHP - Form Validation Example</title>
	
	<script>
		function resetForm()
		{
			document.getElementById('form1').reset();
			document.getElementById('inSocial').value = "";
		}
	</script>
<style>

#orderArea	{
	width:600px;
	background-color:#CF9;
	
}

.error	{
	color:red;
	font-style:italic;	
}
	.hide{
		display: none;
	}
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
<h2>Form Validation Assignment


<?php
		if($validForm )
		{	
	?>
	<h3>Thank you!</h3>
	<h4>Your registration has been received</h4>
	
	<?php
		}
	else
	{
	?>
	
</h2>
<div id="orderArea">
  <form id="form1" name="form1" method="post" action="formValidationAssignment.php">
  <h3>Customer Registration Form</h3>
	  <p class="error">*Required field</p>
  <table width="587" border="0">
    <tr>
      <td width="117">Name:</td>
      <td width="246"><input type="text" name="inName" id="inName" size="40" value="<?php echo $inName; ?>"/></td>
      <td width="210" class="error">* &nbsp;<?php echo $nameErrMsg; ?></td>
    </tr>
    <tr>
      <td>Social Security</td>
      <td><input type="text" name="inSocial" id="inSocial" size="40" value="<?php echo $inSocial; ?>" /></td>
      <td class="error">* &nbsp;<?php echo $socialErrMsg; ?></td>
    </tr>
	  <tr class="hide">
		  <td>Leave blank</td>
	  	<td><input type="text" name="spamBot" id="spamBot" autocomplete="off"/> </td>
	  </tr>
	  
    <tr>
      <td>Choose a Response</td>
      <td><p>
        <label>
          <input type="radio" name="RadioGroup1" id="RadioGroup1_0" value="Phone" <?php if($RadioGroup1 == 'RadioGroup1_0'){echo 'checked';}  ?>>
          Phone</label>
        <br>
        <label>
          <input type="radio" name="RadioGroup1" id="RadioGroup1_1" value="Email" <?php if($RadioGroup1 == 'RadioGroup1_1'){echo 'checked';}  ?>>
          Email</label>
        <br>
        <label>
          <input type="radio" name="RadioGroup1" id="RadioGroup1_2" value="US Mail" <?php if($RadioGroup1 == 'RadioGroup1_2'){echo 'checked';}  ?>>
          US Mail</label>
        <br>
      </p></td>
      <td class="error">* &nbsp;<?php echo $RadioErrMsg; ?></td>
    </tr>
  </table>
  <p>
    <input type="submit" name="submit" id="button" value="Register" />
    <input type="reset" name="button2" id="button2"  onClick="resetForm()" value="Clear Form" />
  </p>
</form>
</div>
<?php
	}
	?>
<?php
		if($stmt->execute())
		{
			
	?>
	 
	<p>See your information below.</p>
	<div id="orderArea">
  <form id="form1" name="form1" method="post" action="registration.php">
  <h3>Customer Registration Form</h3>
	  
  <table width="587" border="0">
    <tr>
      <td>Name:</td>
      <td><input type="text" name="inName" id="inName" size="40" value="<?php echo $inName; ?>"/></td>
      
    </tr>
    <tr>
      <td>Social Security:</td>
      <td><input type="text" name="inSocial" id="inSocial" size="40" value="<?php echo $inSocial; ?>" /></td>
    
    </tr>
	  
	  
    <tr>
      <td>Choose a Response:</td>
      <td>
     	  <input type="text" name="RadioGroup1" id="RadioGroup1" value="<?php echo $RadioGroup1; ?>"/></label></p></td>
        
    </tr>
  </table>
		</form>
</div>
	<?php
		}
	else
	{
?>
	<?php
		echo $message;
	}
	?>
&nbsp;
</body>
</html>