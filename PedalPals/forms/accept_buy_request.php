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
$buyer = $_GET["buyer"];

$query = "select * from cycle where reg_no = $reg_no and username='$username';";
$result = mysqli_query($con,$query);
$numResults = mysqli_num_rows($result);
if($numResults==0){
	echo "<br><h5>Cannot Delete Entry. Unauthorised.</h5>";
	header("refresh:2;url=../sell_cycle.php" );
	exit();
}	

$query = "select * from pending_buy_cycle_requests where reg_no = $reg_no and buyer='$buyer';";
$result = mysqli_query($con,$query);
$numResults = mysqli_num_rows($result);
if($numResults==0){
	echo "<br><h5>Cannot Delete Entry. Unauthorised.</h5>";
	header("refresh:2;url=../sell_cycle.php" );
	exit();
}	

$row = mysqli_fetch_assoc($result);
$price = $row["price"];
$request_date = $row["request_date"];

$query = "delete from pending_buy_cycle_requests where reg_no = $reg_no and buyer='$buyer';";

if(!mysqli_query($con, $query)){
	  echo("<h5>Can't process query!\n Error description: " . mysqli_error($con) . "</h5>");
   	  header("refresh:2;url=../sell_cycle.php" );
	  exit();
}

$query="insert into completed_buy_cycle_requests values('$buyer',$reg_no,'$username',$price,'a','$request_date','".date("Y/m/d")."');";

if(!mysqli_query($con, $query)){
	echo $query;
	  echo("<h5>Can't process query!\n Error description: " . mysqli_error($con) . "</h5>");
   	  header("refresh:2;url=../sell_cycle.php" );
	  exit();
}

$query="update cycle set username='$buyer' where reg_no = $reg_no and username='$username';";

if(!mysqli_query($con, $query)){
	  echo("<h5>Can't process query!\n Error description: " . mysqli_error($con) . "</h5>");
	  header("refresh:2;url=../sell_cycle.php" );
	  exit();
}

$query = "select * from pending_buy_cycle_requests where reg_no = $reg_no;";
$result = mysqli_query($con,$query);

while($row_del = mysqli_fetch_assoc($result)){
	$query1 = "delete from pending_buy_cycle_requests where reg_no = $reg_no and buyer = '".$row_del['buyer']."';";
	$query2 = "insert into completed_buy_cycle_requests values ('".$row_del['buyer']."',$reg_no,'$username',$price,'r','".$row_del['request_date']."','".date("Y/m/d")."');";

	if(!mysqli_query($con, $query1)){
	  echo("<h5>Can't process query!\n Error description: " . mysqli_error($con) . "</h5>");
	  header("refresh:2;url=../sell_cycle.php" );
	  exit();
	}
	if(!mysqli_query($con, $query2)){
	  echo("<h5>Can't process query!\n Error description: " . mysqli_error($con) . "</h5>");
	  header("refresh:2;url=../sell_cycle.php" );
	  exit();
	}
}
header("Location: ../sell_cycle.php");


?>
