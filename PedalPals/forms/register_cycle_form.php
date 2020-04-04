<?php
//include auth.php file on all secure pages
include("../auth.php");

$username =  $_SESSION['username'];
require_once 'dbconnect.php';

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
$id = $_POST["cycle_id"];
$model = $_POST["model"];
$model = trim($model);
$colour = $_POST["colour"];
$colour = trim($colour);
$hascarrier = $_POST["hascarrier"];
$location = $_POST["location"];
$description = $_POST["description"];
$type = $_POST["reg_type"];
$price = $_POST["price"];
$price = trim($price);
if(strcmp($hascarrier,"")==0){
	echo "<br><h5><font color='white'>Enter value for Has Carrier</font></h5>";
	exit();
}

if(strcmp($location,"")==0){
	echo "<br><h5><font color='white'>Enter value for Location</font></h5>";
	exit();
}

if(!is_numeric($id)){
	echo "<br><h5><font color='white'>ID needs to be numeric.</font></h5>";
	exit();
}
if(strcmp($model,"")==0){
	echo "<br><h5><font color='white'>Enter Model</font></h5>";
	exit();
}

if(strcmp($colour,"")==0){
	echo "<br><h5><font color='white'>Enter Colour</font></h5>";
	exit();
}

if(strcmp($price,"")==0 || !is_numeric($price))
{
	echo "<br><h5><font color='white'>Price is incorrectly mentioned.</font></h5>";
	exit();
}

$intprice = intval($price);

	$query = "select * from cycle where reg_no = $id;";
	$result = mysqli_query($con,$query);
	$numResults = mysqli_num_rows($result);
	if($numResults>0){
		echo "<br><h5><font color='white'>ID already in use.</font></h5>";
		exit();
	}	

	$query="insert into cycle values($id,'$model','$colour','$hascarrier','$location','$username','$description',$intprice,'$type',null);";
	if(!mysqli_query($con, $query)){
		  echo("<h5><font color='white'>Can't process query!\n Error description: " . mysqli_error($con) . "</font></h5>");
		  exit();
		}

	echo "<h5><font color='white'>Cycle registered with cycle id: " . strval($id) . "</font></h5>";

	if(strcmp($type,"s")==0){
		echo "<h5><br><font color='white'>Go to Sell Cycle option in menu to check for sell requests.</font></h5>";
	}

?>
