<?php 

function databaseconnection(){
	$connect = mysqli_connect("localhost" , "root" , "password" , "aceTrainer");
	return $connect;
}


function registrationform($connect){

	$schoolID = $_POST["schoolID"];
	$firstName = $_POST["firstName"];
	$lastName = $_POST["lastName"];
	$password = $_POST["password"];
	$userType = $_POST["userType"];
	$authorisation = $userType;
	if ($userType == "tutor"){
		$authorisation = 1;
	} 
		
	elseif ($userType == "student") {
		$authorisation = 0;
	}
	elseif ($userType == "admin") {
		$authorisation = 2;
	}



	$database = "INSERT INTO registration (schoolID, firstName, lastName, password, userType, authorisation)VALUES('$schoolID', '$firstName', '$lastName', '$password', '$userType', '$authorisation')";
	if (mysqli_query($connect, $database)){
					echo "Welcome you have registered to the VLE $firstName, $lastName";
	}
	else
	echo "error with registration please try again" . mysqli_error($connect);
				

				
				
}



function loginform($connect) {
	$schoolID = $_POST["schoolID"];
	$password = $_POST["password"];

	$database = "SELECT * FROM registration
			WHERE schoolID = '$schoolID' 
			AND password = '$password'";
	$result = mysqli_query($connect, $database);



	if(mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_array($result);
		$firstName = $row["firstName"];
		$lastName = $row["lastName"];
		$userType = $row["userType"];
		$authorisation = $row["authorisation"];

		if ($authorisation == "1") {
			$_SESSION["login"] = true;
			$_SESSION["schoolID"] = $schoolID;
			$_SESSION["firstName"] = $firstName;
			$_SESSION["lastName"] = $lastName;
			$_SESSION["userType"] = $userType;

			//echo "welcome"

		if ($userType == "student") header("Location: student.php");
		else if ($userType == "tutor") header("Location: tutor.php");
					
		}
		else {
			echo "<p>you have not been authorised/p>";
		
	}

}
}


function showLoginForm() {
	echo '
		<form method = "post" action = "login.php">
					<label for = "schoolID"> SchoolID </label>
					<input type = "text" name="schoolID"/>
					<br/><br/>
					<label for = "password">password</label>
					<input type="text" name="password"/>
					<br/><br/>
					<input type="submit" value = "login"/>
				</form>';
}

function showRegistrationForm() {
	echo'

	<form method ="post" action="registration.php">
			<table>
				<tr>
					<label for="schoolID"> SchoolID</label>
					<input type="text" name="schoolID">
				</tr>
				<tr>
					<label for="firstName"> firstName</label>
					<input type="text" name="firstName">
				</tr>
				<tr>
					<label for="lastName"> lastName</label>
					<input type="text" name="lastName">
				</tr>
				<tr>
					<label for="password"> password</label>
					<input type="text" name="password">
				</tr>
				<tr>
					<label for="userType">usertype</label>
					<select name="userType">
						<option value="student">student</option>
						<option value="tutor">tutor</option>
						<option value="admin">admin</option>
					</select>
				</tr>
			</table>
			<input type="submit" value="Register"/>
		</form>
		';
}

function showcourseform() {
	echo '<form method = "post" action = "tutor.php">';
	echo '<label for = "name">courseName</label>';
	echo '<input type="text" name="name"/>';
	echo '<br/><br/>';
	echo '<label for = "creditvalue">creditvalue</label>';
	echo '<input type="text" name = "creditvalue"/>';
	echo '<br/><br/>';
	echo '<input type="submit" value = "submit"/>';
	echo '</form>';
}

function courseform($connect){
	if (isset($_POST["name"])) {
		$name = $_POST["name"];
		$creditvalue = $_POST["creditvalue"];
		$owner = $_SESSION["schoolID"];



		$database = "INSERT INTO courses (name, creditvalue, schoolID)VALUES('$name', '$creditvalue', '$owner')";
		if (mysqli_query($connect, $database)) 
		{
		echo "<p>you have added a course</p>";
		
		}
			else{
			echo "<p>there was an error adding a course</p>" . mysqli_error($connect). "</p>";
		
		
			}
	}	
}

function tutorAuthorisation(){
		if (isset($_SESSION["schoolID"]) && $_SESSION["schoolID"] != "tutor"  || isset($_SESSION["schoolID"])) {
		header("Location: index.php");
	}
}


