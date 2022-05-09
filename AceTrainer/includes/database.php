<?php
	$connect = mysqli_connect("localhost" "root" "password" "aceTrainer") or die(mysql_error($connect));

	// this is used to create a database

	$database = "CREATE DATABASE acetrainer";
	if(mysql_query($connect, $database)) echo "<p> Database Created</p>";
	else echo "<p> Database Failed </p>".
		mysql_error($connect);

	//this drops the database if needs to

	if (isset($_GET["drop"]) && $_GET["drop"] == "yes") {
		$database = "DROP DATABASE aceTrainer";
		echo "<p>"
		if (mysql_query($connect, $database)) echo "Database dropped" 
			
		else echo "Database has not dropped: ".
			mysql_error($connect);
		echo "</p>"
		
	}



	
?>