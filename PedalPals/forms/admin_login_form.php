<?php

session_start();
require_once 'dbconnect.php';

$username = $_POST["username"];
$password = $_POST["password"];


$password = md5($password);

$query = "SELECT * FROM Admin WHERE username='$username' AND passw='$password';";


$result = mysqli_query($con, $query);
$row=mysqli_fetch_array($result);

$numResults = mysqli_num_rows($result);

if($numResults == 1)
{
	$_SESSION['username'] = $username;
	header("Location: ../admin_menu.php");
}
else
{	
	header("Location: ../admin_login_incorrectpass.html");
}

mysqli_close($con);
?>