function studentAuthorisation(){

		if (isset($_SESSION["schoolID"]) && $_SESSION["schoolID"] != "student"  || isset($_SESSION["schoolID"])) {
		header("Location: index.php");
	}
}

function tutorauthstudent($connect){

	if (isset($_POST["authoriseID"])) {
		$authoriseID = $_POST["authoriseID"];
		$database = "UPDATE registration SET authorisation = '1' WHERE schoolID = '$authoriseID'";

		if (mysqli_query($connect, $database)) {
			echo "<p> you have authorised student</p>";
		}
	}
	

	$database = "SELECT * FROM registration WHERE authorisation ='0' AND userType = 'student'";
	if ($result = mysqli_query($connect, $database)) {
		echo "<table border= '1'>";
		echo "<tr>";
		echo "<th> SchoolID</th>";
		echo "<th> First Name</th>";
		echo "<th> Last Name</th>"; 
		echo "<th> Authorisation</th>";
		echo "</tr>";
		

		while ($row = mysqli_fetch_array($result)) {
			extract($row);
			echo "<tr>";
			echo "<td>$schoolID</td>";
			echo "<td>$firstName</td>";
			echo "<td>$lastName</td>";
			echo "<td>";
			echo"<form method = 'POST' action= 'tutor.php'>";
			echo"<input type = 'hidden' name = 'authoriseID' value= '$schoolID'/>";
			echo"<input type = 'submit' value = 'authorise'/>";
			echo"</form>";
			echo "<tr>";
		
		}
		echo "</table>";
	}

	else echo "There is an error with the student list" . mysqli_error($connect);
}

function studentcoursetable($connect){
	if(isset($_POST["studentcourseID"])){
		$studentcourseID = $_POST["studentcourseID"];
		$studentenrol = $_SESSION["schoolID"];
		$date = date('YYYY-MM-DD');
		$database = "INSERT INTO studentcourse VALUES('$studentenrol','$studentcourseID','$date')";
		if (mysqli_query($connect, $database)) {
			echo "<p> you have enroled onto a course </p>";
		}
	}
		$database = "SELECT * FROM courses";
		if ($result = mysqli_query($connect, $database)){
			echo "<table border= '1'>";
			echo "<tr>";
			echo "<th>Course ID</th>";
			echo "<th>Course Name</th>";
			echo "<th>Course Value</th>";
			echo "<th>tutor</th>";
			echo "</tr>";

			while ($row = mysqli_fetch_array($result)){
				extract($row);

				echo "<tr>";
				echo "<td>$courseid</td>";
				echo "<td>$name</td>";
				echo "<td>$creditvalue</td>";
				echo "<td>$owner</td>";
				echo "<td>";
				echo"<form method = 'POST' action= 'student.php'>";
				echo"<input type = 'hidden' name = 'studentcourseID' value= '$name'/>";
				echo"<input type = 'submit' value = 'enrol'/>";
				echo"</form>";
				echo "</tr>";
				
			}
			"</table>";

	}
}

function files($connect){
	if(isset($_POST["courseidresorce"])){
		$courseid = $_POST["courseidresorce"];
		$file = $_FILE["fileSelect"];

		$fileName = $file["name"];
		$tmpName = $file["tmpname"];
		$targetfile = "resources/$filename";

		if (move_uploaded_file($tmpName, $targetfile)){
			echo "<p> file has been uploaded</p>";
		}
		else{
			echo "<p> there was an error </p>";
		}

	}
	echo"
	<form method='post' action = 'tutor.php' enctype= 'multipart/form-data'>";

	echo"<label for = 'courseidresorce'>course</label>";
	echo"<select name = 'courseidresorse'>";
	$database = "SELECT * FROM courses";
	$result = mysqli_query($connect, $database);

	while ($row = mysqli_fetch_array($result)){
		extract($row);

		echo "<option value= '$courseid'> $name </option>";
	}
	echo"</select>";

	echo '<br/><br/>';
	echo '<br/><br/>';

	echo "<label for='fileSelect'>Select file</label>";
	echo"<input type='file' name = 'fileSelect'/>";

	echo '<br/><br/>';
	echo '<br/><br/>';

	echo"<input type = 'submit' value = 'submit'/>";

	echo "</form>";


	
}	

	





?>