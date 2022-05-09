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
			

		<h1> please login </h1>


		<?php
			var_dump($_SESSION);


			if (isset($_POST["schoolID"])) loginform($connect);
			if (!$_SESSION["login"]) showLoginForm(); 
		?>

		
	</body>

</html>