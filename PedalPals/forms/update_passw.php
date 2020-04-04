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
$newpass = $_POST["new"];
if(strlen($newpass)<4){
	echo "<h5> Min length of password is 4</h5>";
	header("refresh:2;url=../security.php");
	exit();
}

$newpass = md5($newpass);
$renewpass = $_POST["renew"];
$renewpass = md5($renewpass);

$query="select passw from user_ where username='$username'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

if(strcmp($password,$row['passw'])!=0){
	echo "<br><h5> Incorrect Password </h5>";
	header("refresh:2;url=../security.php");
	exit();
}

if(strcmp($newpass,$renewpass)!=0){
	echo "<h5>Passwords don't match</h5>";
	header("refresh:2;url=../security.php");
	exit();
}

$query = "update user_ set passw = '$newpass' where username='$username';";

if(!mysqli_query($con, $query)){
  echo("<h5>Can't process query!\n Error description: " . mysqli_error($con) . "</h5>");
  header("refresh:2;url=../security.php");
  exit();
}

echo "<h5>Password Updated</h5>";
header("refresh:2;url=../security.php");
exit();
?>
