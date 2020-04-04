<?php
//include auth.php file on all secure pages
include("../auth.php");

$username =  $_SESSION['username'];
require_once 'dbconnect.php';

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

$transaction_id = $_GET["transaction_id"];
$rating = $_POST["rating"];

if($rating==null || !is_numeric($rating) || intval($rating)<1 || intval($rating)>5){
	echo "<h5>Incorrect Rating</h5>";
	header("refresh:2;url=../transaction_details_owner.php");
}

$rating = intval($rating);

$query = "select * from transaction where transaction_id = $transaction_id and username = '$username';";
$result = mysqli_query($con,$query);
$numResults = mysqli_num_rows($result);

if($numResults==0){
	echo "<h5> Unauthorised Rating </h5>";
	header("refresh:2;url=../transaction_details_owner.php");
}

$row = mysqli_fetch_assoc($result);
$reg_no = $row['reg_no'];

$query = "update transaction set cycle_rating = $rating where transaction_id = $transaction_id";
mysqli_query($con,$query);

$query = "update cycle set rating=(select avg(cycle_rating) from transaction where reg_no = '$reg_no') where reg_no='$reg_no'";
mysqli_query($con,$query);

echo "<h5>Ratings updated</h5>";
header( "refresh:0;url=../transaction_details_user.php");


?>
