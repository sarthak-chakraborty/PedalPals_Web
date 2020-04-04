<?php
	include("../auth.php");

	require_once 'dbconnect.php';

	$expiry_date=date('Y-m-d', strtotime(date('Y-m-d') . '+ 10 days'));
	$query = "SELECT * from Coupon";
	$result = mysqli_query($con,$query);
	$numResults = mysqli_num_rows($result);
	if($numResults == 0){
		header("Location: ../user_coupon.php");
		exit();
	}
//----------------------------------------------------------
	$query = "SELECT * from user_ where rating is null";
	$result = mysqli_query($con,$query);

	$query3 = "select * from Coupon where discount = (select min(discount) from Coupon where discount >= (select avg(discount) from Coupon)); ";
	$result3 = mysqli_query($con,$query3);
	$row3 = mysqli_fetch_assoc($result3);

	while($row = mysqli_fetch_assoc($result)){
		$query2 = "SELECT count(*) as c from User_Coupon where username = '".$row['username']."';";
		$result2 = mysqli_query($con,$query2);
		$row2 = mysqli_fetch_assoc($result2);

		if($row2['c']==0){
			$query4 = "insert into User_Coupon values('".$row["username"]."','".$row3["coupon_id"]."','$expiry_date');";
			mysqli_query($con,$query4);
		}
	}
//------------------------------------------------------------
	$query = "SELECT * from user_ where rating is not null";
	$result = mysqli_query($con,$query);

	while($row = mysqli_fetch_assoc($result)){
		$query2 = "SELECT count(*) as c from transaction where username = '".$row['username']."';";
		$result2 = mysqli_query($con,$query2);
		$row2 = mysqli_fetch_assoc($result2);

		if($row2['c']<3){
			$query4 = "insert into User_Coupon values('".$row["username"]."','".$row3["coupon_id"]."','$expiry_date');";
			mysqli_query($con,$query4);
		}

		else{
			$query5 = "select coupon_id from Coupon where min_rating <= ".$row['rating']." and coupon_id not in (select coupon_id from transaction A where coupon_id is not null and username = '".$row['username']."' and 2 >= (select count(*) from transaction B where username = '".$row['username']."' and A.start_date <= B.start_date));";
			$result5 = mysqli_query($con,$query5);

			while($row5 = mysqli_fetch_assoc($result5)){
				$query6 = "insert into User_Coupon values('".$row["username"]."','".$row5["coupon_id"]."','$expiry_date');";
				mysqli_query($con,$query6);
			}
		}
	}
//------------------------------------------------------------------
	echo "<h5><font color='white'> Coupons assigned.</font></h5>";
	mysqli_close($con);
?>


