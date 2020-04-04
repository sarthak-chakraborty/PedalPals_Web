<?php

include("../auth.php");
require_once 'dbconnect.php';

$coupon_id = $_POST["coupon_id"];
$discount = $_POST["discount"];
$min_rating = $_POST["min_rating"];
$max_amount = $_POST["max_amount"];

$query = "SELECT * FROM Coupon WHERE coupon_id='$coupon_id';";
$result = mysqli_query($con, $query);
$numResults = mysqli_num_rows($result);

if($numResults >= 1){
	echo "<br><h5><font color='white'>Coupon Already Exits!</font></h5>";
	exit();
}
else{
	$query = "INSERT INTO Coupon VALUES('$coupon_id',$discount,$min_rating,$max_amount);";

	if(!mysqli_query($con, $query)){
	  echo("<h5><font color='white'>Can't process query!\n Error description: " . mysqli_error($con) . "</font></h5>");
	  // header("Location: ../add_coupon.php");
	}
	else{
	  echo "<h5><font color='white'>Coupon Added Successfully!</font></h5>";
	  // header("Location: ../add_coupon.php");
	}
}

mysqli_close($con);
?>