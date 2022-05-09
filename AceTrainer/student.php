<?php

//if (isset($_SESSION["schoolID"]) && $_SESSION["schoolID"] != "student"  || isset($_SESSION["schoolID"])) {
//		header("Location: index.php");

?>


<html>
	<head>
		<title>AceTrainer</title>
	</head>

	<body>
		<h1>acetrainer</h1>
		<?php
			include("includes/header.php");
			include("includes/taskbar3.php");
		?>

		<h2>AceTrainer</h2>

		<p>student</p> 

		
		<h3> Courses that are available</h3>

		<?php
		studentcoursetable($connect);

		?>

		
		

		
		
	</body>

</html>