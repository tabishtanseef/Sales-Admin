<?php
include_once("include/db_connect.php");
session_start();

$id = $_GET['shahrukh'];   

$sql = "select * from school_list where user_id='$id' ";

$result = mysqli_query($conn,$sql);

$users_arr = array();

while($row = mysqli_fetch_array($result) ){
    $name = $row['school_city'];
    $users_arr[] = array("name" => $name);
	$users_arr = array_values(array_unique($users_arr,SORT_REGULAR));
}

// encoding array to json format
echo json_encode($users_arr);
?> 
