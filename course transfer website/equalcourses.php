<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Equivalent Courses System</title>
</head>
<body>
<?php
include 'connectdb.php';
?>
<h1>Equivalent Courses</h1>
<?php
	echo"Western Course Information:<br>";
        $westernchoice=$_POST["westernchoice"];
        $infoQuery = 'SELECT * FROM WesternCourses WHERE CourseNumber="' . $westernchoice . '"';
        $infoResult = mysqli_query($connection,$infoQuery);
        if(!$infoResult){die("Attempt to find course information failed");}
        $row=mysqli_fetch_assoc($infoResult);
	echo "<li>Course Name: " .  $row["CourseName"] . "</li>";
        echo "<li>Course Number: " .  $row["CourseNumber"] . "</li>";
	echo "<li>Weight: " .  $row["Weight"] . "</li><br>";
        mysqli_free_result($infoResult);

	echo "Equivalent Courses:<br>";
	echo "<ol>";
	$equalQuery = 'SELECT * FROM EqualTo,OutsideCourses,Universities WHERE OutsideCourse=CourseNumber AND OutsideUniversity=UniversityNumber AND OutsideUniversity=Number AND WesternCourse="' . $westernchoice . '"';
	$equalResult = mysqli_query($connection,$equalQuery);
	if(!$equalResult){die("The attempt to find equivalent courses failed.");}
	if($equalResult->num_rows==0){
		die("There are no equivalent courses for this course.");
	}
	while($row=mysqli_fetch_assoc($equalResult)){
		echo "<li>";
		echo "University Name: " . $row["UniversityName"] . "<br>";
		echo "Course Name: " . $row["CourseName"] . "<br>";
		echo "Course Number: " . $row["CourseNumber"] . "<br>";
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



