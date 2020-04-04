<?php
//include auth.php file on all secure pages
include("../auth.php");
$username =  $_SESSION['username'];
require_once 'dbconnect.php';
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

$securityq = $_POST["securityq"];
$securityans = $_POST["securityans"];
$newpass = $_POST["password"];
if(strlen($newpass)<4){
	echo "<h5> Min length of password is 4</h5>";
	header("refresh:2;url=../security.php");
	exit();
}

$newpass = md5($newpass);
$renewpass = $_POST["re_password"];
$renewpass = md5($renewpass);


if(strcmp($newpass,$renewpass)!=0){
	echo "<h5><font color='white'>Passwords don't match</font></h5>";
	exit();
}

$query = "SELECT securityq,securityans FROM user_ WHERE username='$username';";
$result = mysqli_query($con, $query);
$row=mysqli_fetch_array($result);

$numResults = mysqli_num_rows($result);
if(strcmp($securityans,$row['securityans'])!=0 || strcmp($securityq,$row['securityq'])!=0){
	echo "<h5><font color='white'>Incorrect Security Answer</font></h5>";
	exit();
}

$query = "update user_ set passw = '$newpass' where username='$username';";

if(!mysqli_query($con, $query)){
  echo("<h5><font color='white'>Can't process query!\n Error description: " . mysqli_error($con) . "</font></h5>");
  header("refresh:2;url=../security.php");
  exit();
}

echo "<h5><font color='white'>Password Updated. <a href='login.html'>Login Here </a></font></h5>";
exit();
?>