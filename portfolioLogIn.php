<?php  
session_start();
 $_SESSION['user_login'] = false;
$errorMsg = ""; //Variable to hold error message

if(isset($_SESSION['username'])){
	echo "<a href='welcome.php'></a>";
}
else 
	
	if(isset($_POST['username']) && isset($_POST['password'])){
		$user = $_POST['username'];
		$pass  = $_POST['password'];

		include 'connectPDO.php';

		$sql = "SELECT * FROM event_user WHERE event_user_name =:username AND event_user_password =:password";

		$query = $conn->prepare($sql);

		$query->bindParam( 'username', $user);
		$query->bindParam( 'password', $pass);

		$query->execute();

		$row = $query->fetch(PDO::FETCH_BOTH);

		 $row = $query->rowCount();

		if($row >0){

			$_SESSION['username'] = $user;
			$_SESSION['user_login'] = true;
			//$_SESSION['message'] = "Welcome ".$user;
			
			header("location: admin.php");
		}
		else{

			$errorMsg = "<label>Invalid username/password.</label>";
		}

		}

	



//exit();
//close($conn);	

	

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Log In</title>
	<link href="CSS/portfolioIndex.css" rel="stylesheet" type="text/css"/>
	
	<script>
		function textFocus(){
			var textArea = document.getElementById("username");
		var nextText = document.getElementById("password");
			textArea.focus();
			textArea.style.borderColor = "brown";
			nextText.style.borderColor = "brown";
		}
	</script>
</head>

<body onLoad="textFocus()">
	<?php include "portfolioHeader.php"; ?>
	
	<div id="container">
		<div class="form-control"><h2>Sign In</h2>
		<form id="form1" name="form1" method="post" action="portfolioLogIn.php">
			
			<span id="errorLog"><?php echo $errorMsg; ?></span>
				<p>
					<lable>User Name</lable><br/>
				<input type="text" size="35" id="username" name="username" > 
				</p>
				<p>
					<lable>Password</lable><br/>
				<input type="password" id="password" size ="35"name="password" > 
				
			
				<p>
				<input type="submit" class="loginBtn" id="submit" value="LOGIN">
			</p>
				</form>
			</div>
		

	</div>
	
	
	<?php include "footer.php"; ?>
</body>
</html>
