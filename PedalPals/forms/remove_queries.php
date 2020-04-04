<?php

include("../auth.php");
require_once 'dbconnect.php';

$name = $_GET['name'];
$email = $_GET['email'];
$subject = $_GET['subject'];

$query = "SELECT * FROM contactus WHERE name='$name' AND email_id='$email' AND subject='$subject';";
$result = mysqli_query($con, $query);
$numResults = mysqli_num_rows($result);


if($numResults == 0){
	echo "<br><h5><font color='white'>Coupon Does Not Exist!</font></h5>";
	header("Location: ../queries.php");
}
else{
	$query = "DELETE FROM contactus WHERE name='$name' AND email_id='$email' AND subject='$subject';";

	if(!mysqli_query($con, $query)){
	  echo("<h5><font color='white'>Can't process query!\n Error description: " . mysqli_error($con) . "</font></h5>");
	  header("Location: ../queries.php");
	}
	else{
	  echo "<h5><font color='white'>Query Removed Successfully!</font></h5>";
	  header("Location: ../queries.php");
	}
}

mysqli_close($con);
?>