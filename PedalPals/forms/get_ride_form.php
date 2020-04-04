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
$num_days = $_POST["num_days"];
if($num_days == null || !is_numeric($num_days) || intval($num_days)>5 || intval($num_days)<1){
	echo "<h5>Enter valid value for number of days</h5>";
	header("refresh:2;url=../get_ride.php");
	exit();
}
$num_days = intval($num_days);
$coupon = $_POST["coupon"];

$curr_date = date('Y/m/d');
$query = "SELECT * from cycle where username != '$username' and reg_type = 'r' and reg_no = ".$reg_no." and reg_no not in (select reg_no from transaction where end_date > '".strval($curr_date)."');";
$result = mysqli_query($con, $query);
$numResults = mysqli_num_rows($result);
if($numResults==0){
	echo "<h5>Cycle unavailable</h5>";
	header("refresh:2;url=../get_ride.php");
	exit();
}

$start_date = $curr_date;
$end_date = date('Y-m-d', strtotime($start_date . '+ '.($num_days-1).' days'));
$query = "select * from cycle where reg_no = $reg_no;";
$result = mysqli_query($con,$query);
$numResults = mysqli_num_rows($result);

if($numResults==0){
	echo "<br><h5>Cycle does not exist. </h5>";
	header("refresh:2;url=../get_ride.php");
	exit();
}	

$row = mysqli_fetch_assoc($result);
$price_per_day = $row['price'];
if(strcmp($coupon,"")==0){
	$coupon = "null";
}
else{
	$coupon = "'".$coupon."'";
}

$transaction_id = rand();
$query = "insert into transaction values($transaction_id,'$username','".$row['username']."',$reg_no,'$start_date','$end_date',$price_per_day,$coupon,null,null);";

if(!mysqli_query($con, $query)){
	echo $query;
	  echo("<h5>Can't process query!\n Error description: " . mysqli_error($con) . "</h5>");
	  //header( "refresh:2;url=../get_ride.php" );
	  exit();
}

if(strcmp($coupon,"null")!=0){
	$query = "delete from User_Coupon where username = '$username' and coupon_id = $coupon;";

	if(!mysqli_query($con, $query)){
			echo $query;

		  echo("<h5>Can't process query!\n Error description: " . mysqli_error($con) . "</h5>");
		  header( "refresh:2;url=../get_ride.php" );
		  exit();
	}
}

$query_coup = "select discount,max_amount from Coupon where coupon_id = $coupon;";
$result_coup = mysqli_query($con,$query_coup);
$numResults_coup = mysqli_num_rows($result_coup);
if($numResults_coup!=0){
	$row_coup = mysqli_fetch_assoc($result_coup);
	$reward = ($num_days) * intval($price_per_day) * intval($row_coup['discount'])/100;
	if($reward>$row_coup['max_amount']){
	$reward = $row_coup['max_amount'];
	}
}
else{
	$reward = 0;
}
$query = "update user_ set wallet = wallet + $reward where username = '$username'";
mysqli_query($con,$query);

echo "<h5>Congratulations! Ride is approved. Go to the cycle location ".$row['location_name']." pay the amount and get your cycle. <br> <a href ='../transaction_details_expanded.php?transaction_id=".$transaction_id."'>Redirecting </a> you to the transaction details.";
header( "refresh:50;url=../transaction_details_expanded.php?transaction_id=".$transaction_id);
?>
