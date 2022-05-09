<?php 
//	@session_start();
//tutorAuthorisation();
?>


<html>
	<head>
		<title>AceTrainer</title>
	</head>

	<body>
		<h1>acetrainer</h1>
		<?php
			include("includes/header.php");
			include("includes/taskbar2.php");
		?>

		<h2>AceTrainer</h2>

		<p>tutor</p> 
		<?php 
		if (isset($_POST["name"])) courseform($connect);
		else showcourseform($connect);
		?>

		<h2> Student Authorisation </h2>
		<p>Please authorise Students</p>
		<?php

		tutorauthstudent($connect);
		//files($connect);
			
		
		?>

	<?php
		if(isset($_POST["courseidresource"])){
			$courseid = $_POST["courseidresource"];
			$file = $_FILES["fileSelect"];

			$fileName = $file["name"];
			$tmpName = $file["tmp_name"];
			$targetfile = "resources/$fileName";

			if (move_uploaded_file($tmpName, $targetfile)){
				echo "<p> file has been uploaded</p>";
			}
			else{
				echo "<p> there was an error </p>";
			}

		}
		?>
		<form method="post" action = "tutor.php" enctype= "multipart/form-data">

		<label for = "courseidresource">course</label>
		<select name = "courseidresource">
		<?php 
			$database = "SELECT * FROM courses";
			$result = mysqli_query($connect, $database);

			while ($row = mysqli_fetch_array($result)){
				extract($row);

				echo "<option value= '$courseid'>$name</option>";
			}
		?>
		</select>

	 	<br/><br/>
	 	<br/><br/>

		<label for="fileSelect">Select file</label>
		<input type="file" name="fileSelect"/>

	 	<br/><br/>
	 	<br/><br/>

		<input type = "submit" value = "upload">

		</form>


	</body>

</html>