<?php
//include auth.php file on all secure pages
include("../auth.php");

$username =  $_SESSION['username'];
require_once 'dbconnect.php';

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
$query = "select * from user_ where username='$username';";
$result = mysqli_query($con,$query);
$row = mysqli_fetch_assoc($result);

if($row['wallet']==0){
	echo "<h4>Cannot claim points. No points available</h4>";
	header("refresh:3;url=../profile.php");
}
$query = "update user_ set wallet=0 where username = '$username';";
mysqli_query($con,$query);

header("refresh:0;url=../profile.php");
?>
