<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Decision Date System</title>
</head>
<body>
<?php
include 'connectdb.php';
?>
<h1>All Decisions Made On This Date</h1>
<?php
	$datechoice = $_POST["datechoice"];
	echo "Equivalencies:<br>";
	echo "<ol>";
	$equalQuery = 'SELECT UniversityName,OutsideCourses.CourseName AS OutsideName,OutsideCourse,WesternCourses.CourseName AS WesternName,WesternCourse,OutsideCourses.Weight AS Weight,DecisionDate FROM EqualTo,OutsideCourses,Universities,WesternCourses WHERE WesternCourse=WesternCourses.CourseNumber AND  OutsideCourse=OutsideCourses.CourseNumber AND OutsideUniversity=UniversityNumber AND OutsideUniversity=Number AND DecisionDate="' . $datechoice . '"';
	$equalResult = mysqli_query($connection,$equalQuery);
	if(!$equalResult){die("The attempt to find equivalent courses failed.");}
	while($row=mysqli_fetch_assoc($equalResult)){
		echo "<li>";
		echo "University Name: " . $row["UniversityName"] . "<br>";
		echo "Course Name: " . $row["OutsideName"] . "<br>";
		echo "Course Number: " . $row["OutsideCourse"] . "<br>";
		echo "Western Course Name: " . $row["WesternName"] . "<br>";
		echo "Western Course Number: " . $row["WesternCourse"] . "<br>";
		echo "Weight: " . $row["Weight"] . "<br>";
		echo "Decision Date: " . $row["DecisionDate"] . "<br>";
		echo "</li><br>";
	}
	mysqli_free_result($equalResult);
	echo "</ol>";
?>


<?php
mysqli_close($connection);
?>
</body>
</html>



