<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Outside University System</title>
</head>
<body>
<?php
include 'connectdb.php';
?>
<h1>University Information</h1>
<?php
	$outsidechoice=$_POST["outsidechoice"];
	$infoQuery = 'SELECT * FROM Universities WHERE UniversityName="' . $outsidechoice . '"';
	$infoResult = mysqli_query($connection,$infoQuery);
	if(!$infoResult){die("Attempt to find university information failed");}
	$row = mysqli_fetch_assoc($infoResult);
	echo "University Name:" . " " . $row["UniversityName"] . "<br>";
	echo "City:" . " " . $row["City"] . "<br>";
	echo "Province:" . " " . $row["ProvinceCode"] . "<br>";
	echo "Nickname:" . " " . $row["Nickname"] . "<br>";
	echo "University Number:" . " " . $row["Number"] . "<br><br>";
	mysqli_free_result($infoResult);
	
	echo "Equivalent ourses offered:<br>";
	$coursesQuery = 'SELECT * FROM Universities,OutsideCourses WHERE Universities.Number=OutsideCourses.UniversityNumber AND Universities.UniversityName="' . $outsidechoice . '"';
	$coursesResult = mysqli_query($connection,$coursesQuery);
	if(!$coursesResult){
		die("Attempt to find universities courses failed.");
	}
	if($coursesResult->num_rows == 0){
		die("This University has no course equivalents with Western");
	}
	while($row=mysqli_fetch_assoc($coursesResult)){
		echo "<li>";
                echo $row["CourseName"];
		echo "</li>";
	}
	mysqli_free_result($coursesResult);	
?>


<?php
mysqli_close($connection);
?>
</body>
</html>

