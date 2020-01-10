<?php
include_once("include/db_connect.php");
session_start();

$state = $_POST['state'];   
$city = $_POST['city'];  
$school = $_POST['school'];  
$u_id = $_SESSION['salesman_id'];

$sql = "select * from school_list where school_state ='$state' AND school_city ='$city' AND user_id='$u_id' AND id='$school'";

$result = mysqli_query($conn,$sql);

$users_arr = array();

while($row = mysqli_fetch_array($result) ){
	$board = $row['school_board'];
	$strength = $row['school_strength'];
	$address = $row['school_address'];
    $users_arr[] = array("board" => $board, "strength" => $strength, "address" => $address);
}

// encoding array to json format
echo json_encode($users_arr);
?> 