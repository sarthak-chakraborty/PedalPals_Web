<?php
  require_once "dbconnect.php";

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
$room = $_POST["room"];
$hall = $_POST["hall"];
$mobilenum1 = $_POST["mobilenum1"];
$mobilenum1 = trim($mobilenum1);
$mobilenum2 = $_POST["mobilenum2"];
$mobilenum2 = trim($mobilenum2);
$securityq = $_POST["securityq"];
$securityans = $_POST["securityans"];

if(strcmp($password, $re_password)!=0){
	echo "<br><h5><font color='white'>Passwords don't match!</font></h5>";
	exit();
}

if((strlen($mobilenum1)!=0 && !is_numeric($mobilenum1)) || (strlen($mobilenum2)!=0 && !is_numeric($mobilenum2))){
	echo "<br><h5><font color='white'>Mobile Number Incorrect!</font></h5>";
	exit();
}
$query = "select * from user_ WHERE email_id='$email';";
$result = mysqli_query($con, $query);
$numResults = mysqli_num_rows($result);

if($numResults >= 1){
	echo "<br><h5><font color='white'>Email id is already registered!</font></h5>";
	exit();
}

else{
	$query = "select * from user_ WHERE username='$username';";
	$result = mysqli_query($con, $query);
	$numResults = mysqli_num_rows($result);

	if($numResults >= 1){
		echo "<br><h5><font color='white'>Username is already taken!</font></h5>";
		exit();
	}

	else{
		$query = "select * from mobilenumber WHERE number='$mobilenum1' or number='$mobilenum2';";
		$result = mysqli_query($con, $query);
		$numResults = mysqli_num_rows($result);

		if($numResults >= 1){
			echo "<br><h5><font color='white'>Mobile Number is already in use!</font></h5>";
			exit();
		}
		
		$query = "insert into user_ values('$username','$firstname','$lastname','$email','$room','$hall',null,'$password','$securityq','$securityans',0);";

		if(!mysqli_query($con, $query)){
		  echo("<h5><font color='white'>Can't process query!\n Error description: " . mysqli_error($con) . "</font></h5>");
		}
		else { 
		  if(strlen($mobilenum1)>0){
		  	$query1="insert into mobilenumber values('$username','$mobilenum1');";
		  	mysqli_query($con,$query1);
		  }
		  if(strlen($mobilenum2)>0){
		  	$query2="insert into mobilenumber values('$username','$mobilenum2');";
		  	mysqli_query($con,$query2);
		  }
		  echo "<h5><font color='white'>Signed up successfully, <a href='login.html'>login </a> to pedal!</font></h5>";
		}
	}
}
?>
