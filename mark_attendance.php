<?php
include_once("include/db_connect.php");
session_start();

$user_id = $_POST['user_id'];  
$user_name = $_POST['user_name'];   
$date = $_POST['date'];   
  
$day = $_POST['day'];  
$type = $_POST['type'];  
$users_arr = array();

if($type=="start"){
	$start_time = $_POST['start_time'];
$g = "SELECT id FROM attendance WHERE user_id ='$user_id' AND date='$date'";
$r = mysqli_query($conn,$g);
$ch = mysqli_fetch_array($r);
if (strlen($ch['id']) != 0)
{
  $error_message = "Day already started!"; 
  $users_arr[] = array( "message" => $error_message);
}	
else{
	if(mysqli_query($conn, "INSERT INTO attendance( user_id, user_name, date, start_time, day) VALUES('" . $user_id . "', '" . $user_name . "', '". $date ."', '". $start_time ."', '". $day ."' )")) {
		$success_message = "Day Started";
		$users_arr[] = array( "message" => $success_message);
	} else {
		$error_message = "Error in registering...Please try again later!";
		$users_arr[] = array( "message" => $error_message);
	}
}
}
else{
	$end_time = $_POST['end_time'];
	$g = "SELECT id FROM attendance WHERE user_id ='$user_id' AND date='$date'";
	$r = mysqli_query($conn,$g);
	$ch = mysqli_fetch_array($r);
	if (strlen($ch['id']) == 0)
	{
		$error_message = "Your day has not started!";
		$users_arr[] = array( "message" => $error_message);
	}	
	else{
		$g = "SELECT end_time FROM attendance WHERE user_id ='$user_id' AND date='$date'";
		$r = mysqli_query($conn,$g);
		$ch = mysqli_fetch_array($r);
		if (strlen($ch['end_time']) != 0)
		{
			$error_message = "Your day has already ended!";
			$users_arr[] = array( "message" => $error_message);
		}
		else{
			if(mysqli_query($conn, "Update attendance SET end_time ='". $end_time ."' where user_id = '$user_id' AND date= '$date'")) {
				$success_message = "Day Ended";
				$users_arr[] = array( "message" => $success_message);
			} else {
				$error_message = "Error in registering...Please try again later!";
				$users_arr[] = array( "message" => $error_message);
			}
		}
	}
}
// encoding array to json format
echo json_encode($users_arr);
?>