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

$query = "select * from cycle where reg_no = $reg_no and username='$username';";
$result = mysqli_query($con,$query);
$numResults = mysqli_num_rows($result);
if($numResults==0){
	echo "<br><h5><font color='white'>Cannot Delete Entry. Unauthorised. </font></h5>";
	exit();
}	

$curr_date = date('Y/m/d');

$query = "select * from transaction where reg_no = $reg_no and end_date >= '$curr_date';";
$result = mysqli_query($con,$query);
$numResults = mysqli_num_rows($result);
if($numResults>0){
	echo "<br><h5><font color='white'>Cannot Delete Entry. Cycle is in use. </font></h5>";
	exit();
}	

$query="delete from cycle where reg_no = $reg_no and username='$username';";
if(!mysqli_query($con, $query)){
	  echo("<h5><font color='white'>Can't process query!\n Error description: " . mysqli_error($con) . "</font></h5>");
	  exit();
}

header("Location: ../manage_cycles.php");


?>
