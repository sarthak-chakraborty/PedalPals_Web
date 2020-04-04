<?php
include("../auth.php");

$username =  $_SESSION['username'];
require_once 'dbconnect.php';

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
$password = $_POST["current"];
$password = md5($password);
$securityq = $_POST["securityq"];
$securityans = $_POST["securityans"];

$query="select passw from user_ where username='$username'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

if(strcmp($password,$row['passw'])!=0){
	echo "<br><h5> Incorrect Password </h5>";
	header("refresh:2;url=../security.php");
	exit();
}

$securityq = trim($securityq);
$securityans = trim($securityans);

if(strcmp($securityq,"")==0 || strcmp($securityans,"")==0){
	echo "<br><h5> Please enter the details correctly. Security question and answer are mandatory. </h5>";
	header("refresh:2;url=../security.php");
	exit();	
} 

$query = "update user_ set securityq='$securityq',securityans='$securityans' where username='$username';";

if(!mysqli_query($con, $query)){
  echo("<h5>Can't process query!\n Error description: " . mysqli_error($con) . "</h5>");
  header("refresh:2;url=../security.php");
  exit();
}


echo "<h5>Security Details Updated</h5>";
header("refresh:2;url=../security.php");
exit();
?>
