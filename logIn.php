<?php  
session_start();

$_SESSION['validUser'] = false;


$errorMsg = ""; //Variable to hold error message

if(isset($_POST['LOGIN'])){
	$_SESSION['validUser'] = true;
}
	if(empty(isset($_POST['username'])) && empty(isset($_POST['password']))){
		$_SESSION['validUser'] = false;
		//$errorMsg = "<label>Invalid username/password.</label>";
	}
else{
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
		echo "Welcome ",$user;
		header('location: displayEvents.php');
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
	
	
	<style>
		.form-control{
			width: 300px;
			border:solid 2px;
			border-radius: 5px;
			margin:auto;
			padding: 20px;
			
		}
		#password, #username{
			border-radius: 3px;
		}
		#errorLog{
			color:red;
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
	<h1>WDV341 Intro to PHP</h1>
	<h2>Login Page</h2>
	<div id="container">
		<div class="form-control"><h3>Sign In</h3>
		<form id="form1" name="form1" method="post" action="logIn.php">
			
			<span id="errorLog"><?php echo $errorMsg; ?></span>
				<p>
					<lable>User Name</lable><br/>
				<input type="text" size="35" id="username" name="username" > 
				</p>
				<p>
					<lable>Password</lable><br/>
				<input type="password" id="password" size="35" name="password" > 
				
			
				<p>
				<input type="submit" id="submit" value="LOGIN">
			</p>
				</form>
			</div>
		

	</div>
	
	
</body>
</html>
