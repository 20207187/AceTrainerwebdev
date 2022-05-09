<?php
	require("includes/function.php");

	$connect = databaseconnection();
	session_start();

	if (!isset($_SESSION["login"])) {
		$_SESSION["login"] = false;
	}
?>
this is just a visual to see if it works change it with the CSS in the header.php file
<div style="width: 90%; background-color: blue; color: black; font-weight: bold; font-size: 50px; padding-top: 20px;"></div>