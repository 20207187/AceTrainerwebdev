<?php
$connect = mysqli_connect("localhost", "root", "password");

$sql = "CREATE DATABASE IF NOT EXISTS aceTrainer";
if(mysqli_query($connect, $sql)) echo "Database aceTrainer created";
else die(mysqli_error($connect));

$sql = "USE aceTrainer";
if(mysqli_query($connect, $sql)) echo "Database aceTrainer filled";
else die(mysqli_error($connect));






$sql = "CREATE TABLE IF NOT EXISTS courses (
  courseid int AUTO_INCREMENT PRIMARY KEY,
  name varchar(255) NOT NULL,
  creditvalue int NOT NULL,
  schoolID varchar(50) NOT NULL
)";
if(mysqli_query($connect, $sql)) echo "Database courses created";
else die(mysqli_error($connect));




$sql = "CREATE TABLE IF NOT EXISTS registration (
  schoolID varchar(50) PRIMARY KEY,
  firstName varchar(50) NOT NULL,
  lastName varchar(50) NOT NULL,
  password varchar(50) NOT NULL,
  userType varchar(50) NOT NULL,
  authorisation tinyint NOT NULL
)";
if(mysqli_query($connect, $sql)) echo "Database registration created";
else die(mysqli_error($connect));


$sql = "INSERT INTO registration (schoolID, firstName, LastName, password, userType, authorisation) VALUES
('12345698', 'john', 'smith', 'pass123', 'Student', 0),
('20207187', 'Matthew', 'Taylor', 'password123', 'Student', 0),
('MTaylor', 'Matthew', 'Taylor', 'pass123', 'tutor', 1)";
if(mysqli_query($connect, $sql)) echo "Database registration filled";
else die(mysqli_error($connect));




$sql = "CREATE TABLE IF NOT EXISTS studentcourse (
  schoolID varchar(50) NOT NULL,
  courseid int NOT NULL,
  dateEnrolled int NOT NULL
)";
if(mysqli_query($connect, $sql)) echo "Database studentcourse created";
else die(mysqli_error($connect));

