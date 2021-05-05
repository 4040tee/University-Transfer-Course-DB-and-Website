<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Western Course Equivalence System</title>
</head>
<body>
<?php
include 'connectdb.php';
?>
<h1>Welcome to the Western Course Equivalence System</h1>

<!-- DISPLAY THE CURRENT DATE -->
<?php
	date_default_timezone_set('Canada/Toronto');
        $date = date('Y-m-d', time());
        echo "Today's date: " . $date;
?>

<p>
<hr>
<p>


<!-- ALLOW THE USER TO SEE THE COURSES OFFERED BY WESTERN IN THEIR PREFERRED FORMAT --> 

<form action="western.php" method="post" enctype ="multipart/form-data">
Would you like to see courses from Western?<br>
Course Number or Course Name:<br>
<input type ="radio" name ="type" value="number">By Course Number<br>
<input type ="radio" name ="type" value="name">By Course Name<br>
Ascending or Descending<br>
<input type ="radio" name ="order" value="ascending">In Ascending Order<br>
<input type="radio" name ="order" value="descending">In Descending Order<br>
<input type="submit" value="See Western Courses">
</form>
<p>
<hr>
<p>
<form action="outside.php" method="post" enctype="multipart/form-data">
Would you like to see another universities information?<br>

<?php
	$outsideQuery = 'SELECT * FROM Universities ORDER BY ProvinceCode DESC';
	$outsideResult = mysqli_query($connection,$outsideQuery);
	if(!$outsideResult){
		die("Attempt to find universities failed.");
	}
	while($row=mysqli_fetch_assoc($outsideResult)){
		//echo "<li>";
		echo '<input type ="radio" name ="outsidechoice" value ="';
		echo $row["UniversityName"];
		echo '">';
		echo $row["UniversityName"] . "<br>";
		//echo "</li>";
	}
?>
<input type="submit" value="See University Information">
</form>

<p>
<hr>
<p>

<!-- ALLOW THE STUDENT TO SEE ALL THE UNIVERSITIES IN A GIVEN PROVINCE -->

<form action = province.php method="post" enctype="multipart/form-data">
Would you like to see all the universities in a province?<br>
<?php
	$provinceQuery = 'SELECT DISTINCT(ProvinceCode) FROM Universities ORDER BY ProvinceCode DESC';
	$provinceResult = mysqli_query($connection,$provinceQuery);
	if(!$outsideResult){
		die("Attempt to find provinces failed.");
	}
	while($row=mysqli_fetch_assoc($provinceResult)){
		//echo "<li>";
		echo '<input type ="radio" name ="provincechoice" value ="';
		echo $row["ProvinceCode"];
		echo '">';
		echo $row["ProvinceCode"] . "<br>";
		//echo "</li>";
	}
?>
<input type="submit" value="See Universities">
</form>

<p>
<hr>
<p>

<!-- ALLOW THE USER TO SEE ALL THE EQUIVALENT COURSES FOR A GIVEN WESTERN COURSE -->

<form action="equalcourses.php" method="post" enctype="multipart/form-data">
Would you like to see all equivalent courses for a Western course?<br>
<?php
	$westernQuery = 'SELECT * FROM WesternCourses';
	$westernResult = mysqli_query($connection,$westernQuery);
	while ($row=mysqli_fetch_assoc($westernResult)) {
        	//echo "<li>";
                echo '<input type ="radio" name ="westernchoice" value = "';
                echo $row["CourseNumber"];
                echo '">';
                echo $row["CourseNumber"] . "<br>";
         }
        //echo "</li>" ;
     	mysqli_free_result($westernResult);
?>
<input type="submit" value="See Equivalent Courses">
</form>

<p>
<hr>
<p>

<!-- ALLOW THE USER TO SEE ALL THE EQUIVALENCES MADE ON A GIVEN DATE -->

