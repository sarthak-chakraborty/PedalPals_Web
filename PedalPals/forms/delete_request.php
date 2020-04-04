<?php
//include auth.php file on all secure pages
include("../auth.php");

$username =  $_SESSION['username'];
require_once 'dbconnect.php';

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

$reg_no = $_GET["reg_no"];

$query = "select * from pending_buy_cycle_requests where reg_no = $reg_no and buyer='$username';";
$result = mysqli_query($con,$query);
$numResults = mysqli_num_rows($result);
if($numResults==0){
	echo "<br><h5><font color='white'>Cannot Delete Entry. </font></h5>";
	exit();
}	

$query="delete from pending_buy_cycle_requests where reg_no = $reg_no and buyer='$username';";
if(!mysqli_query($con, $query)){
	  echo("<h5><font color='white'>Can't process query!\n Error description: " . mysqli_error($con) . "</font></h5>");
	  exit();
}

header("Location: ../view_buy_requests.php");


?>
