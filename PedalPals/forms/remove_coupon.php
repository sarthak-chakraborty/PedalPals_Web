<?php

include("../auth.php");
require_once 'dbconnect.php';

$coupon_id = $_GET['coupon_id'];

// echo $coupon_id;

$query = "SELECT * FROM Coupon WHERE coupon_id='$coupon_id';";
$result = mysqli_query($con, $query);
$numResults = mysqli_num_rows($result);

echo $coupon_id;

if($numResults == 0){
	echo "<br><h5><font color='white'>Coupon Does Not Exist!</font></h5>";
	header("Location: ../add_coupon.php");
}
else{
	$query = "DELETE FROM Coupon WHERE coupon_id='$coupon_id';";

	if(!mysqli_query($con, $query)){
	  echo("<h5><font color='white'>Can't process query!\n Error description: " . mysqli_error($con) . "</font></h5>");
	  header("Location: ../add_coupon.php");
	}
	else{
	  echo "<h5><font color='white'>Coupon Removed Successfully!</font></h5>";
	  header("Location: ../add_coupon.php");
	}
}

mysqli_close($con);
?>