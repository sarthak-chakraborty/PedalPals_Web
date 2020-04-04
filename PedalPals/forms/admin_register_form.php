<?php
require_once 'dbconnect.php';

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$password = md5($password);
$re_password = $_POST["re_password"];
$re_password = md5($re_password);
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];


if(strcmp($password, $re_password)!=0){
	echo "<br><h5><font color='white'>Passwords don't match!</font></h5>";
	exit();
}

$query = "SELECT * FROM Admin;";
$result = mysqli_query($con, $query);
$numResults = mysqli_num_rows($result);

if($numResults > 0){
	echo "<br><h5><font color='white'>There is already an Admin. You cannot register yourself as an admin</font></h5>";
	exit();
}
else{
	$query = "INSERT INTO Admin values('$username','$firstname','$lastname','$email','$password');";

	if(!mysqli_query($con, $query)){
	  echo("<h5><font color='white'>Can't process query!\n Error description: " . mysqli_error($con) . "</font></h5>");
	}
	else{
	  echo "<h5><font color='white'>Registered as Admin successfully, <a href='admin_login.html'>Login </a> as an Admin!</font></h5>";
	}
}

mysqli_close($con);
?>
