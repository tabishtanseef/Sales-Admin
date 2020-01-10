<?php
include_once("include/db_connect.php");
session_start();
 
$user_id = $_SESSION['user_id'];  
$sql = "select * from notification WHERE now() BETWEEN notification.r_date AND notification.v_date and user_id ='$user_id' order by v_date DESC";

$result = mysqli_query($conn,$sql);

$users_arr = array();

while($row = mysqli_fetch_array($result) ){
    
    $v_date = $row['v_date'];
    $r_date = $row['r_date'];
    $school_name = $row['school_name'];
    $school_city = $row['school_city'];
    $school_address = $row['school_address'];
    $contact_person = $row['contact_person'];
    $reminder_message = $row['reminder_message'];
	
	$users_arr[] = array("v_date" => $v_date, "r_date" => $r_date, "school_name" => $school_name, "school_city" => $school_city, "school_address" => $school_address, "contact_person" => $contact_person, "reminder_message" => $reminder_message);
}

echo json_encode($users_arr);

?>