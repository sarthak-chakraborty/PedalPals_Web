<?php
session_start();
require_once 'dbconnect.php';

$username = $_POST["username"];

$query = "SELECT * FROM user_ WHERE username='$username';";
$result = mysqli_query($con, $query);
$row=mysqli_fetch_array($result);

$numResults = mysqli_num_rows($result);

if($numResults == 1)
{
	$_SESSION['username'] = $username;
	header("Location: ../forgot_password_user.php");
}

else
{	
	echo "<h5><font color='white'>Incorrect Username</font></h5>";
	exit(); 	                    
}

?>
