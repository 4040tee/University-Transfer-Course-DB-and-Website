<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Equivalence Creation System</title>
</head>
<body>
<?php
include 'connectdb.php';
?>
<?php
        $westerncourse = $_POST["westerncourse"];
	$outsidecourse = $_POST["outsidecourse"];
	$outsideschool = $_POST["outsideschool"];
	
	$westernQuery = 'SELECT * FROM WesternCourses WHERE CourseNumber="' . $westerncourse . '"';
	$western = mysqli_query($connection,$westernQuery);
	if($western->num_rows==0){
		die("The Western course number you entered is not in the database.");}
	$outsideQuery = 'SELECT * FROM OutsideCourses WHERE CourseNumber="' . $outsidecourse . '"';
	$outside = mysqli_query($connection,$outsideQuery);
	if($outside->num_rows==0){
		die("The outside course number you entered is not in the database.");}
	$schoolQuery = 'SELECT * FROM Universities WHERE Number="' . $outsideschool . '"';
	$school = mysqli_query($connection,$schoolQuery);
	if($school->num_rows==0){
		die("The university number you entered is not in the database.");}

	date_default_timezone_set('Canada/Toronto');		
	$date = date('Y-m-d', time());

	$checkQuery = 'SELECT * FROM EqualTo WHERE WesternCourse="' . $westerncourse . '" AND OutsideCourse="' . $outsidecourse . '" AND OutsideUniversity="' . $outsideschool . '"';
	$check = mysqli_query($connection,$checkQuery);
	if($check->num_rows!=0){
		$updateQuery = 'UPDATE EqualTo SET DecisionDate="' . $date . '" WHERE WesternCourse = "' . $westerncourse . '" AND OutsideCourse = "' . $outsidecourse . '" AND OutsideUniversity="' . $outsideschool . '"';
		$update = mysqli_query($connection,$updateQuery);
		if(!$update){die("failed to update equivalence.");}
		echo '<div style="font-size:2em;color:black;font-weight:bold">Successfully updated existing equivalence. </div>';
	}
	else{
		$insertQuery = 'INSERT INTO EqualTo VALUES("' . $westerncourse . '","' . $outsidecourse . '","' . $outsideschool . '","' . $date . '")';	
		$insert = mysqli_query($connection,$insertQuery);
		if(!$insert){die("failed to add new equivalence.");}
		echo '<div style="font-size:2em;color:black;font-weight:bold">Successfully added new equivalence. </div>';
	}
?>


<?php
mysqli_close($connection);
?>
</body>
</html>


