<!DOCTYPE html>
<?php 
session_start();

include_once("include/db_connect.php");

$get_attendance="CALL list_demo('$state','$salesman')";
$run_attendance= mysqli_query($conn, $get_attendance);

while($row=mysqli_fetch_array($run_attendance)){
	$id = $row[0];
	array_push($array_ids,$id);	
}

foreach($array_ids as $value){
	echo $value;
	$get="CALL next('$value')";
	$result21= mysqli_query($conn, $get);
	$ro=mysqli_num_rows($result21);
	echo "<pre>";
	echo $ro;	
}


?>