<form action ="decisiondate.php" method="post" enctype="multipart/form-data">
Would you like to view all equivalencies made on a given date?<br>
<?php
	$decisionquery = 'SELECT * FROM EqualTo';
	$decisionresult = mysqli_query($connection,$decisionquery);
	if(!$decisionresult){die("The attempt to find the decision dates failed.");}
	while($row=mysqli_fetch_assoc($decisionresult)){
		echo '<input type ="radio" name ="datechoice" value = "';
                echo $row["DecisionDate"];
                echo '">';
                echo $row["DecisionDate"] . "<br>";
	}
	mysqli_free_result($decisionresult);
?>
<input type="submit" value="See Decisions">
</form>

<p>
<hr>
<p>

<!-- ALLOW THE USER TO CREATE A NEW EQUIVALENCY -->

<form action="makeequal.php" method="post" enctype="multipart/form-data">
Would you like to create a new equivalency?<br>
(There is an index at the bottom of the page with names and numbers.)<br>
Western Course Number: <input type="text" name="westerncourse"><br>
Outside Course Number: <input type="text" name ="outsidecourse"><br>
Outside University Number: <input type="text" name="outsideschool"><br>
<input type="submit" value="Create Equivalency"><br>
</form>

<p>
<hr>
<p>

<!-- ALLOW THE USER TO SEE THE UNIVERSITIES WHICH DO NOT OFFER WESTERN EQUIVALENTS -->

Here are the universities which do not have equivalent courses with Western:<br><br>
<?php
	$unequalQuery = 'SELECT UniversityName,Nickname FROM Universities WHERE UniversityName NOT IN(SELECT DISTINCT(UniversityName) FROM Universities,OutsideCourses WHERE Number=UniversityNumber)';
	$unequal = mysqli_query($connection,$unequalQuery);
	if(!$unequal){die("Attempt to find courses failed.");}
	while($row=mysqli_fetch_assoc($unequal)){
		echo "University Name: " . $row["UniversityName"] . "<br>";
		echo "Nickname: " . $row["Nickname"] . "<br><br>";
	}

?>

<p>
<hr>
<p>

<!-- AN INDEX WITH USEFUL INFORMATION, IN CASE THE USER NEEDS ITS -->

<h2>Index</h2>
<?php
	$helpquery1 = 'SELECT * FROM WesternCourses';
	$help1 = mysqli_query($connection,$helpquery1);
	if(!$help1){die("Attempt to find western courses failed.");}
	echo "Here is a list of Western courses to help you.";
	while($row=mysqli_fetch_assoc($help1)){ 
		echo "<li>";
		echo "Course Name: " . $row["CourseName"] . " | ";
		echo "Course Number: " . $row["CourseNumber"] . "</li>";
	}
	mysqli_free_result($help1);
	
	$helpquery2 = 'SELECT * FROM OutsideCourses,Universities WHERE UniversityNumber=Number';
	$help2 = mysqli_query($connection,$helpquery2);
	if(!$help2){die("Attempt to find outside courses failed.");}
	echo "Here is a list of Outside courses to help you.";
	while($row=mysqli_fetch_assoc($help2)){ 
		echo "<li>";
		echo "Course Name: " . $row["CourseName"] . " | ";
		echo "Course Number: " . $row["CourseNumber"] . " | ";
		echo "University Name: " . $row["UniversityName"] . "</li>";
	}
	mysqli_free_result($help2);
	
	$helpquery3 = 'SELECT * FROM Universities';
	$help3 = mysqli_query($connection,$helpquery3);
	if(!$help3){die("Attempt to find universities failed.");}
	echo "Here is a list of Universities to help you.";
	while($row=mysqli_fetch_assoc($help3)){ 
		echo "<li>";
		echo "University Name: " . $row["UniversityName"] . " | ";
		echo "University Number: " . $row["Number"] . "</li>";
	}
	mysqli_free_result($help3);
?>


<?php
mysqli_close($connection);
?>
</body>
</html>
