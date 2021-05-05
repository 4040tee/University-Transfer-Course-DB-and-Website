<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Delete Course System</title>
</head>
<body>
<?php
include 'connectdb.php';
?>
<?php

//RETRIEVE THE COURSE NUMBER
$oldnumber = $_POST["number"];
if($_POST["yes"]){
   $query = 'DELETE FROM WesternCourses WHERE CourseNumber="' . $oldnumber . '"';
   $result=mysqli_query($connection,$query);
    if (!$result) {
         die("Unable to delete the course. Check if the course still exists.");
     }
   echo '<div style="font-size:2em;color:black;font-weight:bold">The course was successfully deleted. </div>';
}
if($_POST["no"]){
   echo '<div style="font-size:2em;color:black;font-weight:bold">The course was not deleted. </div>';
}

?>


<?php
mysqli_close($connection);
?>
</body>
</html>


