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
<h1>Universities in Province</h1>
<?php
        $provincechoice=$_POST["provincechoice"];
        $infoQuery = 'SELECT * FROM Universities WHERE ProvinceCode="' . $provincechoice . '"';
        $infoResult = mysqli_query($connection,$infoQuery);
        if(!$infoResult){die("Attempt to find universities failed");}
        while($row = mysqli_fetch_assoc($infoResult)){
        	echo "<li>";
		echo  $row["UniversityName"] . ", ";
        	echo  $row["Nickname"];
		echo "</li>";
	}        
	mysqli_free_result($infoResult);

?>


<?php
mysqli_close($connection);
?>
</body>
</html>


