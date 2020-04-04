<?php
/*$host = "localhost";
$user = "USER_NAME";
$dbpass = "PASSWORD";
$dbname = "DB_NAME";
$con = mysqli_connect($host,$user,$dbpass,$dbname);
*/
require_once 'dbconnect.php';

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

$name = $_POST["name"];
$email = $_POST["email"];
$subject = $_POST["subject"];
$message = $_POST["message"];
$curr_date = date("Y/m/d");
$query = "insert into contactus values('$name','$email','$subject','$message','$curr_date');";
if(!mysqli_query($con, $query)){
  echo("<center><h5>Can't process query!\n Error description: " . mysqli_error($con) . "</h5></center>");
}
else { 
  echo "<center><h5>Query submitted successfully!</h5></center>";
}
?>
