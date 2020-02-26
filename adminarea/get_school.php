<?php
include_once("include/db_connect.php");
session_start();

$state = $_POST['state'];   
$city = $_POST['city'];  
$u_id = $_SESSION['salesman_id'];

$sql = "select * from school_list where school_state ='$state' AND school_city ='$city' AND user_id='$u_id' and is_deleted='0' order by school_name";

$result = mysqli_query($conn,$sql);

$users_arr = array();

while($row = mysqli_fetch_array($result) ){
    $id = $row['id'];
    $name = $row['school_name'];
    $users_arr[] = array("id" => $id, "name" => $name);
}

// encoding array to json format
echo json_encode($users_arr);
?> 