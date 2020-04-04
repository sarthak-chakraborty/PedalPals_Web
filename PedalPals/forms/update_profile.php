<?php
include("../auth.php");

$username =  $_SESSION['username'];
require_once 'dbconnect.php';

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
$email = $_POST["email_id"];
$firstname = $_POST["first_name"];
$lastname = $_POST["last_name"];
$room = $_POST["room"];
$hall = $_POST["hall"];
$mobilenum1 = $_POST["mobilenum1"];
$mobilenum1 = trim($mobilenum1);
$mobilenum2 = $_POST["mobilenum2"];
$mobilenum2 = trim($mobilenum2);


if((strlen($mobilenum1)!=0 && !is_numeric($mobilenum1)) || (strlen($mobilenum2)!=0 && !is_numeric($mobilenum2))){
	echo "<br><h5>Mobile Number Incorrect!</h5>";
	header("refresh:2;url=../profile.php");

	exit();
}

$query = "select * from user_ WHERE email_id='$email' and username!='$username';";
$result = mysqli_query($con, $query);
$numResults = mysqli_num_rows($result);

if($numResults >= 1){
	echo "<br><h5>Email id is already registered!</h5>";
	exit();
}

else{
		$query = "select * from mobilenumber WHERE (number='$mobilenum1' or number='$mobilenum2') and username!='$username';";
		$result = mysqli_query($con, $query);
		$numResults = mysqli_num_rows($result);

		if($numResults >= 1){
			echo "<br><h5>Mobile Number is already in use!</h5>";
			header("refresh:2;url=../profile.php");

			exit();
		}
		$query="select rating from user_ where username='$username';";
		$result=mysqli_query($con,$query);
		$row=mysqli_fetch_array($result);
		if(!$row&&row['rating']!=null) $rating = $row['rating'];
		else $rating="null";

		$query = "update user_ set first_name='$firstname',last_name='$lastname',email_id='$email',room='$room',hall='$hall',rating=$rating where username='$username';";

		if(!mysqli_query($con, $query)){
			echo $query;
		  echo("<h5>Can't process query!\n Error description: " . mysqli_error($con) . "</h5>");
  		  header("refresh:2;url=../profile.php");

		  exit();
		}
		else { 
		  $query="delete from mobilenumber where username='$username';";
		  mysqli_query($con,$query);

		  if(strlen($mobilenum1)>0){
		  	$query1="insert into mobilenumber values('$username','$mobilenum1');";
		  	mysqli_query($con,$query1);
		  }
		  if(strlen($mobilenum2)>0){
		  	$query2="insert into mobilenumber values('$username','$mobilenum2');";
		  	mysqli_query($con,$query2);
		  }
		  echo "<h5>Profile Updated successfully</h5>";
		  header("refresh:2;url=../profile.php");
		}
	}
?>
