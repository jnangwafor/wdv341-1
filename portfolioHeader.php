<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<title>Header</title>
	<meta name="viewport" content="width=device-width, initial-scale=1", user-scalable="no">
	<link href="CSS/header.css" rel="stylesheet" type="text/css"/>
	
	
	<script>
		
		function activeMenu() {
		  var boxMenu = document.getElementById('menu-box');
			
		  if(boxMenu.style.display == "block") { // if the menuBox is displayed, hide it
			boxMenu.style.display = "none";
		  }
		  else { // if the  menuBox is hidden, display it
			boxMenu.style.display = "block";
		  }
			
		}
		
	</script>
</head>

<body >
	
		<div id="header-bar" class="header-menu">
			<a class="homenav" href="#"><img src="Image/wave_surfing_logo_LI.jpg" title="Homepage" alt="Homepage" width="80" height="60"/></a>
			<a class="menubar" id="menu-bar"  onClick="activeMenu();">Menu</a>
	<div  id="menu-box" class="header-float">
		<a href="index.php">Home</a>
		<a href="createPost.php">Create Post</a>
		<a href="displayProducts.php">Products</a>
		<a href="#">Portfolio</a>
		<a href="contactForm.php">Contact Us</a>
		<?php   if(isset($_SESSION['username'])){
		echo "<a href='portfolioLogout.php'>logout</a>";
		}else{
			echo "<a href='portfolioLogIn.php'>login</a>";
		}  ?>
		<a href="admin.php">Admin</a>

			
		
		</div>
	</div>
	
	
</body>
</html>