<?php
include_once("include/db_connect.php");
session_start();

$state = $_GET['shahrukh'];   
$city = $_GET['city'];   

$sql = "select * from qb_school_list where school_state='$state' AND school_city='$city' order by user_name";

$result = mysqli_query($conn,$sql);

$users_arr = array();

while($row = mysqli_fetch_array($result) ){
    $name = $row['user_name'];
    $users_arr[] = array("name" => $name);
	$users_arr = array_values(array_unique($users_arr,SORT_REGULAR));
}

// encoding array to json format
echo json_encode($users_arr);
?> 
