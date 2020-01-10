<?php
include_once("include/db_connect.php");
session_start();

$user_id=$_SESSION['user_id'];   // department id

$get_attendance="select * from attendance where user_id='$user_id' order by date DESC";
$run_attendance= mysqli_query($conn, $get_attendance);


$users_arr = array();

while($row = mysqli_fetch_array($run_attendance) ){
    $date = $row_attendance['date'];
	$start_time = $row_attendance['start_time'];
	$end_time= $row_attendance['end_time'];
	$day = $row_attendance['day'];
	$date = date("d-M-Y", strtotime($date));
	
    $users_arr[] = array( "date" => $date, "start_time" => $start_time, "end_time" => $end_time, "day" => $day);
}

// encoding array to json format
echo json_encode($users_arr);
?>