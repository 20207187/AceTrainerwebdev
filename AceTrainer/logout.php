<html>
	<head>
		<title>AceTrainer</title>
	</head>

	<body>
		<h1>acetrainer</h1>
		<?php
			include("includes/header.php");
			include("includes/taskbar.php");
		?>

		<h2>AceTrainer</h2>

		<p>you have been logged out</p> 

		<?php 
		session_destroy();
		?>



		
		

		
		<?php include("includes/footer.php"); ?>
	</body>

</html>