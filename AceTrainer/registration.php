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
		<h1>registration</h1>
		<p>please register yourself using our form below</p>

		<?php 

			if (isset($_POST["schoolID"])) registrationform($connect);
			else showRegistrationForm();
			
			


			?>

		
		


		
			



			

		

		<?php include("includes/footer.php"); ?>
	</body>

</html>