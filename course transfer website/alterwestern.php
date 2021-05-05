<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Western Course Modifier</title>
</head>
<body>
<?php
include 'connectdb.php';
?>

<!-- RETRIEVE THE NECESSARY VARIABLES FROM THE FORM -->

<?php
   $oldname = $_POST["namechoice"];
   $oldnumber = $_POST["numberchoice"];
   $newname = $_POST["newname"];
   $weight = $_POST["weight"];
   $suffix = $_POST["suffix"];
//   echo $oldname;
//   echo $oldnumber;
//   echo $newname;
//   echo "<br>";

// CHANGE A COURSE 

if($_POST["change"]){
   if($newname && !$weight && !$suffix){	 
   	$query = 'UPDATE WesternCourses SET CourseName="' . $newname . '" WHERE CourseNumber ="' . $oldnumber . '"';
   }
   if(!$newname && $weight && !$suffix){	 
   	$query = 'UPDATE WesternCourses SET Weight="' . $weight . '" WHERE CourseNumber ="' . $oldnumber . '"';
   }
   if(!$newname && !$weight && $suffix){	 
   	$query = 'UPDATE WesternCourses SET Suffix="' . $suffix . '" WHERE CourseNumber ="' . $oldnumber . '"';
   }
   if($newname && $weight && !$suffix){	 
   	$query = 'UPDATE WesternCourses SET Weight ="' . $weight . '" , CourseName="' . $newname . '" WHERE CourseNumber ="' . $oldnumber . '"';
   }

   if($newname && !$weight && $suffix){	 
   	$query = 'UPDATE WesternCourses SET Suffix ="' . $suffix . '" , CourseName="' . $newname . '" WHERE CourseNumber ="' . $oldnumber . '"';
   }

   if(!$newname && $weight && $suffix){	 
   	$query = 'UPDATE WesternCourses SET Suffix="' . $suffix . '" , Weight="' . $weight . '" WHERE CourseNumber ="' . $oldnumber . '"';
   }

   if($newname && $weight && $suffix){	 
   	$query = 'UPDATE WesternCourses SET Suffix="' . $suffix . '" , Weight="' . $weight . '" , CourseName="' . $newname . '" WHERE CourseNumber ="' . $oldnumber . '"';
   }

   $result=mysqli_query($connection,$query);
    if (!$result) {
         die("Attempt to alter course failed. Check the format of your values.");
     }
   echo '<div style="font-size:2em;color:black;font-weight:bold">The course was successfully updated. </div>';
}

// DELETE A COURSE

if($_POST["delete"]){
   echo '<form action="delete.php" method="post" enctype="multipart/form-data">';
   $query = 'SELECT * FROM EqualTo WHERE WesternCourse="' . $oldnumber . '"';
   $result=mysqli_query($connection,$query);
   echo '<input type="hidden" name="number" value="' . $oldnumber . '">';
   if($result->num_rows!=0){
	echo "This course has equivalences. Are you sure you want to delete it?" . "<br>";
	echo '<input type ="submit" name="yes" value="Yes">';
	echo '<input type ="submit" name="no" value="No">';
   }
   else{
	echo "Please confirm that you want to delete this course." . "<br>";
	echo '<input type ="submit" name="yes" value="Yes">';
	echo '<input type ="submit" name="no" value="No">';
   }
   echo '</form>';
}

// ADD A COURSE

if($_POST["add"]){
   $addnumber = $_POST["addnumber"];
   $courseCheck = 'SELECT * FROM WesternCourses WHERE CourseNumber="' . $addnumber . '"';
   $checkResult = @mysqli_query($connection,$courseCheck);	
   if($checkResult->num_rows != 0){
	die("The course number you entered already exists.");
   }
   $addname = $_POST["addname"];
   $addweight = $_POST["addweight"];
   $addsuffix = $_POST["addsuffix"];
//   echo $addsuffix . "<br>";
   $query = 'INSERT INTO WesternCourses VALUES("' . $addnumber . '","' . $addname . '","' . $addweight . '","' . $addsuffix . '")';
   $result=mysqli_query($connection,$query);
    if (!$result) {
         die("Unable to add the course. Check the format of your values.");
     }
   echo '<div style="font-size:2em;color:black;font-weight:bold">The course was successfully added. </div>';
}
?>
</form>
<?php
   mysqli_close($connection);
?>
</body>
</html>
