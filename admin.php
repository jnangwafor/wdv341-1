<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Admin</title>
	<meta name="viewport" content="width=device-width, initial-scale=1", user-scalable="no">
	<script src="Javascript/greeting.js"></script>
	
	<link href="CSS/admin.css" rel="stylesheet" type="text/css"/>
	
</head>

<body onLoad="greeting()">
	<?php
		 include "portfolioHeader.php"; 

	include "sideNav.php"; 
	 include "welcome.php"; 
	

	?>
	
	<div id="greeting">

</div >
	<h2>Adminstrative Privileges</h2>
	<div class="display">
		<h3>Below are your administrative privileges and duties</h3>
		<p>Privileges  and duties include:</p>
		<p>
			<ul>
			    <li>View all products in the product inventory.</li>
				<li>Add new products into the product inventory.</li>
				<li>Update and delete existing records or products in the inventory.</li>
				
		</ul>
		</p>
	<p>Use the site bar to access the various pages with will assist you in performing your duties. Remember to log-off before closing your browser or leaving the page for security best practices.</p>
	</div>
	<br>
	<br>
	<br>
	<br>
	<br>
	<footer>
		<?php include "footer.php"; ?>
	</footer>
	
</body>
</html>