<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Western Course System</title>
</head>
<body>
<?php
include 'connectdb.php';
?>
<h1>Courses from Western:</h1>
<form action ="alterwestern.php" method ="post" enctype ="multipart/form-data">
<ol>
<?php
   $type= $_POST["type"];
   $order= $_POST["order"];
   if ($order == "ascending" && $type == "name" ){
	 $query = 'SELECT * FROM WesternCourses ORDER BY CourseName ASC';
	}
   if ($order == "descending" && $type == "name" ){
	 $query = 'SELECT * FROM WesternCourses ORDER BY CourseName DESC';
	}
   if ($order == "ascending" && $type == "number" ){
	 $query = 'SELECT * FROM WesternCourses ORDER BY CourseNumber ASC';
	}
   if ($order == "descending" && $type == "number" ){
	 $query = 'SELECT * FROM WesternCourses ORDER BY CourseNumber DESC';
	}
   $result=mysqli_query($connection,$query);
    if (!$result) {
         die("database query2 failed.");
     }
    while ($row=mysqli_fetch_assoc($result)) {
        echo "<li>";
	if ($type == name){
		echo '<input type ="radio" name ="numberchoice" value = "';
		echo $row["CourseNumber"];
		echo '">';		
		echo $row["CourseName"];
	 }
	if ($type == number) {
		echo '<input type ="radio" name ="numberchoice" value = "';
		echo $row["CourseNumber"];
		echo '">'; 
		echo $row["CourseNumber"];
	 }
	echo "</li>" ;
     }
     mysqli_free_result($result);
?>
</ol>
Would you like to alter the selected course?<br><br> 
Course Name: <input type ="text" name ="newname"> <br>
Course Weight: <input type ="text" name ="weight"> <br>
Course Suffix: <input type ="text" name ="suffix"> <br>
<input type ="submit" value ="Change" name="change"><br><br>
Would you like to delete the selected course?<br><br>
<input type ="submit" value="Delete" name="delete"><br><br>
Would you like to add a new course?<br><br>
Course Number: <input type ="text" name ="addnumber"> <br>
Course Name: <input type ="text" name ="addname"> <br>
Course Weight: <input type ="text" name ="addweight"> <br>
Course Suffix: <input type ="text" name ="addsuffix"> <br>
<input type ="submit" value="Add" name="add"><br><br>
</form> 
<?php
   mysqli_close($connection);
?>
</body>
</html>
