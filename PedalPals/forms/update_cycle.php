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
$model = $_POST["model"];
$model = trim($model);
$colour = $_POST["color"];
$colour = trim($colour);
$hascarrier = $_POST["hascarrier"];
$location = $_POST["location"];
$description = $_POST["description"];
$reg_type = $_POST["reg_type"];
$price = $_POST["price"];
$price = trim($price);
if(strcmp($hascarrier,"")==0){
	echo "<br><h5>Enter value for Has Carrier</h5>";
	header( "refresh:2;url=../edit_cycle_details.php?reg_no=".$reg_no );

	exit();
}

if(strcmp($location,"")==0){
	echo "<br><h5>Enter value for Location</h5>";
	header( "refresh:2;url=../edit_cycle_details.php?reg_no=".$reg_no );
	exit();
}

if(strcmp($model,"")==0){
	echo "<br><h5>Enter Model</h5>";
	header( "refresh:2;url=../edit_cycle_details.php?reg_no=".$reg_no );

	exit();
}

if(strcmp($colour,"")==0){
	echo "<br><h5>Enter Colour</h5>";
	header( "refresh:2;url=../edit_cycle_details.php?reg_no=".$reg_no );
	exit();
}

if(strcmp($price,"")==0 || !is_numeric($price))
{
	echo "<br><h5>Price is incorrectly mentioned.</h5>";
	header( "refresh:2;url=../edit_cycle_details.php?reg_no=".$reg_no );

	exit();
}

$intprice = intval($price);


$curr_date = date('Y/m/d');

$query = "select * from transaction where reg_no = $reg_no and end_date >= '$curr_date';";
$result = mysqli_query($con,$query);
$numResults = mysqli_num_rows($result);
if($numResults>0){
	echo "<br><h5>Cannot Delete Entry. Cycle is in use.</h5>";
	header( "refresh:2;url=../edit_cycle_details.php?reg_no=".$reg_no );
	exit();
}	
	$query="update cycle set model = '$model',color='$colour',price = $intprice,cycle_condition='$description',hasCarrier='$hascarrier',location_name='$location',reg_type='$reg_type' where reg_no = ".strval($reg_no).";";
	if(!mysqli_query($con, $query)){
		  echo("<h5>Can't process query!\n Error description: " . mysqli_error($con) . "</h5>");
		  exit();
		}

	echo "<h5>Cycle Details Updated. Redirecting to <a href='../manage_cycles.php'>Manage Cycles </a></h5>";
	header( "refresh:2;url=../manage_cycles.php" );
?>
