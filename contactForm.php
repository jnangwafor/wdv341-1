<?php
include "portfolioHeader.php";
//Create  and innitialized Variables
$user_name ="";
$user_email ="";
$message_title ="";
$message_details ="";
$nameErrMsg ="";
$emailErrMsg ="";
$titleErrMsg ="";
$descErrMsg ="";
$message ="";

$validForm = false;
include "validateContactForm.php";

//check if form is submitted
if(isset($_POST['submit'])){
	$user_name = $_POST['user_name'];
	$user_email = $_POST['user_email'];
	$message_title = $_POST['title_name'];
	$message_details = $_POST['form_message'];
	
	$validForm = true; //set valid form to true
	
	validateName(); //call name validation function
	validateEmail(); //call email validation function
	validateTitle(); //call title validation function
	validateMessage(); //call massage validation function
}
if($validForm){
	/*
		include "Emailer.php";
	$sendMail = new Emailer();//create a new instance of the emailer class
	$sendMail->setSendToAdress("contact@wdv341.spysportworld.com");//set send to address
	$sendMail->setSenderAddress($user_email);//set sender email address
	$sendMail->setSubjectLine($message_title); //set subjectline
	$sendMail->setMessageLine($message_details);//set message body
	
	if($sendMail->sendPHPMail()) //check if mail is sent
	
	    {
			echo "Email sent sucessfully!";
		} 
	else
		{
			echo "Email not sent";
		}
		*/
	$mailTo = "contact@wdv341.spysportworld.com";
	$mailFrom = $user_email;
	$headers = "Frpom: ".$mailFrom;
	$messageBody = "This message is from: ".$user_name."\n\n".$message_details;
	
	mail($mailTo,$message_title,$message_details,$headers);
	header("location: index.php");
				
}//close if validform
if($validForm){
	$message = "Thank You! We will get back to you soon.";
}
else{
	
?>
	<link rel="stylesheet" type="text/css" href="CSS/contactForm.css">

<body>
	<h1>Contact Us</h1>
	<h3>We are Glad to Here From You</h3>
	<div class="container">
	<form name="contactForm" method="post" id="contactForm" action="contactForm.php">
	
		<div class="input-group">
		<label for="user_name">Name</label>
		<input type="text" placeholder="Enter you name" name="user_name" id="user_name" value="<?php echo $user_name ?>">
		<span class="errorMsg"><?php echo $nameErrMsg ?></span>
	</div>
		<div class="input-group">
		<label for="user_email">Email</label>
		<input type="email" placeholder="example@gmail.com" name="user_email" id="user_email" value="<?php echo $user_email ?>">
		<span  class="errorMsg"><?php echo $emailErrMsg ?></span>
	</div>
		<div class="input-group">
		<label for="title_name">Subject</label>
		<input type="text" placeholder="Subject" name="title_name" id="title_name" value="<?php echo $message_title ?>">
		<span  class="errorMsg"><?php echo $titleErrMsg ?></span>
	</div>
		<div class="input-group">
		<label for="form_message">Message</label>	
		<textarea maxlength="700"  name="form_message" id="form_message" placeholder="Message " value"<?php echo $message_details ?>"></textarea>
		<span class="errorMsg"><?php echo $descErrMsg ?></span>
	</div>
		<div class="hide">
			
		<input type="text" name="robot" id="robot"  autocomplete="off">
		</div>
	<div class="input-group">
		<button type="submit" name="submit" class="btn" >Submit</button>	
	</div>
	</form>
		</div>
	<br>
	<br>
	<br>
	<?php
	}//close else if validForm
	include "footer.php";
	?>
</body>
</html>