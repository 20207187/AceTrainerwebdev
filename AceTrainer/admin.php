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

		<p>This is the admin page</p>

		<?php

		adminauthtutor($connect);
		
		?>

		
		<?php include("includes/footer.php"); ?>
	</body>

</html>