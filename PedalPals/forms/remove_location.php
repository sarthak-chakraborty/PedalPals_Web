<?php

include("../auth.php");
require_once 'dbconnect.php';

$name = $_GET['name'];

$query = "SELECT * FROM location WHERE name='$name';";
$result = mysqli_query($con, $query);
$numResults = mysqli_num_rows($result);


if($numResults == 0){
	echo "<br><h5><font color='black'>Location Does Not Exist!</font></h5>";
	// header("Location: ../location.php");
}
else{
	$query = "DELETE FROM cycle WHERE location_name='$name'";

	if(!mysqli_query($con, $query)){
	  echo("<h5><font color='black'>Can't process query!\n Error description: " . mysqli_error($con) . "</font></h5>");
	  header("Location: ../location.php");
	}

	$query = "DELETE FROM location WHERE name='$name';";
	if(!mysqli_query($con, $query)){
	  echo("<h5><font color='black'>Can't process query!\n Error description: " . mysqli_error($con) . "</font></h5>");
	  header("Location: ../location.php");
	}
	else{
	  echo "<h5><font color='black'>Location Removed Successfully!</font></h5>";
	  header("Location: ../location.php");
	}
}

mysqli_close($con);
?>