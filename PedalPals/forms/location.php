<?php
	include("../auth.php");

  require_once 'dbconnect.php';

$name = $_POST["name"];

$query = "SELECT * FROM location WHERE name='$name';";
$result = mysqli_query($con, $query);
$numResults = mysqli_num_rows($result);

if($numResults > 0){
	echo "<br><h5><font color='white'>There is already a location with the same name. Enter a different name!</font></h5>";
	exit();
}
else{
	$query = "INSERT INTO location values('$name');";

	if(!mysqli_query($con, $query)){
	  echo("<h5><font color='white'>Can't process query!\n Error description: " . mysqli_error($con) . "</font></h5>");
	}
	else{
	  echo "<h5><font color='white'>Location Entered Successfully!</font></h5>";
	}
}

mysqli_close($con);

?>
