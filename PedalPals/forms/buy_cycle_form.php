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
$price = $_GET["price"];

$query = "select * from cycle where reg_no = $reg_no;";
$result = mysqli_query($con,$query);
$numResults = mysqli_num_rows($result);

if($numResults==0){
	echo "<br><h5><font color='white'>Cycle does not exist. </font></h5>";
	exit();
}	

$query = "select * from cycle where username = '$username' and reg_no=$reg_no;";
$result = mysqli_query($con,$query);
$numResults = mysqli_num_rows($result);
if($numResults>0){
	echo "<br><h5>Cannot buy your own cycle.</h5>";
	header( "refresh:2;url=../buy_cycle.php" );
	exit();
}	

$query = "select * from pending_buy_cycle_requests where buyer = '$username';";
$result = mysqli_query($con,$query);
$numResults = mysqli_num_rows($result);
if($numResults==3){
	echo "<br><h5>Cannot have more than 3 unapproved requests.</h5>";
	header( "refresh:2;url=../buy_cycle.php" );
	exit();
}	

$query="insert into pending_buy_cycle_requests values ('$username',$reg_no,$price,'".date('Y/m/d')."');";
if(!mysqli_query($con, $query)){

	  echo("<h5>Can't process query!\n Error description: " . mysqli_error($con) . "</h5>");
	  exit();
}

header( "refresh:0;url=../buy_cycle.php" );


?>
