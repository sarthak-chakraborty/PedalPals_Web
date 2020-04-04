<?php

include("../auth.php");
require_once 'dbconnect.php';

$username = $_GET['username'];

$query = "SELECT * FROM user_ WHERE username='$username';";
$result = mysqli_query($con, $query);
$numResults = mysqli_num_rows($result);


if($numResults == 0){
	echo "<br><h5><font color='white'>User Does Not Exist!</font></h5>";
	header("Location: ../user_details.php");
}
else{
	$query = "DELETE FROM mobilenumber WHERE username='$username';";
	if(!mysqli_query($con, $query)){
	  echo("<h5><font color='black'>Can't process query!\n Error description: " . mysqli_error($con) . "</font></h5>");
	  header("Location: ../user_details.php");
	}
	else{
	  echo "<h5><font color='black'>Mobile Number Removed Successfully!</font></h5>";
	}

	$query = "DELETE FROM cycle WHERE username='$username';";
	if(!mysqli_query($con, $query)){
	  echo("<h5><font color='black'>Can't process query!\n Error description: " . mysqli_error($con) . "</font></h5>");
	  header("Location: ../user_details.php");
	}
	else{
	  echo "<h5><font color='black'>All Cycles Removed Successfully!</font></h5>";
	}

	$query = "DELETE FROM user_ WHERE username='$username';";
	if(!mysqli_query($con, $query)){
	  echo("<h5><font color='black'>Can't process query!\n Error description: " . mysqli_error($con) . "</font></h5>");
	  header("Location: ../user_details.php");
	}
	else{
	  echo "<h5><font color='black'>User Removed Successfully!</font></h5>";
	  header("Location: ../user_details.php");
	}


}

mysqli_close($con);
?>